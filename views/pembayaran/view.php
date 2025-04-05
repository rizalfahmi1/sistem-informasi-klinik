<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pembayaran */
?>
<div class="pembayaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor_pembayaran',
            'id_pendaftaran',
            'tanggal_pembayaran',
            'total_tagihan',
            'jumlah_bayar',
            'kembalian',
            'status_pembayaran',
            'catatan:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
