<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JenisObat */
?>
<div class="jenis-obat-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_jenis_obat',
        ],
    ]) ?>

</div>