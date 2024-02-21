<?php

namespace app\modules\compras\controllers;


use app\modules\compras\models\Duca;
use app\modules\compras\models\DucaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii;
use Exception;

/**
 * DucaController implements the CRUD actions for Duca model.
 */
class DucaController extends Controller
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
     * Lists all Duca models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DucaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Duca model.
     * @param int $id_duca Id Duca
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_duca)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_duca),
        ]);
    }

    /**
     * Creates a new Duca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Duca();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_duca' => $model->id_duca]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Duca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_duca Id Duca
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_duca)
    {
        $model = $this->findModel($id_duca);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_duca' => $model->id_duca]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Duca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_duca Id Duca
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_duca)
    {
        $this->findModel($id_duca)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Duca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_duca Id Duca
     * @return Duca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_duca)
    {
        if (($model = Duca::findOne(['id_duca' => $id_duca])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
