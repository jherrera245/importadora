<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\inventario\models\KardexSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kardex-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_kardex') ?>

    <?= $form->field($model, 'id_documento') ?>

    <?= $form->field($model, 'cod_documento') ?>

    <?= $form->field($model, 'num_documento') ?>

    <?= $form->field($model, 'tipo_documento') ?>

    <?php // echo $form->field($model, 'id_producto') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'uuid') ?>

    <?php // echo $form->field($model, 'fecha_ing') ?>

    <?php // echo $form->field($model, 'id_usuario_ing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
