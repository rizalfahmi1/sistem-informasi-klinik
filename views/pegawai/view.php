<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
?>
<div class="pegawai-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'jabatan',
            [
                'label' => 'Tanggal Bergabung',
                'value' => function ($model) {
                    return Yii::$app->convert->ConvertTanggal(date('N-Y-m-d', $model->tanggal_bergabung));
                },
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Aktif' : 'Tidak Aktif';
                },
            ],
        ],
    ]) ?>

</div>