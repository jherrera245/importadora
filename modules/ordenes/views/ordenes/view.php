<?php

use app\modules\productos\models\Productos;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\editable\Editable;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\editors\Summernote;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\DetOrdenes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">Datos de la Orden <b># <?=$model->codigo?></b></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <th width=25%">Codigo</th>
                        <td width="15%">
                            <span class="badge bg-purple">
                                <?=$model->codigo?>
                            </span>
                        </td>
                        <th>Cliente</th>
                        <td>
                            <?=$model->cliente->nombre.' '.$model->cliente->apellido?>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td>
                            <?=$model->fecha?>
                        </td>
                        <th>Estado</th>
                        <td>
                            <span class="badge bg-<?=$model->estado == 0 ? "warning" : "red"?>">
                                <?=$model->estado == 0 ? "Sin Procesar" : "Procesada"?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="4">Dirección de entrega</th>
                    </tr>
                    <tr>
                        <th>Departamento</th>
                        <td colspan="2"><?=$model->direccion->departamento->nombre?></td>
                    </tr>
                    <tr>
                        <th>Municipio</th>
                        <td colspan="2"><?=$model->direccion->municipio->nombre?></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td colspan="2"><?=$model->direccion->direccion?></td>
                    </tr>
                    <tr>
                        <th>Total pagar</th>
                        <td colspan="3">
                            $ <?= number_format($total, 2) ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 text-left">
                        <?php 
                            if ($model->estado == 0) {
                                echo Html::a('<i class="fa fa-edit"></i> Editar', 
                                    ['update', 'id_orden' => $model->id_orden], 
                                    [
                                        'class' => 'btn btn-primary',
                                        'data-toogle' => 'tooltip',
                                        'title' => 'Editar Registro'
                                    ]
                                );
                            }else {
                                echo Html::a('<i class="fa fa-edit"></i> Editar', 
                                    ['update', 'id_orden' => $model->id_orden], 
                                    [
                                        'class' => 'btn btn-primary disabled',
                                        'data-toogle' => 'tooltip',
                                        'title' => 'Editar Registro'
                                    ]
                                );
                            }
                        ?>

                        <?php 
                            echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], 
                                [
                                    'class' => 'btn btn-danger',
                                    'data-toogle' => 'tooltip',
                                    'title' => 'Cancelar'
                                ]
                            );
                        ?>
                    </div>

                    <div class="col-md-6 col-sm-12 text-right">
                        <?php 
                            if ($model->estado == 0) {
                                echo Html::a('<i class="fa fa-plus"></i> Agregar Items', 
                                    ['/ordenes/det-ordenes/create', 'id_orden' => $model->id_orden], 
                                    [
                                        'class' => 'btn btn-info',
                                        'data-toogle' => 'tooltip',
                                        'title' => 'Add Items'
                                    ]
                                );
                            }else {
                                echo Html::a('<i class="fa fa-plus"></i> Agregar Items', 
                                    ['/ordenes/det-ordenes/create', 'id_orden' => $model->id_orden], 
                                    [
                                        'class' => 'btn btn-info disabled',
                                        'data-toogle' => 'tooltip',
                                        'title' => 'Add Items'
                                    ]
                                );
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="tbl-det-compras">
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
                        'format' => 'raw',
                        'vAlign' => 'middle',
                        'attribute' => 'id_producto',
                        'value' => function($model) {
                            return $model->producto->nombre;
                        },
                        'pageSummary' => 'Totales'
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'cantidad',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'width' => '150px',
                        'pageSummary' => true,
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'precio',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'width' => '150px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'descuento',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'width' => '150px',
                        'pageSummary' => true,
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\FormulaColumn',
                        'attribute' => 'Total Descuento',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return ($widget->col(2, $value) * $widget->col(3, $value) * ($widget->col(4, $value) /100));
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '15%',
                        'mergeHeader'=> true,
                        'pageSummary' => true,
                        'footer' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\FormulaColumn',
                        'attribute' => 'Sub-Total',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return (($widget->col(2, $value) * $widget->col(3, $value)) - $widget->col(5, $value));
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '15%',
                        'mergeHeader'=> true,
                        'pageSummary' => true,
                        'footer' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\FormulaColumn',
                        'attribute' => 'valor-neto',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return (($widget->col(6, $value) * 1.13));
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '15%',
                        'mergeHeader'=> true,
                        'pageSummary' => true,
                        'footer' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\FormulaColumn',
                        'attribute' => 'IVA',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return ($widget->col(7, $value) * 0.13);
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '10%',
                        'mergeHeader'=> true,
                        'pageSummary' => true,
                        'footer' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                ];

                echo GridView::widget([
                    'id' => 'kv-det-ordenes',
                    'dataProvider' => $grid,
                    'columns' => $gridColumns,
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'pjax' => true, // pjax is set to always true for this demo
                    // set your toolbar
                    'toolbar' =>  [],
                    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                    // set export properties
                    // parameters from the demo form
                    'bordered' => true,
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'hover' => true,
                    'showPageSummary'=> true,
                    'panel' => [
                        'type' => 'dark',
                        'heading' => 'Detalle de Orden',
                    ],
                    'persistResize' => false,
                ]);
            ?>
        </div>
    </div>
</div>