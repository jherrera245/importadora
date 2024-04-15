<?php

namespace app\modules\inventario\controllers;

use app\modules\inventario\models\Kardex;
use app\modules\inventario\models\KardexSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KardexController implements the CRUD actions for Kardex model.
 */
class KardexController extends Controller
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
     * Lists all Kardex models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new KardexSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kardex model.
     * @param int $id_kardex Id Kardex
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_kardex)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_kardex),
        ]);
    }

    /**
     * Creates a new Kardex model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Kardex();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_kardex' => $model->id_kardex]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kardex model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_kardex Id Kardex
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_kardex)
    {
        $model = $this->findModel($id_kardex);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_kardex' => $model->id_kardex]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kardex model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_kardex Id Kardex
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_kardex)
    {
        $this->findModel($id_kardex)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kardex model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_kardex Id Kardex
     * @return Kardex the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_kardex)
    {
        if (($model = Kardex::findOne(['id_kardex' => $id_kardex])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
