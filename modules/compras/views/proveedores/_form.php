<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\depdrop\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\editors\Summernote;
use kartik\widgets\Select2;
use app\models\Departamentos;
use app\models\Municipios;

Yii::$app->language = 'es_ES';
?>

<div class="row">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <form role="form">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-edit"></i>
                        Crear / Editar Registro
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'codigo', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'codigo', ['showLabels'=>false])->textInput(['autofocus' => true]) ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'nombre', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nombre', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'razon_social', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'razon_social', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'giro', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'giro', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'nacionalidad', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nacionalidad', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'nit', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nit', ['showLabels'=>false])->widget(
                                MaskedInput::class, [
                                    'mask' => '9999-999999-999-9'
                                ]
                            )->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'dui', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'dui', ['showLabels'=>false])->widget(
                                MaskedInput::class, [
                                    'mask' => '99999999-9'
                                ]
                            )->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'nrc', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nrc', ['showLabels'=>false])->widget(
                                MaskedInput::class, [
                                    'mask' => '999999-9'
                                ]
                            )->textInput() ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'id_departamento', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_departamento', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Departamentos::find()->all(), 'id_departamento', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona un departamento',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::hiddenInput('model_id1', $model->isNewRecord ? '' : $model->id_departamento, ['id' => 'model_id1']); ?>
                            <?= Html::activeLabel($model, 'id_municipio', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_municipio', ['showLabels' => false])->widget(DepDrop::class, [
                                'language' => 'es',
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => ['proveedores-id_departamento'],
                                    'initialize' => $model->isNewRecord ? false : true,
                                    'url' => Url::to(['/compras/proveedores/municipios']),
                                    'placeholder' => 'Selecciona un municipio',
                                    'loadingText' => 'Cargando datos...',
                                    'params' => ['model_id1'], ///SPECIFYING THE PARAM
                                ]
                            ]); ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'email', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'email',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '<i class="fas fa-envelope"></i>'],
                                            ],
                                        ]
                                    ]
                                )->textInput(['autofocus' => true]) ?>
                        </div>
                        
                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'telefono', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'telefono',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '<i class="fas fa-phone"></i>'],
                                            ],
                                        ]
                                    ]
                                )->widget(
                                    MaskedInput::class, [
                                        'mask' => '9999-9999'
                                    ]
                                )->textInput(['autofocus' => true]) ?>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <?= Html::activeLabel($model, 'direccion_personal', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'direccion_personal', ['showLabels'=>false])->widget(Summernote::class ,[
                                'useKrajeePresets' => false,
                                'container' => [
                                    'class' => 'kv-editor-container'
                                ],
                                'pluginOptions' => [
                                    'height' => 200,
                                    'dialogsFade' => true,
                                    'toolbar' => [
                                        ['style1', ['style']],
                                        ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                                        ['font', ['fontname', 'fontsize', 'color', 'clear']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['insert', ['link', 'table', 'hr']],
                                    ],
                                    'fontSizes' => ['8', '9', '10', '11', '12', '13', '14', '16', '18', '20', '24', '36', '48'],
                                    'placeholder' => 'Escribe la direccion personal',
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <?= Html::activeLabel($model, 'direccion_comercial', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'direccion_comercial', ['showLabels'=>false])->widget(Summernote::class ,[
                                'useKrajeePresets' => false,
                                'container' => [
                                    'class' => 'kv-editor-container'
                                ],
                                'pluginOptions' => [
                                    'height' => 200,
                                    'dialogsFade' => true,
                                    'toolbar' => [
                                        ['style1', ['style']],
                                        ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                                        ['font', ['fontname', 'fontsize', 'color', 'clear']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['insert', ['link', 'table', 'hr']],
                                    ],
                                    'fontSizes' => ['8', '9', '10', '11', '12', '13', '14', '16', '18', '20', '24', '36', '48'],
                                    'placeholder' => 'Escribe la direccion comercial',
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'descripcion', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'descripcion', ['showLabels'=>false])->widget(Summernote::class ,[
                                'useKrajeePresets' => false,
                                'container' => [
                                    'class' => 'kv-editor-container'
                                ],
                                'pluginOptions' => [
                                    'height' => 200,
                                    'dialogsFade' => true,
                                    'toolbar' => [
                                        ['style1', ['style']],
                                        ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                                        ['font', ['fontname', 'fontsize', 'color', 'clear']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['insert', ['link', 'table', 'hr']],
                                    ],
                                    'fontSizes' => ['8', '9', '10', '11', '12', '13', '14', '16', '18', '20', '24', '36', '48'],
                                    'placeholder' => 'Escribe la descripción del proveedor'
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?php
                                echo $form->field($model, 'contribuyente')->widget(SwitchInput::class, [
                                    'pluginOptions' => [
                                        'handleWidth' => 80,
                                        'onColor' => 'success',
                                        'offColor' => 'danger',
                                        'onText' => '<i class="fa fa-check"></i> Si',
                                        'offText' => '<i class="fa fa-ban"></i> No'
                                    ]
                                ]);
                            ?>
                        </div>

                        <div class="col-md-12">
                            <?php
                                echo $form->field($model, 'estado')->widget(SwitchInput::class, [
                                    'pluginOptions' => [
                                        'handleWidth' => 80,
                                        'onColor' => 'success',
                                        'offColor' => 'danger',
                                        'onText' => '<i class="fa fa-check"></i> Activo',
                                        'offText' => '<i class="fa fa-ban"></i> Inactivo'
                                    ]
                                ]);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <?= Html::submitButton(
                        $model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Actualizar', 
                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
                    ) ?>
                    <?= Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
                </div>

            </div>
        </form>
    <?php ActiveForm::end(); ?>
    </div>
</div>