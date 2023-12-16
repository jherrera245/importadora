<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clientes\models\Direcciones $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['clientes/view', 'id_cliente' => $id_cliente]];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view', 'id_direccion' => $model->id_direccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="direcciones-update">

    <?= $this->render('_form', [
        'model' => $model,
        'id_cliente' => $id_cliente,
    ]) ?>

</div>
