<?php

namespace app\modules\compras\controllers;

use app\modules\compras\models\DetCompras;
use app\modules\compras\models\DetComprasSearch;
use app\modules\compras\models\Compras;
use app\models\Bitacora;
use app\controllers\CoreController;
use kartik\grid\EditableColumnAction;
use Ramsey\Uuid\Uuid;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * DetComprasController implements the CRUD actions for DetCompras model.
 */
class DetComprasController extends Controller
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
     * Lists all DetCompras models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetComprasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetCompras model.
     * @param int $id_det_compra Id Det Compra
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_det_compra)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_det_compra),
        ]);
    }

    /**
     * Creates a new DetCompras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_compra)
    {
        $model = new DetCompras();
        $compra = Compras::find()->where(['id_compra' => $id_compra])->one();

        if ($compra->estado == 1) {
            Yii::$app->session->setFlash('danger', "La compra ya fue procesada no puede agregarse a el inventario. Comuniquese con su administrador.");
            return $this->redirect(['/compras/compras/view', 'id_compra' => $id_compra]);
        }

        $grid = new ActiveDataProvider(['query'=>DetCompras::find()->where(['id_compra'=>$id_compra])]);

        $sub_total = 0;
        $iva = 0;
        $total = 0;
        $retencion = 0;

        $detCompras = DetCompras::find()->where(['id_compra' => $id_compra])->all();

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

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                
                $duplicado = DetCompras::find()->where(
                    [
                        'id_compra' => $id_compra, 
                        'id_producto' => $model->id_producto
                    ]
                )->one();

                if ($duplicado) {
                    Yii::$app->session->setFlash('warning', "El producto ya existe en la factura.");
                    return $this->redirect(['create', 'id_compra' => $id_compra]);
                }

                $model->id_compra = $id_compra;
                $model->uuid = Uuid::uuid4()->toString();

                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_det_compra;
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
                'compra' => $compra,
                'grid' => $grid,
                'sub_total' => $sub_total,
                'iva' => $iva,
                'total' => $total,
                'retencion' => $retencion,
            ]);
        }
    }

    /**
     * Updates an existing DetCompras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_det_compra Id Det Compra
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_det_compra)
    {
        $model = $this->findModel($id_det_compra);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_det_compra' => $model->id_det_compra]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetCompras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_det_compra Id Det Compra
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_det_compra, $id_compra)
    {
        $this->findModel($id_det_compra)->delete();
        Yii::$app->session->setFlash('danger', 'Registro eliminado correctamente');
        return $this->redirect(['create', 'id_compra' => $id_compra]);
    }

    /**
     * Finds the DetCompras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_det_compra Id Det Compra
     * @return DetCompras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_det_compra)
    {
        if (($model = DetCompras::findOne(['id_det_compra' => $id_det_compra])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actions() {
        return ArrayHelper::merge(parent::actions(),[
            'editar-cantidad' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetCompras::class,
            ],
            'editar-costo' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetCompras::class,
            ],
            'editar-descuento' => [
                'class' => EditableColumnAction::class,
                'modelClass' => DetCompras::class,
            ]
        ]);
    }
}
