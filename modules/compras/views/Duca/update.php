<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Duca $model */

$this->title = 'Update Duca: ' . $model->id_duca;
$this->params['breadcrumbs'][] = ['label' => 'Ducas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_duca, 'url' => ['view', 'id_duca' => $model->id_duca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="duca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
