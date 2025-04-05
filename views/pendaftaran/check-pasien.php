<?php

use app\models\Pasien;
use app\models\Pegawai;
use app\models\Tindakan;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pendaftaran */

$this->title = 'Tindakan Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-check">
    <div class="check-form">
        <div class="card">
            <div class="card-header">
                Diagnosa Terhadap Pasien
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model_rekam_medis, 'diagnosa')->textarea(['rows' => 6]) ?>

                <?= $form->field($model_rekam_medis, 'catatan')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Tindakan Medis Terhadap Pasien
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model_tindakan, 'id_tindakan')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Tindakan::find()->all(), 'id', 'nama_tindakan'),
                    'theme' => Select2::THEME_KRAJEE,
                    'options' => [
                        'placeholder' => 'Pilih Nama Tindakan',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>

                <?= $form->field($model_tindakan, 'catatan')->textarea(['rows' => 6]) ?>
            </div>
        </div>

        <?php if (!Yii::$app->request->isAjax) { ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        <?php } ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>