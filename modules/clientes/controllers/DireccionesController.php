<?php

namespace app\modules\clientes\controllers;

use app\modules\clientes\models\Direcciones;
use app\modules\clientes\models\DireccionesSearch;
use app\models\Bitacora;
use app\models\Municipios;
use app\controllers\CoreController;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii;

/**
 * DireccionesController implements the CRUD actions for Direcciones model.
 */
class DireccionesController extends Controller
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
     * Lists all Direcciones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DireccionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Direcciones model.
     * @param int $id_direccion Id Direccion
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_direccion)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_direccion),
        ]);
    }

    /**
     * Creates a new Direcciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_cliente)
    {
        $model = new Direcciones();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if ($this->existePrincipal($id_cliente) && $model->principal == 1) {
                    Yii::$app->session->setFlash('danger', "Ya exite una direccion principal");
                    return $this->redirect(['direcciones/create','id_cliente'=>$id_cliente, 'model' => $model]);
                }

                if ($this->superaLimiteIngreso($id_cliente)) {
                    Yii::$app->session->setFlash('danger', "Solo puede agregar 6 direcciones para el cliente");
                    return $this->redirect(['direcciones/create', 'id_cliente'=>$id_cliente, 'model' => $model]);
                }

                $model->id_cliente = $id_cliente;

                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_direccion;
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
                return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);
            }

            Yii::$app->session->setFlash('success', "Registro creado exitosamente.");
            return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);

        } else {
            return $this->render('create', [
                'model' => $model,
                'id_cliente' => $id_cliente,
            ]);
        }
    }

    /**
     * Updates an existing Direcciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_direccion Id Direccion
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_direccion, $id_cliente)
    {
        $model = $this->findModel($id_direccion);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                if (!$this->updatePrincipal($id_direccion)) {
                    if ($this->existePrincipal($id_cliente)) {
                        Yii::$app->session->setFlash('danger', "Ya exite una direccion principal");
                        return $this->redirect([
                            'direcciones/update', 
                            'id_direccion'=>$id_direccion, 
                            'id_cliente'=>$id_cliente, 
                            'model' => $model
                        ]);
                    }
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
                $model->id_cliente = $id_cliente;
                $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);
                
                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_direccion;
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
                return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);
            }

            Yii::$app->session->setFlash('success', "Registro actualizado exitosamente.");
            return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'id_cliente' => $id_cliente,
            ]);
        }
    }

    /**
     * Deletes an existing Direcciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_direccion Id Direccion
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_direccion, $id_cliente)
    {
        $model = $this->findModel($id_direccion);
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
            $bitacora->id_registro = $model->id_direccion;
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
            return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);
        }

        return $this->redirect(['clientes/view', 'id_cliente' => $id_cliente]);
    }

    /**
     * Finds the Direcciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_direccion Id Direccion
     * @return Direcciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_direccion)
    {
        if (($model = Direcciones::findOne(['id_direccion' => $id_direccion])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //dependencia para select muncipio en departamento
    public function actionMunicipios()
    {
        $out = [];
        $selected = null;
        
        if (isset($_POST['depdrop_parents'])) {

            $id = end($_POST['depdrop_parents']);
            $list = Municipios::find()->where(['id_departamento' => $id])->asArray()->all();

            if ($id != null && count($list) > 0) {
                $selected = '';
                if (!empty($_POST['depdrop_params'])) {
                    $id1 = $_POST['depdrop_all_params']['model_id1'];

                    foreach ($list as $municipio) {
                        $out[] = ['id' => $municipio['id_municipio'], 'name' => $municipio['nombre']];

                        if ($municipio['id_municipio'] == $id1) {
                            $selected = $id;
                        }
                    }
                }

                return Json::encode(['output' => $out, 'selected' => $selected]);
            }
        }
        return Json::encode(['output' => $out, 'selected' => $selected]);
    }

    private function updatePrincipal($id_direccion) {
        $principal = Direcciones::find()->where(['id_direccion' => $id_direccion, 'principal' => 1])->one();
        return $principal ? true : false;
    }

    private function existePrincipal($id_cliente){
        $exist = Direcciones::find()->where(['id_cliente' => $id_cliente, 'principal' => 1])->one();
        return $exist ? true : false;
    }

    private function superaLimiteIngreso($id_cliente){
        $count = Direcciones::find()->where(['id_cliente' => $id_cliente])->count();
        return (($count+1) <= 6) ? false : true;
    }
}
