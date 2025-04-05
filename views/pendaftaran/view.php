<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pendaftaran */
?>
<div class="pendaftaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor_pendaftaran',
            'id_pasien',
            'tanggal_pendaftaran',
            'id_dokter',
            'keluhan:ntext',
            'status_pendaftaran',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
