<?php

use app\models\Pegawai;
use yii\helpers\Html;


?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-white" style="background-image: url('img/background2.png')">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
            <?php //Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) 
            ?>
        </li> -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expandable="true">
                <i class="fa fa-user-alt"></i> User
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?= Html::a('<i class="fa fa-sign-out-alt"></i> Keluar', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->