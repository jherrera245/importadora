<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ordenes\models\Ordenes $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de ordenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
