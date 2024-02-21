<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\compras\models\Duca $model */

$this->params['breadcrumbs'][] = ['label' => 'Ducas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
