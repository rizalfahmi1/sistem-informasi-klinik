<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
            [
                'attribute' => 'ruleName',
                'label' => Yii::t('rbac-admin', 'Rule Name'),
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
                'filter' => $rules
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
        ],
    ])
    ?>

</div>