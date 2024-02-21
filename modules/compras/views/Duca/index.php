<?php

use app\modules\compras\models\Duca;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DucaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ducas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duca-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Duca', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_duca',
            'no_correlativo',
            'no_duca',
            'fecha_aceptacion',
            'nombre_transportista',
            'modo_transporte',
            'pais_procedencia',
            'pais_destino',
            'pais_exportacion',
            //'id_compra',
            //'fecha_ing',
            //'id_usuario_ing',
            //'fecha_mod',
            //'id_usuario_mod',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Duca $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_duca' => $model->id_duca]);
                 }
            ],
        ],
    ]); ?>


</div>
