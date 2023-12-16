<?php

use app\modules\clientes\models\Clientes;
use app\modules\clientes\models\Direcciones;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\editors\Summernote;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

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
                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'id_cliente', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_cliente', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(Clientes::find()->all(), 'id_cliente', function($model) {
                                    return $model->nombre. ' '.$model->apellido; 
                                }),
                                'language' => 'es',
                                'options' => ['placeholder' => 'Selecciona un cliente',],
                                'pluginOptions' => ['allowClear' => true],
                            ]) ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::hiddenInput('model_id1', $model->isNewRecord ? '' : $model->id_cliente, ['id' => 'model_id1']); ?>
                            <?= Html::activeLabel($model, 'id_direccion', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_direccion', ['showLabels' => false])->widget(DepDrop::class, [
                                'language' => 'es',
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => ['ordenes-id_cliente'],
                                    'initialize' => $model->isNewRecord ? false : true,
                                    'url' => Url::to(['/ordenes/ordenes/direcciones']),
                                    'placeholder' => 'Selecciona una dirección para la entrega',
                                    'loadingText' => 'Cargando datos...',
                                    'params' => ['model_id1'], ///SPECIFYING THE PARAM
                                ]
                            ]); ?>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <?= Html::activeLabel($model, 'fecha', ['class' => '¨form-label']) ?>
                            <?= $form->field($model, 'fecha', ['showLabels'=>false])->widget(
                                DatePicker::class, [
                                    'options' => [
                                        'placeholder' => 'Selecciona la fecha de la compra...'
                                    ],
                                    'pluginOptions' => [
                                        'autofocus' => true,
                                        'format' => 'yyyy-m-dd',
                                        'todayHighlight' => true,
                                    ]
                                ]
                            ) ?>
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