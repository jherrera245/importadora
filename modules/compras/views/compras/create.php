<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Compras $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compras-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
