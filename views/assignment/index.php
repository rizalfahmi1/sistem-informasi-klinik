<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
        'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
        'contentOptions' => ['style' => 'width:60%;text-align: center !important;background-image: url("img/background2.png")'],
    ],
    [
        'attribute' => 'username',
        'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
        'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
        'contentOptions' => ['style' => 'width:60%;text-align: center !important;background-image: url("img/background2.png")'],
    ],
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'kartik\grid\ActionColumn',
    'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
    'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
    'contentOptions' => ['style' => 'width:60%;text-align: center !important;background-image: url("img/background2.png")'],
    'template' => '{view}'
];
?>
<div class="assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>