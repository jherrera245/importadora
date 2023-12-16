<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\inventario\models\InventarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inventario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_inventario') ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'id_producto') ?>

    <?= $form->field($model, 'existencia') ?>

    <?= $form->field($model, 'existencia_original') ?>

    <?php // echo $form->field($model, 'fecha_ing') ?>

    <?php // echo $form->field($model, 'id_usuario_ing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
