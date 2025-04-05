<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Obat */
?>
<div class="obat-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_obat',
            'nama_obat',
            [
                'label' => 'Jenis Obat',
                'value' => function ($model) {
                    return $model->jenisObat->nama_jenis_obat;
                },
            ],
            'stok',
            'satuan',
            [
                'label' => 'Harga Beli',
                'value' => function ($model) {
                    return "Rp " . number_format($model->harga_beli, 0, ",", ".");
                },
            ],
            [
                'label' => 'Harga Jual',
                'value' => function ($model) {
                    return "Rp " . number_format($model->harga_jual, 0, ",", ".");
                },
            ],
            [
                'label' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? "Tersedia" : "Tidak Tersedia";
                },
            ],
        ],
    ]) ?>

</div>