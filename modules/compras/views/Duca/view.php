<?php

Yii::$app->language = 'es_ES';
use yii\helpers\Html;
use coderius\lightbox2\Lightbox2;

/** @var yii\web\View $this */
/** @var app\modules\productos\models\Duca $model */

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Ducas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ducas-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa fa-list"></i>
                        <?=$model->no_correlativo?>
                    </h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Id:</th>
                            <td>
                                <span class="badge bg-purple"><?=$model->id_duca?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>No Correlativo:</th>
                            <td><?=$model->no_correlativo?></td>
                        </tr>
                        <tr>
                            <th>No Duca:</th>
                            <td>
                                <span class="badge bg-info"><?=$model->no_duca?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de aceptacion:</th>
                            <td><?=$model->fecha_aceptacion?></td>
                        </tr>
                        <tr>
                            <th>Nombre del transportista:</th>
                            <td><?=$model->nombre_transportista?></td>
                        </tr>
                        <tr>
                            <th>Modo de transporte:</th>
                            <td><?=$model->modo_transporte?></td>
                        </tr>
                        <tr>
                            <th>Pais de procedencia:</th>
                            <td><?=$model->pais_procedencia?></td>
                        </tr>
                        <tr>
                            <th>Pais de destino:</th>
                            <td><?=$model->pais_destino?></td>
                        </tr>
                        <tr>
                            <th>Pais de exportacion:</th>
                            <td><?=$model->pais_exportacion?></td>
                        </tr>
                        <tr>
                            <th>Referencia de Compra:</th>
                            <td>
                                <span class="badge bg-info"><?=$model->compra->codigo?></span>
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
                                'id_duca' => $model->id_duca,
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
                                'id_duca' => $model->id_duca
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