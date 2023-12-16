<?php

namespace app\modules\ventas\controllers;

use app\modules\ventas\models\Ventas;
use app\modules\ventas\models\VentasSearch;
use app\modules\ordenes\models\Ordenes;
use app\modules\ordenes\models\DetOrdenes;
use app\modules\inventario\models\Inventario;
use app\modules\inventario\models\Kardex;
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
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
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
     * Lists all Ventas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ventas model.
     * @param int $id_venta Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_venta)
    {

        $model = $this->findModel($id_venta);
        $orden = Ordenes::find()->where(['id_orden' => $model->id_orden])->one();
        $grid = new ActiveDataProvider(['query'=>DetOrdenes::find()->where(['id_orden'=>$orden->id_orden])]);

        $sub_total = 0;
        $iva = 0;
        $total  = 0;
        $detOrdenes = DetOrdenes::find()->where(['id_orden' => $orden->id_orden])->all();
        
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
     * Creates a new Ventas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ventas();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $model->codigo = $this->CreateCodigo();
                $model->estado = 0;

                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_venta;
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
            return $this->redirect(['view', 'id_venta' => $model->id_venta]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ventas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_venta Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_venta)
    {
        $model = $this->findModel($id_venta);
        $orden = Ordenes::find()->where(['id_orden'=>$model->id_orden])->one();

        if ($orden->estado == 1) {
            Yii::$app->session->setFlash('danger', "La venta ya fue procesada, no puede modificarse. Comuniquese con su administrador.");
            return $this->redirect(['view', 'id_venta' => $id_venta]);
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
                $bitacora->id_registro = $model->id_venta;
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
            return $this->redirect(['view', 'id_venta' => $model->id_venta]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Crea codigo de venta
     */
    private function CreateCodigo() {
        $venta = Ventas::find()->orderBy(['id_venta' => SORT_DESC])->one();
        if (empty($venta->codigo)) {
            $codigo = 0;
        }else {
            $codigo = $venta->codigo;
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
        return "VNPR-".$result;
    }

    public function actionInventario($id_venta) {
        $model = $this->findModel($id_venta);

        if ($model->estado == 1) {
            Yii::$app->session->setFlash('danger', "La compra ya fue procesada no puede agregarse a el inventario. Comuniquese con su administrador.");
            return $this->redirect(['view', 'id_venta' => $id_venta]);
        }

        $detOrdenes = DetOrdenes::find()->where(['id_orden' => $model->id_orden])->all();
        $transaction = Yii::$app->db->beginTransaction();
        try {

            foreach($detOrdenes as $detalle) {
                $inventarios = Inventario::find()->where(["id_producto" => $detalle->id_producto])->andWhere(['>', 'existencia', 0])->all();

                $cantidad_venta = $detalle->cantidad;

                foreach($inventarios as $inventario) {

                    $existencias = $inventario->existencia - $cantidad_venta;
                    if ($existencias < 0) {
                        $inventario->existencia = 0;

                        if (!$inventario->save()) {
                            throw new Exception(
                                implode("<br>", \yii\helpers\ArrayHelper::getColumn($inventario->getErrors(), 0, false))
                            );
                        }

                        $cantidad_venta = abs($existencias);
                    }else {

                        $inventario->existencia = $existencias;

                        if (!$inventario->save()) {
                            throw new Exception(
                                implode("<br>", \yii\helpers\ArrayHelper::getColumn($inventario->getErrors(), 0, false))
                            );
                        }

                        break;
                    }

                }

                $kardex = new Kardex();
                $kardex->id_documento = $id_venta;
                $kardex->cod_documento = $model->codigo;
                $kardex->num_documento = strval($model->num_factura);
                $kardex->tipo_documento = "VENTA";
                $kardex->id_producto = $detalle->id_producto;
                $kardex->cantidad = $detalle->cantidad;
                $kardex->uuid = $detalle->uuid;

                if (!$kardex->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($kardex->getErrors(), 0, false))
                    );
                }
            }

            $orden = Ordenes::find()->where(['id_orden'=>$model->id_orden])->one();
            $orden->estado = 1;

            if (!$orden->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($orden->getErrors(), 0, false))
                );
            }

            $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
            // $model->estado = 1;
            $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);

            if (!$model->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                );
            }

            $bitacora = new Bitacora();
            $bitacora->id_registro = $model->id_venta;
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
            return $this->redirect(['view', 'id_venta' => $id_venta]);
        }

        Yii::$app->session->setFlash('success', "Inventario actualizado exitosamente");
        return $this->redirect(['view', 'id_venta' => $id_venta]);

    }

    /**
     * Deletes an existing Ventas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_venta Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_venta)
    {
        $model = $this->findModel($id_venta);
        $transaction = Yii::$app->db->beginTransaction();
            
        try {
            $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
            $model->estado = 0;
            $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);

            if (!$model->save()) {
                throw new Exception(
                    implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                );
            }

            $bitacora = new Bitacora();
            $bitacora->id_registro = $model->id_venta;
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
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_venta Id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_venta)
    {
        if (($model = Ventas::findOne(['id_venta' => $id_venta])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
