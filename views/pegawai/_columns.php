<?php

use kartik\date\DatePicker;
use kartik\grid\GridView;
use mdm\admin\components\Helper;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama_lengkap',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nik',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jenis_kelamin',
        'format' => 'raw',
        'filter' => [1 => 'Laki-laki', 0 => 'Perempuan'],
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'value' => function ($model) {
            if ($model->jenis_kelamin == 1) {
                return Html::a('Laki-laki', ['#'], ['class' => 'btn btn-success btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            } else {
                return Html::a('Perempuan', ['#'], ['class' => 'btn btn-primary btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            }
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'jabatan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggal_bergabung',
        'filter' => DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'tanggal_bergabung',
            'pjaxContainerId' => 'crud-datatable-pjax',
            'pluginOptions' => [
                'data-pjax' => 0,
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ],

            'options' => [
                'data-pjax' => 0,
                'autocomplete' => "off"
            ],
        ]),
        'value' => function ($model) {
            return Yii::$app->convert->ConvertTanggal(date('N-Y-m-d', $model->tanggal_bergabung));
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'filter' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'value' => function ($model) {
            if ($model->status == 1) {
                return Html::a('Aktif', ['#'], ['class' => 'btn btn-success btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            } else {
                return Html::a('Tidak Aktif', ['#'], ['class' => 'btn btn-danger btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            }
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => Helper::filterActionColumn('{view} {update} {delete}'),
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
        ],
    ],

];
