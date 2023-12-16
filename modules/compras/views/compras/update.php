<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Compras $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view', 'id_compra' => $model->id_compra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="compras-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
