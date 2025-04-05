<?php

use app\models\AuthItem;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->widget(Select2::classname(), [
        'data' => [1 => "Laki-laki", 2 => "Perempuan"],
        'options' => ['placeholder' => 'Pilih Jenis Kelamin'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model_dinamis, 'tanggal_lahir')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Pilih Tanggal Lahir...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>
    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nomor_telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_dinamis, 'tanggal_bergabung')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Pilih Tanggal Lahir...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);
    ?>

    <?= $form->field($model_dinamis, 'role')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AuthItem::find()->where(['type' => 1])->all(), 'name', 'name'),
        'theme' => Select2::THEME_KRAJEE,
        'options' => [
            'placeholder' => 'Pilih Penugasan',
        ],
    ])->label('Pilih Penugasan') ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model_user, 'password_hash')->passwordInput() ?>
    <?php } ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>