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
                <h3 class="card-title">Datos de la Orden: <b># <?=$orden->codigo?></b></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <th width=25%">Codigo</th>
                        <td width="15%">
                            <span class="badge bg-purple">
                                <?=$orden->codigo?>
                            </span>
                        </td>
                        <th>Cliente</th>
                        <td>
                            <?=$orden->cliente->nombre.' '.$orden->cliente->apellido?>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td>
                            <?=$orden->fecha?>
                        </td>
                        <th>Estado</th>
                        <td>
                            <span class="badge bg-<?=$orden->estado == 0 ? "warning" : "red"?>">
                                <?=$orden->estado == 0 ? "Sin Procesar" : "Procesada"?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="4">Dirección de entrega</th>
                    </tr>
                    <tr>
                        <th>Departamento</th>
                        <td colspan="2"><?=$orden->direccion->departamento->nombre?></td>
                    </tr>
                    <tr>
                        <th>Municipio</th>
                        <td colspan="2"><?=$orden->direccion->municipio->nombre?></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td colspan="2"><?=$orden->direccion->direccion?></td>
                    </tr>
                    <tr>
                        <th>Total pagar</th>
                        <td colspan="3">
                            $ <?= number_format($total, 2) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin(['id'=>'crear-form'], ['options' => ['enctype' => 'multipart/form-data']]); ?>
        <form role="form">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-edit"></i>
                        Agregar detalle de orden
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'id_producto', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_producto', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Productos::find()->all(), 'id_producto', function($model) {
                                    return $model->sku.' '.$model->nombre;
                                }),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona un producto',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'existencia', ['class' => '¨form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'existencia',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '#'],
                                            ],
                                        ],
                                    ],
                                )->textInput(['type'=>'number', 'readonly' => true]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'cantidad', ['class' => '¨form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'cantidad',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '#'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'min'=>'1']) ?>
                        </div>
                        <?php
                            if ($orden->cliente->contribuyente == 1) {   ?>
                                <div class="col-md-4 col-sm-12">
                                    <?= Html::activeLabel($model, 'credito_fiscal', ['class' => '¨form-label']) ?>
                                    <?= $form->field(
                                            $model, 
                                            'credito_fiscal',
                                            [
                                                'showLabels'=>false,
                                                'addon' => [ 
                                                    'prepend' => [
                                                        ['content' => '$'],
                                                    ],
                                                ]
                                            ]
                                        )->textInput(['type'=>'number', 'step' => '0.01', 'readonly' => false]) ?>
                                    </div>
                                
                        <?php } else { ?>
                            <div class="col-md-4 col-sm-12">
                                <?= Html::activeLabel($model, 'consumidor_final', ['class' => '¨form-label']) ?>
                                <?= $form->field($model, 'consumidor_final', ['showLabels'=>false])->textInput(['autofocus' => true]) ?>
                            </div>
                        <?php } ?>
                
                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'precio', ['class' => '¨form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'precio',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'readonly' => true]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'descuento', ['class' => '¨form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'descuento',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '%'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'min'=>'0', 'step' => '0.01', 'value'=>'0.00']) ?>
                        </div>
                        
                    </div>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton(
                        $model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Actualizar', 
                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
                    ) ?>
                    <?= Html::a('<i class="fa fa-ban"></i> Cancelar', [
                        '/ordenes/ordenes/view', 'id_orden' => $orden->id_orden
                        ], ['class' => 'btn btn-danger']
                    ) ?>
                </div>

            </div>
        </form>
    <?php ActiveForm::end(); ?>
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
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'cantidad',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/ordenes/det-ordenes/editar-cantidad']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0, 
                                    'max' => 10000,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'width' => '150px',
                        'pageSummary' => true,
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'precio',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/ordenes/det-ordenes/editar-precio']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0, 
                                    'max' => 10000,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'right',
                        'vAlign' => 'middle',
                        'width' => '150px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'descuento',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/ordenes/det-ordenes/editar-descuento']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0, 
                                    'max' => 10000,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
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
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'Acciones',
                        'template' => '{delete}',
                        'width' => '80px',
                        'vAlign' => GridView::ALIGN_BOTTOM,
                        'buttons' => [
                            'delete' => function($url) {
                                return Html::a(
                                    '<span class="fa fa-trash-alt text-danger"></span>',
                                    $url,
                                    [
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Esta seguro de borrar este registro?'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]
                                );
                            }
                        ],
                        'urlCreator' => function($action, $model) {
                            if ($action === 'delete') {
                                $url = Url::to([
                                    '/ordenes/det-ordenes/delete',
                                    'id_det_orden' => $model->id_det_orden,
                                    'id_orden' => $model->id_orden,
                                ]);

                                return $url;
                            }
                        }
                    ]
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

<?php
    echo $this->registerJs(
        "
        $('#detordenes-id_producto').on('change', () => {
            loadPrecioProducto()
        });

        $('#detordenes-cantidad').on('change', (e) => {
            changenValue(e.target)
        })

        $('#detordenes-cantidad').on('keyup', (e) => {
            changenValue(e.target)
        })

        const changenValue = (input) => {
            let value = parseInt(input.value)
            let max = parseInt(input.max)
            let min = parseInt(input.min)

            if (value > max) {
                input.value = max
            }else if (value < min) {
                input.value = min
            }
        }

        loadPrecioProducto = () => {
            let id = $('#detordenes-id_producto').val()
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '?r=ordenes/det-ordenes/detalle&id_producto='+id,
                success: function (response) {
                    console.log(response)

                    if(response.disponible) {
                        $('#detordenes-precio').val(response.precio)
                        $('#detordenes-existencia').val(response.existencias)
                        $('#detordenes-cantidad').attr('max', response.existencias)
                    }else {
                        alert('Este producto no esta disponible')
                        $('#detordenes-precio').val(null)
                        $('#detordenes-existencia').val(null)
                    }
                }
            });
        }
        "
    );
?>