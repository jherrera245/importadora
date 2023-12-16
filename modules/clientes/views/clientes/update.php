<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clientes\models\Clientes $model */

$this->title = 'Editar Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view', 'id_cliente' => $model->id_cliente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clientes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
