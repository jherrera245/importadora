<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ventas\models\Ventas $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
