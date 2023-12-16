<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\OrdenesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ordenes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_orden') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'id_direccion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'anulado') ?>

    <?php // echo $form->field($model, 'fecha_ing') ?>

    <?php // echo $form->field($model, 'id_usuario_ing') ?>

    <?php // echo $form->field($model, 'fecha_mod') ?>

    <?php // echo $form->field($model, 'id_usuario_mod') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
