<?php

namespace app\modules\ordenes\controllers;

use app\modules\inventario\models\Inventario;
use app\modules\ordenes\models\Ordenes;
use app\modules\productos\models\Productos;
use app\modules\ordenes\models\DetOrdenes;
use app\modules\ordenes\models\DetOrdenesSearch;
use app\models\Bitacora;
use app\controllers\CoreController;
use kartik\grid\EditableColumnAction;
use Ramsey\Uuid\Uuid;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use Yii;

/**
 * DetOrdenesController implements the CRUD actions for DetOrdenes model.
 */
class DetOrdenesController extends Controller
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
     * Lists all DetOrdenes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetOrdenesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetOrdenes model.
     * @param int $id_det_orden Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_det_orden)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_det_orden),
        ]);
    }

    /**
     * Creates a new DetOrdenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_orden)
    {
        $model = new DetOrdenes();
        $orden = Ordenes::find()->where(['id_orden' => $id_orden])->one();
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

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                
                $duplicado = DetOrdenes::find()->where(
                    [
                        'id_orden' => $id_orden, 
                        'id_producto' => $model->id_producto
                    ]
                )->one();

                if ($duplicado) {
                    Yii::$app->session->setFlash('warning', "El producto ya existe en la factura.");
                    return $this->redirect(['create', 'id_orden' => $id_orden]);
                }

                $producto = Inventario::find()->where(['id_producto' => $model->id_producto])->andWhere(['>', 'existencia', 0])->one();

                $model->id_orden = $id_orden;
                $model->uuid = $producto->uuid;

                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_det_orden;
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
                'orden' => $orden,
                'grid' => $grid,
                'sub_total' => $sub_total,
                'iva' => $iva,
                'total' => $total,
                'retencion' => 0,
            ]);
        }
    }

    /**
     * Updates an existing DetOrdenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_det_orden Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_det_orden)
    {
        $model = $this->findModel($id_det_orden);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_det_orden' => $model->id_det_orden]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetOrdenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_det_orden Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_det_orden, $id_orden)
    {
        $this->findModel($id_det_orden)->delete();
        Yii::$app->session->setFlash('danger', 'Registro eliminado correctamente');
        
        return $this->redirect(['create', 'id_orden' => $id_orden]);
    }

    /**
     * Finds the DetOrdenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_det_orden Id
     * @return DetOrdenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_det_orden)
    {
        if (($model = DetOrdenes::findOne(['id_det_orden' => $id_det_orden])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetalle($id_producto){
        $producto = Productos::find()->where(['id_producto' => $id_producto])->one();
        $inventario = Inventario::find()->where(['id_producto' => $id_producto])->all();

        $query = new Query();

        $detOrdenes = $query->from(['tbl_det_ordenes'])->select(['tbl_det_ordenes.cantidad'])
        ->innerJoin('tbl_ordenes', 'tbl_det_ordenes.id_orden = tbl_ordenes.id_orden')
        ->where(['tbl_det_ordenes.id_producto' => $id_producto, 'tbl_ordenes.anulado' => 0, 'tbl_ordenes.estado'=>0])
        ->all();
        
        $existencias = 0;
        $orden = 0;
        $disponible = true;

        foreach($inventario as $item) {
            $existencias += $item->existencia;
        }

        if ($detOrdenes) {            
            foreach ($detOrdenes as $detalle) {
                $orden += $detalle["cantidad"];
            }
        }

        $existencias -= $orden;

        if($existencias <= 0) {
            $disponible = false;
        }

        return Json::encode(
            [
                "precio" => $producto->precio,
                "existencias" => $existencias,
                "disponible" => $disponible
            ]
        );
    }

    public function actions() {
        return ArrayHelper::merge(parent::actions(),[
            'editar-cantidad' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetOrdenes::class,
            ],
            'editar-precio' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetOrdenes::class,
            ],
            'editar-descuento' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetOrdenes::class,
            ]
        ]);
    }
}
