<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DetCompras $model */

$this->title = 'Update Det Compras: ' . $model->id_det_compra;
$this->params['breadcrumbs'][] = ['label' => 'Det Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_det_compra, 'url' => ['view', 'id_det_compra' => $model->id_det_compra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="det-compras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
