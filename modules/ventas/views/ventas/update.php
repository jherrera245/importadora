<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ventas\models\Ventas $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalles', 'url' => ['view', 'id_venta' => $model->id_venta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ventas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
