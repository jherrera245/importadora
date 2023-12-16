<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Categorias $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Categorías', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
