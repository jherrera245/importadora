<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\SubCategorias $model */

$this->title = 'Crear registro';

if ($id_categoria) {
    $this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['categorias/index']];
    $this->params['breadcrumbs'][] = ['label' => $categoria, 'url' => ['categorias/view', 'id_categoria' => $id_categoria]];
}else {
    $this->params['breadcrumbs'][] = ['label' => 'Sub Categorias', 'url' => ['index']];   
}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-categorias-create">

    <?= $this->render('_form', [
        'model' => $model,
        'id_categoria' => $id_categoria
    ]) ?>

</div>
