<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ventas\models\Ventas $model */

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Lista de ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">Datos de la venta: Orden <b># <?=$model->orden->codigo?></b></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <th width=15%">Codigo</th>
                        <td width="15%">
                            <span class="badge bg-purple">
                                <?=$model->codigo?>
                            </span>
                        </td>
                        <th width="25%">Número de Factura</th>
                        <td width="25%">
                            <?=$model->num_factura?>
                        </td>
                    </tr>
                    <tr>
                        <th>Tipo de Venta</th>
                        <td>
                            <?=$model->tipo_venta == 1 ? 'Credito' : 'Contado' ?>
                        </td>
                        <th>Cliente</th>
                        <td>
                            <?=$model->orden->cliente->nombre.' '.$model->orden->cliente->apellido?>
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
                        <th>Comentarios</th>
                        <td colspan="3">
                            <?=$model->comentarios?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12 text-left">
                        <?php 
                            if ($model->orden->estado == 0) {
                                echo Html::a('<i class="fa fa-edit"></i> Editar', 
                                    ['update', 'id_venta' => $model->id_venta], 
                                    [
                                        'class' => 'btn btn-primary',
                                        'data-toogle' => 'tooltip',
                                        'title' => 'Editar Registro'
                                    ]
                                );
                            }else {
                                echo Html::a('<i class="fa fa-edit"></i> Editar', 
                                    ['update', 'id_venta' => $model->id_venta], 
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="background: #ffdf7e;">
                        <table class="table table-sm text-right">
                            <tr>
                                <td width="40%"><h4>Sub-Total</h4></td>
                                <td><h4>$</h4></td>
                                <td><h4><?= number_format($sub_total, 2) ?></h4></td>
                            </tr>
                            <tr>
                                <td width="40%"><h4>IVA</h4></td>
                                <td><h4>$</h4></td>
                                <td><h4><?= number_format($iva, 2) ?></h4></td>
                            </tr>
                            <tr>
                                <td width="40%"><h4>Retención</h4></td>
                                <td><h4>$</h4></td>
                                <td><h4><?= number_format($retencion, 2) ?></h4></td>
                            </tr>
                            <tr>
                                <td width="40%"><h4>Total</h4></td>
                                <td><h4>$</h4></td>
                                <td><h4><?= number_format($total, 2) ?></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <?php 
                    if ($model->orden->estado == 0) {
                        echo Html::a('<i class="fa fa-edit"></i> Procesar Venta', 
                            ['inventario', 'id_venta' => $model->id_venta], 
                            [
                                'class' => 'btn btn-warning w-100',
                                'data-toogle' => 'tooltip',
                                'title' => 'Procesar Venta'
                            ]
                        );
                    }else {
                        echo Html::a('<i class="fa fa-edit"></i> Procesar Venta', 
                            ['inventario', 'id_venta' => $model->id_venta], 
                            [
                                'class' => 'btn btn-warning w-100 disabled',
                                'data-toogle' => 'tooltip',
                                'title' => 'Procesar Venta'
                            ]
                        );
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tbl-det-ventas">

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
                        'attribute' => 'IVA',
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return ($widget->col(6, $value) * 0.13);
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