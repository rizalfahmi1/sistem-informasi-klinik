<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  
    ?>

    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
            ],
            [
                'attribute' => 'name',
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
            ],
            [
                'attribute' => 'menuParent.name',
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
            [
                'attribute' => 'route',
                'filterOptions' => ['style' => 'background-image: url("img/backgroundxx.png")'],
                'headerOptions' => ['style' => 'text-align: center !important;color: white;background-image: url("img/backgroundxx.png")'],
                'contentOptions' => ['style' => 'text-align: center !important;background-image: url("img/background2.png")'],
            ],
            [
                'attribute' => 'order',
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
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>