<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DetCompras $model */

$this->title = $model->id_det_compra;
$this->params['breadcrumbs'][] = ['label' => 'Det Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="det-compras-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_det_compra' => $model->id_det_compra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_det_compra' => $model->id_det_compra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_det_compra',
            'id_compra',
            'id_producto',
            'cantidad',
            'costo',
            'descuento',
            'uuid',
            'fecha_ing',
            'id_usuario_ing',
            'fecha_mod',
            'id_usuario_mod',
        ],
    ]) ?>

</div>
