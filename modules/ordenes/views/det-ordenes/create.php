<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\DetCompras $model */

$this->title = 'Agregar Detalle de Orden';
$this->params['breadcrumbs'][] = ['label' => 'Listado de ordenes', 'url' => ['ordenes/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="det-ordenes-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'orden' => $orden,
        'grid' => $grid,
        'sub_total' => $sub_total,
        'iva' => $iva,
        'total' => $total,
        'retencion' => $retencion,
    ]) ?>

</div>
