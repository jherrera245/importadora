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
/** @var app\modules\compras\models\DetCompras $model */
/** @var yii\widgets\ActiveForm $form */

//echo Editable::widget([
    //'name'=>'adsda', 
    //'asPopover' => false,
    //'value' => 'Kartik Visweswaran',
    //'header' => 'Name',
    //'size'=>'md',
    //'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...']
//]);
?>

<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">Datos de la compra</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <th width=25%">Codigo</th>
                        <td width="25%">
                            <span class="badge bg-purple">
                                <?=$compra->codigo?>
                            </span>
                        </td>
                        <th width="25%">Número de Factura</th>
                        <td width="25%">
                            <?=$compra->num_factura?>
                        </td>
                    </tr>
                    <tr>
                        <th>Tipo de compra</th>
                        <td>
                            <?=$compra->tipo_compra == 0 ? 'Credito' : 'Contado' ?>
                        </td>
                        <th>Proveedor</th>
                        <td>
                            <?=$compra->proveedor->nombre?>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td>
                            <?=$compra->fecha?>
                        </td>
                        <th>Estado</th>
                        <td>
                            <span class="badge bg-<?=$compra->estado == 0 ? "warning" : "red"?>">
                                <?=$compra->estado == 0 ? "Sin Procesar" : "Procesada"?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Comentarios</th>
                        <td colspan="3">
                            <?=$compra->comentarios?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
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
                        <td width="40%"><h4>Total</h4></td>
                        <td><h4>$</h4></td>
                        <td><h4><?= number_format($total, 2) ?></h4></td>
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
                        Agregar detalle de compra
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <label for="">Producto</label>
                            <?= $form->field($model, 'id_producto', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Productos::find()->all(), 'id_producto', function($model) {
                                    return $model->sku.' '.$model->nombre;
                                }),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona un producto',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'cantidad', ['class' => 'form-label']) ?>
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
                                )->textInput(['type'=>'number']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'costo', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'costo',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'gastos_transporte', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'gastos_transporte',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'value'=>'0.00']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'seguro', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'seguro',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'value'=>'0.00']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'otros_gastos', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'otros_gastos',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'value'=>'0.00']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'detalle_otros_gastos', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'detalle_otros_gastos',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => ''],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'text']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'valor_aduana', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'valor_aduana',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number','readonly' => true]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'dai', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'dai',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'value'=>'0.00']) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'iva', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'iva',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'append' => [
                                                ['content' => '$'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['type'=>'number', 'step' => '0.01', 'readonly'=>'true']) ?>
                        </div>
                        
                    </div>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton(
                        $model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Actualizar', 
                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
                    ) ?>
                    <?= Html::a('<i class="fa fa-ban"></i> Cancelar', [
                        '/compras/compras/view', 'id_compra' => $compra->id_compra
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
                            return $model->producto->nombre . ' ' . $model->producto->marca->nombre . ' ' . $model->producto->chasis_grabado;
                        },
                        'pageSummary' => 'Totales',
                        'width' => '140px',
                        'hAlign' => 'center',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'cantidad',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-cantidad']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'costo',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-costo']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'gastos_transporte',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-gastos-transporte']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '90px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'otros_gastos',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-otros-gastos']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '90px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'valor_aduana',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-valor-aduana']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'dai',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-dai']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'iva',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-iva']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'apm',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-apm']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'vts',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-vts']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'its',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-its']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'aiv',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-aiv']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'opm',
                        'editableOptions' => [
                            'asPopover' => false,
                            'formOptions' => ['action' => ['/compras/det-compras/editar-opm']],
                            'inputType' => Editable::INPUT_TEXT,
                            'options' => [
                                'pluginOptions' => [
                                    'min' => 0,
                                ],
                            ],
                        ],
                        'refreshGrid' => true,
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'width' => '80px',
                        'pageSummary' => true,
                        'filter' => false,
                        'format' => 'currency',
                    ],
                    [
                        'class' => 'kartik\grid\FormulaColumn',
                        'attribute' => 'Sub-Total',
                        'hAlign' => 'center',
                        'vAlign' => 'middle',
                        'value' => function ($model, $key, $index, $widget) {
                            $value = compact('model', 'key', 'index');
                            return (($widget->col(2, $value) * $widget->col(3, $value)) - $widget->col(5, $value));
                        },
                        'headerOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '200px',
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
                                    '/compras/det-compras/delete',
                                    'id_det_compra' => $model->id_det_compra,
                                    'id_compra' => $model->id_compra,
                                ]);

                                return $url;
                            }
                        }
                    ]
                ];

                echo GridView::widget([
                    'id' => 'kv-det-compras',
                    'dataProvider' => $grid,
                    'columns' => $gridColumns,
                    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                    'tableOptions' =>['style' => 'width: 2500px;'],
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
                        'heading' => 'Detalle de compra',
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

        $('#detcompras-seguro').on('keyup', () => {
            loadValorAduana()
        });

        $('#detcompras-costo').on('keyup', () => {
            loadValorAduana()
        });

        $('#detcompras-gastos_transporte').on('keyup', () => {
            loadValorAduana()
        });

        $('#detcompras-otros_gastos').on('keyup', () => {
            loadValorAduana()
        });

        $('#detcompras-dai').on('change', () => {
            loadValorIVA()
        });

        loadValorAduana = () => {
            try{
                let gastos_transporte = $('#detcompras-gastos_transporte').val() != '' ? $('#detcompras-gastos_transporte').val() : 0;
                let costo = $('#detcompras-costo').val() != '' ? $('#detcompras-costo').val() : 0;
                let seguro = $('#detcompras-seguro').val() != '' ? $('#detcompras-seguro').val() : 0;
                let otros_gastos = $('#detcompras-otros_gastos').val() != '' ? $('#detcompras-otros_gastos').val() : 0;
                let totalAduana = parseFloat(gastos_transporte) + parseFloat(seguro) + parseFloat(otros_gastos) + parseFloat(costo)
                $('#detcompras-valor_aduana').val(totalAduana)
            }catch(e){
                console.log(e);
            }
        }

        loadValorIVA = () => {
            try{
                let valor_aduana = $('#detcompras-valor_aduana').val() != '' ? $('#detcompras-valor_aduana').val() : 0;
                let dai = $('#detcompras-dai').val() != '' ? $('#detcompras-dai').val() : 0;
                let totalIVA = (parseFloat(valor_aduana) + parseFloat(dai)) * 0.13
                if(dai == 0) {
                    $('#detcompras-iva').val(0);
                }else{
                    $('#detcompras-iva').val(totalIVA);
                }
            }catch(e){
                console.log(e);
            }
        }
        "
    );
?>