<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Proveedores $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
