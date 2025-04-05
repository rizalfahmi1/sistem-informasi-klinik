<?php

use app\models\JenisObat;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kode_obat',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama_obat',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_jenis_obat',
        'filter' => ArrayHelper::map(JenisObat::find()->all(), 'id', 'nama_jenis_obat'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'value' => function ($model) {
            return $model->jenisObat->nama_jenis_obat;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'satuan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'stok',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'harga_beli',
        'value' => function ($model) {
            return "Rp " . number_format($model->harga_beli, 0, ",", ".");
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'harga_jual',
        'value' => function ($model) {
            return "Rp " . number_format($model->harga_jual, 0, ",", ".");
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'filter' => [1 => 'Tersedia', 0 => 'Tidak Tersedia'],
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => ['allowClear' => true],
        ],
        'value' => function ($model) {
            return $model->status == 1 ? "Tersedia" : "Tidak Tersedia";
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
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