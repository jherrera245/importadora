<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Marcas $model */

$this->title = 'Editar registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalles', 'url' => ['view', 'id_marca' => $model->id_marca]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
