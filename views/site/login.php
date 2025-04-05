<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Sistem Inventaris';
$this->params['breadcrumbs'][] = $this->title;
$imgUrl = Yii::getAlias('@web/login.jpg');
?>

<style>
.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}

.h-custom {
    height: calc(100% - 73px);
}

@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }
}
</style>

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4 ">
                <div class="card" style="width: 100%;">
                    <div class="card-header text-center" style="background-color: #57B4BA;color:white;">
                        <b style="font-size: 20px;">Sistem Informasi Klinik</b>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <?php $form = ActiveForm::begin(); ?>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <?= $form->field($model, 'rememberMe')->checkbox([
                                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]) ?>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <div class="form-group">
                                <div>
                                    <?= Html::submitButton('Login', ['class' => 'btn ', 'name' => 'login-button', 'style' => 'width:100%;background-color: #57B4BA; color:white;font-weight:bold;']) ?>
                                </div>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-6 col-xl-5 offset-xl-1">
                <img src="<?= $imgUrl ?>" class="img-fluid" alt="Sample image">
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 "
        style="background-color: #57B4BA;">
        <div class="text-white mb-3 mb-md-0">
            <?= "Copyright © " . date('Y') . " All rights reserved." ?>
        </div>
    </div>
</section>