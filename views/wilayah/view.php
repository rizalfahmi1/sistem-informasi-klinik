<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Wilayah */
?>
<div class="wilayah-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_wilayah',
            'jenis_wilayah',
            'id_induk',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
