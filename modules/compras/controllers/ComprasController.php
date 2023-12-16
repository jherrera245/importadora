<?php

namespace app\modules\compras\controllers;

use app\modules\compras\models\DetCompras;
use app\modules\compras\models\Compras;
use app\modules\compras\models\ComprasSearch;
use app\modules\inventario\models\Inventario;
use app\modules\inventario\models\Kardex;
use app\models\Bitacora;
use app\controllers\CoreController;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use Yii;

/**
 * ComprasController implements the CRUD actions for Compras model.
 */
class ComprasController extends Controller
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
     * Lists all Compras models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ComprasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compras model.
     * @param int $id_compra Id Compra
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_compra)
    {

        $model = $this->findModel($id_compra);
        $detCompras = DetCompras::find()->where(['id_compra' => $id_compra])->all();
        $grid = new ActiveDataProvider(['query'=>DetCompras::find()->where(['id_compra'=>$id_compra])]);

        $sub_total = 0;
        $iva = 0;
        $total = 0;
        $retencion = 0;

        foreach($detCompras as $detalle) {

            $cantidadPorCosto = ($detalle->costo * $detalle->cantidad);
            $totalDescuento = $cantidadPorCosto  * ($detalle->descuento / 100);

            $sub_total += $cantidadPorCosto - $totalDescuento;
            $iva += ($cantidadPorCosto - $totalDescuento) * 0.13;
            $total += ($cantidadPorCosto - $totalDescuento) * 1.13;
        }

        if($sub_total >= 100) {
            $retencion = $sub_total * 0.01;
        }

        return $this->render('view', [
            'model' => $model,
            'grid' => $grid,
            'sub_total' => $sub_total,
            'iva' => $iva,
            'total' => $total,
            'retencion' => $retencion,
        ]);
    }

    /**
     * Creates a new Compras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Compras();

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
                $bitacora->id_registro = $model->id_compra;
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
            return $this->redirect(['det-compras/create', 'id_compra' => $model->id_compra]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Crea codigo de compra
     */
    private function CreateCodigo() {
        $compra = Compras::find()->orderBy(['id_compra' => SORT_DESC])->one();
        if (empty($compra->codigo)) {
            $codigo = 0;
        }else {
            $codigo = $compra->codigo;
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
        return "CMPR-".$result;
    }


    /**
     * Updates an existing Compras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_compra Id Compra
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_compra)
    {
        $model = $this->findModel($id_compra);

        if ($model->estado == 1) {
            Yii::$app->session->setFlash('danger', "La compra ya fue procesada no puede agregarse a el inventario. Comuniquese con su administrador.");
            return $this->redirect(['view', 'id_compra' => $id_compra]);
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
                $bitacora->id_registro = $model->id_compra;
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
            return $this->redirect(['view', 'id_compra' => $model->id_compra]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionInventario($id_compra) {
        $model = $this->findModel($id_compra);

        if ($model->estado == 1) {
            Yii::$app->session->setFlash('danger', "La compra ya fue procesada no puede agregarse a el inventario. Comuniquese con su administrador.");
            return $this->redirect(['view', 'id_compra' => $id_compra]);
        }

        $detCompras = DetCompras::find()->where(['id_compra' => $id_compra])->all();
        $transaction = Yii::$app->db->beginTransaction();
        try {

            foreach($detCompras as $detalle) {
                $inventario = new Inventario();
                $inventario->uuid = $detalle->uuid;
                $inventario->id_producto = $detalle->id_producto;
                $inventario->existencia = $detalle->cantidad;
                $inventario->existencia_original = $detalle->cantidad;

                if (!$inventario->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($inventario->getErrors(), 0, false))
                    );
                }

                $kardex = new Kardex();
                $kardex->id_documento = $id_compra;
                $kardex->cod_documento = $model->codigo;
                $kardex->num_documento = strval($model->num_factura);
                $kardex->tipo_documento = "COMPRA";
                $kardex->id_producto = $detalle->id_producto;
                $kardex->cantidad = $detalle->cantidad;
                $kardex->uuid = $detalle->uuid;

                if (!$kardex->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($kardex->getErrors(), 0, false))
                    );
                }
            }

            $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
            $model->estado = 1;
            $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);

            if (!$model->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                );
            }

            $bitacora = new Bitacora();
            $bitacora->id_registro = $model->id_compra;
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
            return $this->redirect(['view', 'id_compra' => $id_compra]);
        }

        Yii::$app->session->setFlash('success', "Inventario actualizado exitosamente");
        return $this->redirect(['view', 'id_compra' => $id_compra]);

    }

    /**
     * Deletes an existing Compras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_compra Id Compra
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_compra)
    {
        $model = $this->findModel($id_compra);
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
            $bitacora->id_registro = $model->id_compra;
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
     * Finds the Compras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_compra Id Compra
     * @return Compras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_compra)
    {
        if (($model = Compras::findOne(['id_compra' => $id_compra])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
