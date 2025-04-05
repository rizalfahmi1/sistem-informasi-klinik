<?php

use app\models\Pasien;
use app\models\Pegawai;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pendaftaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendaftaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_pendaftaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pasien')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pasien::find()->all(), 'id', 'nama_lengkap'),
        'theme' => Select2::THEME_KRAJEE,
        'options' => [
            'placeholder' => 'Pilih Nama Pasien',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'id_dokter')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pegawai::find()->where(['jabatan' => 'Dokter'])->all(), 'id', 'nama_lengkap'),
        'theme' => Select2::THEME_KRAJEE,
        'options' => [
            'placeholder' => 'Pilih Nama Dokter',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'keluhan')->textarea(['rows' => 6]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>