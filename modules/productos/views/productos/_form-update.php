<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\editors\Summernote;
use kartik\widgets\Select2;
use app\modules\productos\models\Productos;
use app\modules\productos\models\SubCategorias;
use app\modules\productos\models\Categorias;
use app\modules\productos\models\CondicionProducto;
use app\modules\productos\models\Marcas;

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
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'nombre', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nombre', ['showLabels'=>false])->textInput([
                                'autofocus' => true,
                                'placeholder' => 'Ingresa el nombre del producto'
                            ]) ?>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <?= Html::activeLabel($model, 'id_marca', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_marca', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Marcas::find()->all(), 'id_marca', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona una marca',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'id_categoria', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_categoria', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Categorias::find()->all(), 'id_categoria', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona una categoría',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::hiddenInput('model_id1', $model->isNewRecord ? '' : $model->id_categoria, ['id' => 'model_id1']); ?>
                            <?= Html::activeLabel($model, 'id_sub_categoria', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_sub_categoria', ['showLabels' => false])->widget(DepDrop::class, [
                                'language' => 'es',
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => ['productos-id_categoria'],
                                    'initialize' => $model->isNewRecord ? false : true,
                                    'url' => Url::to(['/productos/sub-categorias/sub-categoria']),
                                    'placeholder' => 'Selecciona la sub categoría',
                                    'loadingText' => 'Cargando datos...',
                                    'params' => ['model_id1'], ///SPECIFYING THE PARAM
                                ]
                            ]); ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'precio', ['class' => 'form-label']) ?>
                            <?= $form->field(
                                    $model, 
                                    'precio',
                                    [
                                        'showLabels'=>false,
                                        'addon' => [ 
                                            'prepend' => [
                                                ['content' => '<i class="fas fa-dollar-sign"></i>'],
                                            ],
                                        ]
                                    ]
                                )->textInput([
                                    'autofocus' => true,
                                    'placeholder' =>'Ingresa el precio del producto'
                                ]) 
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'sku', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'sku', ['showLabels'=>false])->textInput([
                                'autofocus' => true,
                                'placeholder' => 'Ingresa el SKU del producto'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'iva', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'iva', ['showLabels'=>false])->textInput(['autofocus' => true, "value" => "13"]) ?>
                        </div>

                        <div class="col-md-12">
                            <?php
                                echo $form->field($model, 'is_car')->widget(SwitchInput::class, [
                                    'pluginOptions' => [
                                        'handleWidth' => 200,
                                        'onColor' => 'success',
                                        'offColor' => 'danger',
                                        'onText' => '<i class="fa fa-check"></i> Si es vehiculo',
                                        'offText' => '<i class="fa fa-ban"></i> No es un vehiculo'
                                    ]
                                ]);
                            ?>
                        </div>

                        <!--inicio  campos si es un auto-->

                        <div id="productos-car_field" class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= Html::activeLabel($model, 'pais_procedencia', ['class' => 'form-label']) ?>
                                    <?= $form->field($model, 'pais_procedencia', ['showLabels'=>false])->textInput([
                                        'autofocus' => true,
                                        'placeholder' => 'Ingresa el país de procedencia'
                                    ]) ?>
                                </div>

                                <div class="col-md-3">
                                    <?= Html::activeLabel($model, 'vin', ['class' => 'form-label']) ?>
                                    <?= $form->field($model, 'vin', ['showLabels'=>false])->textInput([
                                        'autofocus' => true,
                                        'placeholder' => 'Ingresa el vin del auto'
                                    ]) ?>
                                </div>

                                <div class="col-md-3">
                                    <?= Html::activeLabel($model, 'chasis_grabado', ['class' => 'form-label']) ?>
                                    <?= $form->field($model, 'chasis_grabado', ['showLabels'=>false])->textInput([
                                        'autofocus' => true,
                                        'placeholder' => 'Ingresa la datos de chasis'
                                    ]) ?>
                                </div>

                                <div class="col-md-3">
                                    <?= Html::activeLabel($model, 'year', ['class' => 'form-label']) ?>
                                    <?= $form->field($model, 'year', ['showLabels'=>false])->textInput([
                                        'autofocus' => true,
                                        'placeholder' => 'Ingresa año de fabricación ej. 2000'
                                    ]) ?>
                                </div>

                                <div class="col-md-6">
                                    <?= Html::activeLabel($model, 'id_condicion', ['class' => 'control-label']) ?>
                                    <?= $form->field($model, 'id_condicion', ['showLabels' => false])->widget(Select2::class, [
                                        'data' => ArrayHelper::map(CondicionProducto::find()->all(), 'id_condicion', 'nombre_condicion'),
                                        'language' => 'es',
                                        'options' => ['placeholder' => 'Selecciona la condicion del vehiculo',],
                                        'pluginOptions' => ['allowClear' => true],
                                    ]) ?>
                                </div>

                                <div class="col-md-6">
                                    <?= Html::activeLabel($model, 'tipo_combustible', ['class' => 'control-label']) ?>
                                    <?= $form->field($model, 'tipo_combustible', ['showLabels' => false])->widget(Select2::class, [
                                        'data' => [
                                            1 => 'Gasolina',
                                            2 => 'Diesel',
                                            3 => 'Electrico' 
                                        ],
                                        'language' => 'es',
                                        'options' => ['placeholder' => 'Selecciona el tipo de combustible',],
                                        'pluginOptions' => ['allowClear' => true],
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                         <!-- fin campos si es un auto-->

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
                                    'placeholder' => 'Escribe la descripción del producto'
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="control-label" for="subir-imagen">Imagen Principal</label>

                            <?=FileInput::widget([
                                'name' => 'upload_ajax_principal',
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'image/*'
                                ],
                                'pluginOptions' => [
                                    'lenguage' => 'es',
                                    'overwriteInitial' => false,
                                    'initialPreviewShowDelete' => true,
                                    'initialPreview' => $initialPreviewPrincipal,
                                    'encodeUrl' => false,
                                    'initialPreviewConfig' => $initialPreviewConfigPrincipal,
                                    'uploadUrl' => Url::to(['/productos/productos/upload-ajax']),
                                    'uploadExtraData' => [
                                        'id' => $model->id_producto,
                                    ],
                                    'maxFileCount' => 1,
                                    'maxFilesNum' => 1,
                                ],
                            ])?>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="control-label" for="subir-imagen">Imagenes Extras</label>

                            <?=FileInput::widget([
                                'name' => 'upload_ajax_extras[]',
                                'options' => [
                                    'multiple' => true,
                                    'accept' => 'image/*'
                                ],
                                'pluginOptions' => [
                                    'lenguage' => 'es',
                                    'overwriteInitial' => false,
                                    'initialPreviewShowDelete' => true,
                                    'initialPreview' => $initialPreviewExtras,
                                    'encodeUrl' => false,
                                    'initialPreviewConfig' => $initialPreviewConfigExtras,
                                    'uploadUrl' => Url::to(['/productos/productos/upload-ajax']),
                                    'uploadExtraData' => [
                                        'id' => $model->id_producto,
                                    ],
                                    'maxFileCount' => 5,
                                    'maxFilesNum' => 5,
                                ],
                            ])?>
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