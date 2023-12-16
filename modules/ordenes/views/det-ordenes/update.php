<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\DetOrdenes $model */

$this->title = 'Update Det Ordenes: ' . $model->id_det_orden;
$this->params['breadcrumbs'][] = ['label' => 'Det Ordenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_det_orden, 'url' => ['view', 'id_det_orden' => $model->id_det_orden]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="det-ordenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
