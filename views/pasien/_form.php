<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_rekam_medis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->widget(Select2::classname(), [
        'data' => [1 => "Laki-laki", 2 => "Perempuan"],
        'options' => ['placeholder' => 'Pilih Jenis Kelamin'],
        'pluginOptions' => [
            'allowClear' => true,
            'dropdownParent' => '#ajaxCrudModal'
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

    <?= $form->field($model, 'golongan_darah')->dropDownList(['A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O', 'Tidak Tahu' => 'Tidak Tahu',], ['prompt' => '']) ?>

    <?= $form->field($model, 'informasi_alergi')->textarea(['rows' => 6]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>