<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DucaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="duca-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_duca') ?>

    <?= $form->field($model, 'no_correlativo') ?>

    <?= $form->field($model, 'no_duca') ?>

    <?= $form->field($model, 'fecha_aceptacion') ?>

    <?= $form->field($model, 'nombre_transportista') ?>

    <?php // echo $form->field($model, 'modo_transporte') ?>

    <?php $form->field($model, 'pais_procedencia') ?>

    <?php // echo $form->field($model, 'pais_destino') ?>

    <?php $form->field($model, 'pais_exportacion') ?>

    <?php // echo $form->field($model, 'id_compra') ?>

    <?php // echo $form->field($model, 'fecha_ing') ?>

    <?php // echo $form->field($model, 'id_usuario_ing') ?>

    <?php // echo $form->field($model, 'fecha_mod') ?>

    <?php // echo $form->field($model, 'id_usuario_mod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
