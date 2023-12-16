<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Productos $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view', 'id_producto' => $model->id_producto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-update">
    
    <?= $this->render('_form-update', [
        'model' => $model,
        'initialPreviewPrincipal' => $initialPreview,
        'initialPreviewConfigPrincipal' => $initialPreviewConfig,
        'initialPreviewExtras' => $initialPreviewExtras,
        'initialPreviewConfigExtras' => $initialPreviewConfigExtras,
    ]) ?>

</div>
