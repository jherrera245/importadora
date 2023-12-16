<?php

Yii::$app->language = 'es_ES';
use yii\helpers\Html;
use coderius\lightbox2\Lightbox2;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Marcas $model */

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="marcas-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa fa-list"></i>
                        <?=$model->nombre?>
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Id:</th>
                            <td>
                                <span class="badge bg-purple"><?=$model->id_marca?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td><?=$model->nombre?></td>
                        </tr>
                        <tr>
                            <th>Descripción:</th>
                            <td><?=$model->descripcion?></td>
                        </tr>
                        <tr>
                            <th>Imagen:</th>
                            <td>
                                <?php if ($model->imagen == NULL) { ?>
                                    <img src="<?= Yii::$app->request->hostInfo ?>/marcas/no_imagen.jpg" width="150px">
                                <?php } else {
                                        echo Lightbox2::widget([
                                            'clientOptions' => [
                                                'resizeDuration' => 200,
                                                'wrapAround' => true,
                                            ]
                                        ]);

                                ?>

                                <a href="<?= Yii::$app->request->hostInfo . $model->imagen ?>" data-lightbox="roadtrip">
                                    <?php 
                                            echo Html::img(
                                                    Yii::$app->request->hostInfo . $model->imagen, 
                                                    [
                                                        'class' => 'img-thumbnail',
                                                        'width' => 250,
                                                    ]
                                            );

                                        }
                                    ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Creación:</th>
                            <td><?=date('d-m-Y H:m:i', strtotime($model->fecha_ing))?></td>
                        </tr>
                        <tr>
                            <th>Creado por:</th>
                            <td><?=$model->usuarioIng->nombreCompleto?></td>
                        </tr>
                        <tr>
                            <th>Fecha de Modificación:</th>
                            <td><?=date('d-m-Y H:m:i', strtotime($model->fecha_mod))?></td>
                        </tr>
                        <tr>
                            <th>Actualizado por:</th>
                            <td><?=$model->usuarioMod->nombreCompleto?></td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <span class="badge bg-<?=$model->estado == 1 ? 'green' : 'red'?>">
                                    <?= $model->estado == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <?php
                        echo Html::a(
                            '<i class="fa fa-edit"></i> Editar',
                            [
                                'update', 
                                'id_marca' => $model->id_marca
                            ], 
                            [
                                'class' => 'btn btn-primary',
                                'data-toggle' => 'tooltip',
                                'title' => 'Edit Record'
                            ]
                        );
                    ?>

                    <?php
                        echo Html::a(
                            '<i class="fa fa-undo"></i> Regresar',
                            ['index'], 
                            [
                                'class' => 'btn btn-warning',
                                'data-toggle' => 'tooltip',
                                'title' => 'Regresar'
                            ]
                        );
                    ?>

                    <?php
                        echo Html::a(
                            '<i class="fa fa-trash"></i> Eliminar',
                            [
                                'delete', 
                                'id_marca' => $model->id_marca
                            ], 
                            [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Esta seguro de querer eliminar este registro?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
