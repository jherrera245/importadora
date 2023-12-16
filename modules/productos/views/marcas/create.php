<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Marcas $model */

$this->title = 'Crear Registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
