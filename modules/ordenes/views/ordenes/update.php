<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\Ordenes $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de ordenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view', 'id_orden' => $model->id_orden]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ordenes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
