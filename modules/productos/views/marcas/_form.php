<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\editors\Summernote;

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
                            <?= Html::activeLabel($model, 'nombre', ['class' => '¨form-label']) ?>
                            <?= $form->field($model, 'nombre', ['showLabels'=>false])->textInput([
                                'autofocus' => true,
                                'placeholder' => 'Ingresa el nombre de la marca'
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'descripcion', ['class' => '¨form-label']) ?>
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
                                    'placeholder' => 'Escribe la descripción de la marca'
                                ]
                            ]) ?>
                        </div>

                        <?php
                            if ($model->imagen) {
                                $preview = '<img src="'.$model->imagen.'" class="file-preview-image">';
                            }else {
                                $preview = NULL;
                            }
                        ?>

                        <div class="col-md-12">
                            <?= $form->field($model, 'imagenDb', ['showLabels'=>false])->hiddenInput(['value' => $model->imagen]) ?>
                            <?= $form->field($model, 'imagen')->widget(
                                FileInput::class,
                                [
                                    'options' => [
                                        'accept' => 'image/*', 
                                        'multiple' => false,
                                    ],
                                    'pluginOptions' => [
                                        'previewFileType' => 'image',
                                        'showUpload' => false,
                                        'initialPreview' => [
                                            $preview
                                        ]
                                    ]
                                ]
                            ); ?>
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


<?php $this->registerJs('
    $(".fileinput-remove-button").click(function(){
        document.querySelector("#marcas-imagendb").value = ""
    });
') ?>