<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clientes\models\Direcciones $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de clientes', 'url' => ['clientes/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['clientes/view', 'id_cliente' => $id_cliente]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direcciones-create">

    <?= $this->render('_form', [
        'model' => $model,
        'id_cliente' => $id_cliente,
    ]) ?>

</div>
