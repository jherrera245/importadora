<?php

use app\modules\compras\models\DetCompras;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DetComprasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Det Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="det-compras-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Det Compras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_det_compra',
            'id_compra',
            'id_producto',
            'cantidad',
            'costo',
            //'descuento',
            //'uuid',
            //'fecha_ing',
            //'id_usuario_ing',
            //'fecha_mod',
            //'id_usuario_mod',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DetCompras $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_det_compra' => $model->id_det_compra]);
                 }
            ],
        ],
    ]); ?>


</div>
