<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
?>
<div class="pasien-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nomor_rekam_medis',
            'nik',
            'nama_lengkap',
            [
                'label' => 'Jenis Kelamin',
                'value' => function ($model) {
                    return $model->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
                },
            ],
            [
                'label' => 'Tanggal Lahir',
                'value' => function ($model) {
                    return Yii::$app->convert->ConvertTanggal(date('N-Y-m-d', $model->tanggal_lahir));
                },
            ],
            'alamat:ntext',
            'nomor_telepon',
            'golongan_darah',
            'informasi_alergi:ntext',
        ],
    ]) ?>

</div>