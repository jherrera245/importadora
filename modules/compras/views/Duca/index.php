<?php

Yii::$app->language = 'es_ES';

use app\modules\compras\models\Duca;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\modules\compras\models\DucaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ducas';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="tbl-compras-index">

            <?php
                $gridColumns = [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'contentOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '36px',
                        'header' => '#',
                        'headerOptions' => ['class' => 'kartik-sheet-style']
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'width' => '80px',
                        'format' => 'raw',
                        'vAlign' => 'middle',
                        'hAlign' => 'center',
                        'attribute' => 'id_duca',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::tag('span', $model->id_duca, ['class' => 'badge bg-purple']);
                        },
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'no_correlativo',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->no_correlativo,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('no_correlativo')->all(), 'no_correlativo', 'no_correlativo'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'no_duca',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->no_duca,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('no_duca')->all(), 'no_duca', 'no_duca'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'fecha_aceptacion',
                        'vAlign' => 'middle',
                        'width' => '250px',
                        'value' => function($model) {
                            return date('d-m-y', strtotime($model->fecha_aceptacion));
                        },
                        'filterType' => GridView::FILTER_DATE_RANGE,
                        'filterWidgetOptions' => ([
                            'model' => $searchModel,
                            'attribute' => 'fecha_aceptacion',
                            'presetDropdown' => true,
                            'hideInput' => true,
                            'defaultPresetValueOptions' => ['style' => 'display: none'],
                            'convertFormat' => true,
                            'readonly' => true,
                            'options'=>[
                                'placeholder' => 'Selecciona el rango'
                            ],
                            'pluginOptions' => [
                                'locale' => ['format' => 'Y-m-d'],
                                'opens' => 'left'
                            ],
                        ]),
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'nombre_transportista',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->nombre_transportista,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('nombre_transportista')->all(), 'nombre_transportista', 'nombre_transportista'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'modo_transporte',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->nombre_transportista,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('modo_transporte')->all(), 'modo_transporte', 'modo_transporte'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ], 
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'pais_procedencia',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->pais_procedencia,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('pais_procedencia')->all(), 'pais_procedencia', 'pais_procedencia'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ], 
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'pais_destino',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->pais_destino,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('pais_destino')->all(), 'pais_destino', 'pais_destino'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'pais_exportacion',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->pais_exportacion,  ['view', 'id_duca' => $model->id_duca]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Duca::find()->orderBy('pais_exportacion')->all(), 'pais_exportacion', 'pais_exportacion'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],                                            
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'Acciones',
                        'urlCreator' => function ($action, Duca $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_duca' => $model->id_duca]);
                        }
                    ],
                ];

                $exportmenu = ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'exportConfig' => [
                        ExportMenu::FORMAT_TEXT => false,
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_CSV => false,
                    ],
                ]);

                echo GridView::widget([
                    'id' => 'kv-duca',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'pjax' => true, // pjax is set to always true for this demo
                    // set your toolbar
                    'toolbar' =>  [
                        [
                            'content' =>
                            Html::a('<i class="fas fa-plus"></i> Agregar', ['create'], [
                                'class' => 'btn btn-success',
                                'data-pjax' => 0,
                            ]) . ' ' .
                                Html::a('<i class="fas fa-redo"></i>', ['index'], [
                                    'class' => 'btn btn-outline-success',
                                    'data-pjax' => 0,
                                ]),
                            'options' => ['class' => 'btn-group mr-2']
                        ],
                        $exportmenu,
                        '{toggleData}',
                    ],
                    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                    // set export properties
                    // parameters from the demo form
                    'bordered' => true,
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'hover' => true,
                    //'showPageSummary'=>$pageSummary,
                    'panel' => [
                        'type' => 'dark',
                        'heading' => 'Listado de compra',
                    ],
                    'persistResize' => false,
                ]);
            ?>
        </div>
    </div>
</div>





