<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\clientes\models\Clientes $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Lista de clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
