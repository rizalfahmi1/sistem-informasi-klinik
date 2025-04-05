<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

?>
<div class="pegawai-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_user' => $model_user,
        'model_dinamis' => $model_dinamis,
    ]) ?>
</div>