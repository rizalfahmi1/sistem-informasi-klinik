<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */
?>
<div class="pasien-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_dinamis' => $model_dinamis
    ]) ?>

</div>