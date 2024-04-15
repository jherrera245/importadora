<?php

use yii\helpers\Url;
?>
<style>
.brand-link {
    border-bottom: none !important;
}
</style>

<aside class="main-sidebar sidebar-dark-warning elevation-4" style="z-index: 1040 !important;">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link logo-switch">
        <img src="/logo-mini.png" alt="Logo" class="brand-image-xl logo-xs">
        <img src="/logo.png" alt="Logo" class="brand-image-xs logo-xl" style="left: 12px">
        </br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">

                <!------- DASHBOARD ------->
                <?php if (Yii::$app->controller->id == 'site' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                    $li = "nav-item active";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item ";
                    $a = "nav-link ";
                }
                ?>
                <li class="<?= $li ?>">
                    <a class="<?= $a ?>" href="<?php echo Url::toRoute(['/site/index']); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!------- END DASHBOARD ------->

                <!------- MÓDULO PRODUCTOS ------->
                <?php if (in_array(\Yii::$app->controller->id, ['marcas', 'categorias', 'sub-categorias', 'productos'])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Productos <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'marcas' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/productos/marcas/index']); ?>">
                                <i class="nav-icon far fa-circle text-yellow"></i>
                                <p>Marcas</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->

                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'categorias' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/productos/categorias/index']); ?>">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->

                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'sub-categorias' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/productos/sub-categorias/index']); ?>">
                                <i class="nav-icon far fa-circle text-green"></i>
                                <p>Sub Categorías</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->

                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'productos' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/productos/productos/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->
                    </ul>
                </li>
                <!------- FIN MENU MÓDULO PRODUCTOS  ------->


                
                <!------- MÓDULO COMPRAS ------->
                <?php if (in_array(\Yii::$app->controller->id, ['proveedores', 'compras', 'duca'])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-store"></i>
                        <p>Compras <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'proveedores' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/compras/proveedores/index']); ?>">
                                <i class="nav-icon far fa-circle text-yellow"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <!--------------------------------------------------> 

                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'compras' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/compras/compras/index']); ?>">
                                <i class="nav-icon far fa-circle text-green"></i>
                                <p>Compras</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->
                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'duca' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/compras/duca/index']); ?>">
                                <i class="nav-icon far fa-circle text-red"></i>
                                <p>Duca</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->
                    </ul>
                </li>
                <!------- FIN MENU MÓDULO COMPRAS  ------->


                <!------- MÓDULO CLIENTES ------->
                <?php if (in_array(\Yii::$app->controller->id, ['clientes', 'direcciones'])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Clientes <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (in_array(\Yii::$app->controller->id, ['clientes', 'direcciones']) && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/clientes/clientes/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->
                    </ul>
                </li>
                <!------- FIN MENU MÓDULO CLIENTES  ------->

                <!------- MÓDULO ORDENES ------->
                <?php if (in_array(\Yii::$app->controller->id, ['ordenes', 'det-ordenes'])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Ordenes <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (in_array(Yii::$app->controller->id, ['ordenes', 'det-ordenes']) && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/ordenes/ordenes/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Ordenes</p>
                            </a>
                        </li>
                        <!-------------------------------------------------->
                    </ul>
                </li>
                <!------- FIN MENU MÓDULO ORDENES  ------->


                <!------- MÓDULO VENTAS ------->
                <?php if (in_array(\Yii::$app->controller->id, ['ventas',])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>Ventas <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'ventas' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/ventas/ventas/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                        <!--------------------------------------------------> 
                    </ul>
                </li>
                <!------- FIN MENU MÓDULO VENTAS  ------->

                <!------- MÓDULO INVENTARIO ------->
                
                <?php if (in_array(\Yii::$app->controller->id, ['inventario', 'kardex'])) {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Inventario <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'inventario' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/inventario/inventario/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                        <!------------------------------------- SUBMODULO KARDEX --------------------------------------------------------------------->
                        <?php if (Yii::$app->controller->id == 'kardex' && in_array(\Yii::$app->controller->action->id, ['index', 'create', 'update', 'view'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/inventario/kardex/index']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Kardex</p>
                            </a>
                        </li>
                        <!------------------------------------- FIN SUBMODULO KARDEX --------------------------------------------------------------------->
                        <!--------------------------------------------FIN MODULO INVENTARIO--------------------------------------------------------------> 
                    </ul>
                </li>

                <!------- MENU USUARIOS ------->
                <?php if (Yii::$app->controller->id == 'usuarios' || Yii::$app->controller->id == 'route' || Yii::$app->controller->id == 'permission' || Yii::$app->controller->id == 'role' || Yii::$app->controller->id == 'assignment') {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuarios <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <?php if (Yii::$app->controller->id == 'usuarios' && in_array(\Yii::$app->controller->action->id, ['index', 'signup'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/usuarios/index']); ?>">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Gestionar usuarios </p>
                            </a>
                        </li>

                        <?php if (Yii::$app->controller->id == 'route' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/route']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Gestionar rutas </p>
                            </a>
                        </li>

                        <?php if (Yii::$app->controller->id == 'permission' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>

                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/permission']); ?>">
                                <i class="nav-icon far fa-circle text-purple"></i>
                                <p>Gestionar permisos </p>
                            </a>
                        </li>


                        <?php if (Yii::$app->controller->id == 'role' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/role']); ?>">
                                <i class="nav-icon far fa-circle text-green"></i>
                                <p>Gestionar roles </p>
                            </a>
                        </li>

                        <?php if (Yii::$app->controller->id == 'assignment' && in_array(\Yii::$app->controller->action->id, ['index'])) {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/rbac/assignment']); ?>">
                                <i class="nav-icon far fa-circle text-yellow"></i>
                                <p>Asignar rol </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!------- FIN MENU USUARIOS ------->

                <!------- MENU DEVS ------->
                <?php if (Yii::$app->controller->id == 'gii' || Yii::$app->controller->id == 'debug') {
                    $li = "nav-item has-treeview active menu-open";
                    $a = "nav-link active";
                } else {
                    $li = "nav-item has-treeview";
                    $a = "nav-link";
                } ?>
                <li class="<?= $li; ?>">
                    <a class="<?= $a; ?>" href="#">
                        <i class="nav-icon fas fa-file-code"></i>
                        <p>Devs <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <?php if (Yii::$app->controller->id == 'gii') {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/gii']); ?>">
                            <i class="nav-icon far fa-circle text-danger"></i>
                                <p>Gii </p>
                            </a>
                        </li>

                        <?php if (Yii::$app->controller->id == 'debug') {
                            $li = "nav-item active";
                            $a = "nav-link active";
                        } else {
                            $li = "nav-item";
                            $a = "nav-link";
                        }
                        ?>
                        <li class="<?= $li; ?>">
                            <a class="<?= $a; ?>" href="<?php echo Url::toRoute(['/debug']); ?>">
                                <i class="nav-icon far fa-circle text-blue"></i>
                                <p>Debug </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!------- FIN MENU DEVS ------->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>