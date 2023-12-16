<?php

namespace app\modules\productos\controllers;

use app\modules\productos\models\Marcas;
use app\modules\productos\models\MarcasSearch;
use app\models\Bitacora;
use app\controllers\CoreController;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use Yii;

/**
 * MarcasController implements the CRUD actions for Marcas model.
 */
class MarcasController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Marcas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MarcasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Marcas model.
     * @param int $id_marca Id Marca
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_marca)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_marca),
        ]);
    }

    /**
     * Creates a new Marcas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Marcas();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $image = UploadedFile::getInstance($model, 'imagen');

                if (empty($image)) {
                    $model->imagen = NULL;
                }else {
                    $tmp = explode('.', $image->name);
                    $ext = end($tmp);
                    $name = Yii::$app->security->generateRandomString() . ".{$ext}";
                    $path = Yii::$app->basePath . "/web/marcas/".$name;
                    $path2 = Yii::$app->request->baseUrl . "/marcas/".$name;
                    $model->imagen = $path2;

                    if (!$image->saveAS($path)) {
                        throw new Exception(
                            implode("<br>", \yii\helpers\ArrayHelper::getColumn($image->getErrors(), 0, false))
                        );
                    }
                }
                
                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_marca;
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
            return $this->redirect(['view', 'id_marca' => $model->id_marca]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Marcas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_marca Id Marca
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_marca)
    {
        $model = $this->findModel($id_marca);
        $imagen_modelo = $model->imagen;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $image = UploadedFile::getInstance($model, 'imagen');
                $imageDb = $_POST['Marcas']['imagenDb'];

                if (empty($imageDb) && empty($image)) {
                    if ($imagen_modelo != NULL) {
                        $ruta_borrar = Yii::$app->basePath . '/web'.$imagen_modelo;
                        unlink($ruta_borrar);
                        $model->imagen = NULL;
                    }else {
                        $model->imagen = NULL;
                    }
                }else {
                    $model->imagen = $imagen_modelo;
                }
                
                if(!empty($image)){
                    $tmp = explode('.', $image->name);
                    $ext = end($tmp);
                    $name = Yii::$app->security->generateRandomString() . ".{$ext}";
                    $path = Yii::$app->basePath . "/web/marcas/".$name;
                    $path2 = Yii::$app->request->baseUrl . "/marcas/".$name;
                    $model->imagen = $path2;

                    if (!$image->saveAS($path)) {
                        throw new Exception(
                            implode("<br>", \yii\helpers\ArrayHelper::getColumn($image->getErrors(), 0, false))
                        );
                    }

                    if (!empty($imageDb)) {
                        $ruta_borrar = Yii::$app->basePath . '/web'.$imageDb;
                        unlink($ruta_borrar);
                    }
                }

                $data_original = Json::encode($model->getAttributes(), JSON_PRETTY_PRINT);
                $data_modificada = Json::encode($model->getDirtyAttributes(), JSON_PRETTY_PRINT);
                
                if (!$model->save()) {
                    throw new Exception(
                        implode("<br>", \yii\helpers\ArrayHelper::getColumn($model->getErrors(), 0, false))
                    );
                }

                $bitacora = new Bitacora();
                $bitacora->id_registro = $model->id_marca;
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
            return $this->redirect(['view', 'id_marca' => $model->id_marca]);

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Marcas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_marca Id Marca
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_marca)
    {
        $model = $this->findModel($id_marca);
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
            $bitacora->id_registro = $model->id_marca;
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

        //Yii::$app->session->setFlash('success', "Registro actualizado exitosamente.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Marcas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_marca Id Marca
     * @return Marcas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_marca)
    {
        if (($model = Marcas::findOne(['id_marca' => $id_marca])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}