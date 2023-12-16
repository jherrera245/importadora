<?php

Yii::$app->language = 'es_ES';

use app\modules\compras\models\Compras;
use app\modules\compras\models\Proveedores;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\ComprasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Listado de compras';
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
                        'attribute' => 'id_compra',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::tag('span', $model->id_compra, ['class' => 'badge bg-purple']);
                        },
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'codigo',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->codigo,  ['view', 'id_compra' => $model->id_compra]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Compras::find()->orderBy('codigo')->all(), 'codigo', 'codigo'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'num_factura',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $widget) {
                            return Html::a($model->num_factura,  ['view', 'id_compra' => $model->id_compra]);
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Compras::find()->orderBy('num_factura')->all(), 'num_factura', 'num_factura'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'id_proveedor',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => 'proveedor.nombre',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Proveedores::find()->orderBy('nombre')->all(), 'id_proveedor', 'nombre'),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                          
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'tipo_compra',
                        'vAlign' => 'middle',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->tipo_compra != 0 ? 'Credito' : 'Contado';
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Compras::find()->orderBy('tipo_compra')->all(), 'tipo_compra', function ($model) {
                            return $model->tipo_compra != 0 ? 'Credito' : 'Contado';
                        }),
                        'filterWidgetOptions' => [
                            'options' => ['placeholder' => 'Todos...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\BooleanColumn',
                        'trueLabel' => 'Si',
                        'falseLabel' => 'No',
                        'trueIcon' => '<i class=" fa fa-light fa-store-slash text-warning"></i>',
                        'falseIcon' => '<i class=" fa fa-light fa-store text-primary"></i>',
                        'attribute' => 'anulado',
                        'width' => '120px',
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
                        'trueLabel' => 'Procesada',
                        'falseLabel' => 'Revisión',
                        'attribute' => 'estado',
                        'width' => '120px',
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
                        'urlCreator' => function ($action, Compras $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_compra' => $model->id_compra]);
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
                    'id' => 'kv-compras',
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
