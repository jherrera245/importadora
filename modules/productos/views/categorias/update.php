<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Marcas $model */

$this->title = 'Editar registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Categorías', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalles', 'url' => ['view', 'id_categoria' => $model->id_categoria]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
