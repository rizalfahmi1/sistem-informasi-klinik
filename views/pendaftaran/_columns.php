<?php

use mdm\admin\components\Helper;
use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nomor_pendaftaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_pasien',
        'value' => function ($model) {
            return $model->pasien->nama_lengkap;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggal_pendaftaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_dokter',
        'value' => function ($model) {
            return $model->dokter->nama_lengkap;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status_pendaftaran',
        'format' => 'raw',
        'value' => function ($model) {
            if ($model->status_pendaftaran == 0) {
                return Html::a('Proses', ['#'], ['class' => 'btn btn-danger btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            } else if ($model->status_pendaftaran == 1) {
                return Html::a('Pembayaran', ['#'], ['class' => 'btn btn-primary btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            } else {
                return Html::a('Selesai', ['#'], ['class' => 'btn btn-success btn-xs disabled', 'data-pjax' => 0, 'disabled' => true]);
            }
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => Helper::filterActionColumn('{view} {update} {delete} {check-pasien}'),
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'check-pasien' => function ($url, $model, $key) {
                return Html::a(
                    '<i class="fas fa-paper-plane"></i> ',
                    Url::toRoute(['pendaftaran/check-pasien', 'id' => $model->id]),
                    [
                        'class' => ' btn btn-sm btn-outline-info',
                        'title' => "Gunakan Ruang Rapat",
                    ]
                );
            },
        ],
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
