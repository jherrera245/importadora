<?php

use app\modules\ordenes\models\DetOrdenes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\DetOrdenesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Det Ordenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="det-ordenes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Det Ordenes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_det_orden',
            'id_orden',
            'id_producto',
            'cantidad',
            'precio',
            //'descuento',
            //'uuid',
            //'fecha_ing',
            //'id_usuario_ing',
            //'fecha_mod',
            //'id_usuario_mod',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DetOrdenes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_det_orden' => $model->id_det_orden]);
                 }
            ],
        ],
    ]); ?>


</div>
