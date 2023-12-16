<?php

Yii::$app->language = 'es_ES';

use app\modules\clientes\models\Clientes;
use app\modules\clientes\models\Direcciones;
use app\models\Departamentos;
use app\models\Municipios;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DireccionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<div class="row">
    <div class="col-md-12">
        <div class="tbl-direcciones-index">

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
                        'attribute' => 'id_direccion',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::tag('span', $model->id_direccion, ['class' => 'badge bg-purple']);
                        },
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'id_departamento',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => 'departamento.nombre',
                        'width' => '150px',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Departamentos::find()->orderBy('nombre')->all(), 'id_departamento', 'nombre'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'id_municipio',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => 'municipio.nombre',
                        'width' => '200px',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Municipios::find()->orderBy('nombre')->all(), 'id_municipio', 'nombre'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'fecha_ing',
                        'vAlign' => 'middle',
                        'width' => '250px',
                        'value' => function($model) {
                            return date('d-m-y', strtotime($model->fecha_ing));
                        },
                        'filterType' => GridView::FILTER_DATE_RANGE,
                        'filterWidgetOptions' => ([
                            'model' => $searchModel,
                            'attribute' => 'fecha_ing',
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
                        'class' => 'kartik\grid\BooleanColumn',
                        'trueLabel' => 'Si',
                        'falseLabel' => 'No',
                        'trueIcon' => '<i class="fa fa-star text-warning"></i>',
                        'falseIcon' => '<i class="fa fa-star text-secondary"></i>',
                        'attribute' => 'principal',
                        'width' => '100px',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                        'vAlign' => 'middle',
                    ],
                    [
                        'class' => 'kartik\grid\BooleanColumn',
                        'trueLabel' => 'Si',
                        'falseLabel' => 'No',
                        'attribute' => 'estado',
                        'width' => '100px',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                        'vAlign' => 'middle',
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'Acciones',
                        'urlCreator' => function ($action, Direcciones $model) {
                            if ($action === 'view') {
                                return Url::toRoute(['/clientes/direcciones/view', 'id_direccion' => $model->id_direccion]);
                            }

                            if ($action === 'update') {
                                return Url::toRoute(['/clientes/direcciones/update', 'id_direccion' => $model->id_direccion, 'id_cliente'=>$model->id_cliente]);
                            }

                            if ($action === 'delete') {
                                return Url::toRoute(['/clientes/direcciones/delete', 'id_direccion' => $model->id_direccion, 'id_cliente'=>$model->id_cliente]);
                            }
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
                    'id' => 'kv-direcciones',
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
                            Html::a('<i class="fas fa-plus"></i> Agregar', ['direcciones/create', 'id_cliente' => $id_cliente], [
                                'class' => 'btn btn-success',
                                'data-pjax' => 0,
                            ]) . ' ' .
                                Html::a('<i class="fas fa-redo"></i>', ['view', 'id_cliente' => $id_cliente], [
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
                        'heading' => 'Listado de direcciones',
                    ],
                    'persistResize' => false,
                ]);
            ?>
        </div>
    </div>
</div>