<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\widgets\SwitchInput;
use kartik\editors\Summernote;
use kartik\widgets\Select2;
use app\modules\compras\models\Compras;
use yii\helpers\Url;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Duca $model */
/** @var yii\widgets\ActiveForm $form */

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
                            <?= Html::activeLabel($model, 'no_correlativo', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'no_correlativo', ['showLabels'=>false])->textInput(['autofocus' => true]) ?>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <?= Html::activeLabel($model, 'no_duca', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'no_duca', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'fecha_aceptacion', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'fecha_aceptacion', ['showLabels'=>false])->widget(
                                DatePicker::class, [
                                    'options' => [
                                        'placeholder' => 'Selecciona la fecha...'
                                    ],
                                    'pluginOptions' => [
                                        'autofocus' => true,
                                        'format' => 'yyyy-m-dd',
                                        'todayHighlight' => true,
                                    ]
                                ]
                            ) ?>
                        </div>


                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'nombre_transportista', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'nombre_transportista', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'modo_transporte', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'modo_transporte', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'pais_procedencia', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'pais_procedencia', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'pais_destino', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'pais_destino', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'pais_exportacion', ['class' => 'form-label']) ?>
                            <?= $form->field($model, 'pais_exportacion', ['showLabels'=>false])->textInput() ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'id_compra', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_compra', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(compras::find()->all(), 'id_compra', 'codigo'),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona una compra',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
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
