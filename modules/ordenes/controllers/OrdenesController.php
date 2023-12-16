<?php

namespace app\modules\ordenes\controllers;

use app\modules\inventario\models\Inventario;
use app\modules\ordenes\models\Ordenes;
use app\modules\ordenes\models\DetOrdenes;
use app\modules\clientes\models\Direcciones;
use app\modules\ordenes\models\OrdenesSearch;
use app\models\Bitacora;
use app\controllers\CoreController;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii;

/**
 * OrdenesController implements the CRUD actions for Ordenes model.
 */
class OrdenesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Ordenes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdenesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ordenes model.
     * @param int $id_orden Id Orden
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_orden)
    {
        $model = $this->findModel($id_orden);
        $grid = new ActiveDataProvider(['query'=>DetOrdenes::find()->where(['id_orden'=>$id_orden])]);

        $sub_total = 0;
        $iva = 0;
        $total  = 0;
        $detOrdenes = DetOrdenes::find()->where(['id_orden' => $id_orden])->all();
        
        foreach($detOrdenes as $detalle) {
            $cantidadPorCosto = ($detalle->precio * $detalle->cantidad);
            $totalDescuento = $cantidadPorCosto  * ($detalle->descuento / 100);

            $sub_total += $cantidadPorCosto - $totalDescuento;
            $iva += ($cantidadPorCosto - $totalDescuento) * 0.13;
            $total += ($cantidadPorCosto - $totalDescuento) * 1.13;
        }

        return $this->render('view', [
            'model' => $model,
            'grid' => $grid,
            'sub_total' => $sub_total,
            'iva' => $iva,
            'total' => $total,
            'retencion' => 0,
        ]);
    }

    /**
     * Creates a new Ordenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ordenes();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $model->codigo = $this->CreateCodigo();
                $model->anulado = 0;
                $model->estado = 0;

                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_orden;
                $bitacora->controlador = Yii::$app->controller->id;
                $bitacora->accion = Yii::$app->controller->action->id;
                $bitacora->data_original = $data_original;
                $bitacora->data_modificada = NULL;
                $bitacora->id_usuario = Yii::$app->user->identity->id;
                $bitacora->fecha = $model->fecha_mod;

                if (!$bitacora->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($bitacora->getErrors(), 0, false))
                    );
                }

                $transaction->commit();

            } catch (Exception $e) {
                $transaction->rollBack();
                $controller = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
                CoreController::getErrorLog(\Yii::$app->user->identity->id, $e, $controller);
                return $this->redirect(['index']);
            }

            Yii::$app->session->setFlash('success', "Registro creado exitosamente.");
            return $this->redirect(['det-ordenes/create', 'id_orden' => $model->id_orden]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Crea codigo de orden
     */
    private function CreateCodigo() {
        $orden = Ordenes::find()->orderBy(['id_orden' => SORT_DESC])->one();
        if (empty($orden->codigo)) {
            $codigo = 0;
        }else {
            $codigo = $orden->codigo;
        }

        $int = intval(preg_replace('/[^0-9]+/', '', $codigo), 10);
        $id = $int + 1;

        $numero = $id;
        $tmp = "";

        if ($id < 10) {
            $tmp .= "0000";
            $tmp .= $id;
        }elseif ($id >= 10 && $id < 100) {
            $tmp .= "000";
            $tmp .= $id;
        }elseif ($id >=100 && $id < 1000) {
            $tmp .= "00";
            $tmp .= $id;
        }elseif ($id >= 1000 && $id < 10000) {
            $tmp .= "0";
            $tmp .= $id;
        }else {
            $tmp .= $id;
        }

        $result = str_replace($id, $tmp, $numero);
        return "ORCL-".$result;
    }

    /**
     * Updates an existing Ordenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_orden Id Orden
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_orden)
    {
        $model = $this->findModel($id_orden);

        if ($model->estado == 1) {
            Yii::$app->session->setFlash('danger', "La orden ya fue procesada, no puede modificarse. Comuniquese con su administrador.");
            return $this->redirect(['view', 'id_orden' => $id_orden]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
                $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);
                
                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_orden;
                $bitacora->controlador = Yii::$app->controller->id;
                $bitacora->accion = Yii::$app->controller->action->id;
                $bitacora->data_original = $data_original;
                $bitacora->data_modificada = $data_modificada;
                $bitacora->id_usuario = Yii::$app->user->identity->id;
                $bitacora->fecha = $model->fecha_mod;

                if (!$bitacora->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($bitacora->getErrors(), 0, false))
                    );
                }

                $transaction->commit();

            } catch (Exception $e) {
                $transaction->rollBack();
                $controller = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
                CoreController::getErrorLog(\Yii::$app->user->identity->id, $e, $controller);
                return $this->redirect(['index']);
            }

            Yii::$app->session->setFlash('success', "Registro actualizado exitosamente.");
            return $this->redirect(['view', 'id_orden' => $model->id_orden]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ordenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_orden Id Orden
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_orden)
    {
        $model = $this->findModel($id_orden);
        $transaction = Yii::$app->db->beginTransaction();
            
        try {
            $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
            $model->anulado = 1;
            $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);

            if (!$model->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                );
            }

            $bitacora = new Bitacora();
            $bitacora->id_registro = $model->id_orden;
            $bitacora->controlador = Yii::$app->controller->id;
            $bitacora->accion = Yii::$app->controller->action->id;
            $bitacora->data_original = $data_original;
            $bitacora->data_modificada = $data_modificada;
            $bitacora->id_usuario = Yii::$app->user->identity->id;
            $bitacora->fecha = $model->fecha_mod;

            if (!$bitacora->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($bitacora->getErrors(), 0, false))
                );
            }

            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollBack();
            $controller = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
            CoreController::getErrorLog(\Yii::$app->user->identity->id, $e, $controller);
            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ordenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_orden Id Orden
     * @return Ordenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_orden)
    {
        if (($model = Ordenes::findOne(['id_orden' => $id_orden])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

        //dependencia para select muncipio en departamento
        public function actionDirecciones()
        {
            $out = [];
            $selected = null;
            
            if (isset($_POST['depdrop_parents'])) {
    
                $id = end($_POST['depdrop_parents']);
                $list = Direcciones::find()->where(['id_cliente' => $id])->asArray()->all();
    
                if ($id != null && count($list) > 0) {
                    $selected = '';
                    if (!empty($_POST['depdrop_params'])) {
                        $id1 = $_POST['depdrop_all_params']['model_id1'];
    
                        foreach ($list as $direccion) {

                            $out[] = ['id' => $direccion['id_direccion'], 'name' => strip_tags($direccion['direccion'])];
    
                            if ($direccion['id_direccion'] == $id1) {
                                $selected = $id;
                            }
                        }
                    }
    
                    return Json::encode(['output' => $out, 'selected' => $selected]);
                }
            }
            return Json::encode(['output' => $out, 'selected' => $selected]);
        }
}
