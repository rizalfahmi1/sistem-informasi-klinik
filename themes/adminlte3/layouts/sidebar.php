<?php

use mdm\admin\components\MenuHelper;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-image: url('img/backgroundxx.png')">
    <!-- Brand Logo -->
    <div class="brand-link">
        <!-- <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <!-- <span class="brand-text font-weight-light">Admin</span> -->
    </div>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 " style="text-align:center ;">

            <div class="info">
                <a href="#" class="d-block"><b>
                        <h5>Sistem Informasi Klinik</h5>
                    </b></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'options' => ['class' => 'site nav nav-pills nav-sidebar flex-column nav-child-indent nav-fixed nav-flatt', 'data-widget' => 'treeview', 'style' => ''],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->identity->id, 1)
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>