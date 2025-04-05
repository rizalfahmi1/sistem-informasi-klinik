<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property string $nomor_pembayaran
 * @property int $id_pendaftaran
 * @property int|null $tanggal_pembayaran
 * @property float $total_tagihan
 * @property float $jumlah_bayar
 * @property float|null $kembalian
 * @property int|null $status_pembayaran
 * @property string|null $catatan
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Pendaftaran $pendaftaran
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_pembayaran', 'id_pendaftaran', 'total_tagihan', 'jumlah_bayar'], 'required'],
            [['id_pendaftaran', 'tanggal_pembayaran', 'status_pembayaran', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['total_tagihan', 'jumlah_bayar', 'kembalian'], 'number'],
            [['catatan'], 'string'],
            [['nomor_pembayaran'], 'string', 'max' => 20],
            [['nomor_pembayaran'], 'unique'],
            [['id_pendaftaran'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::class, 'targetAttribute' => ['id_pendaftaran' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nomor_pembayaran' => Yii::t('app', 'Nomor Pembayaran'),
            'id_pendaftaran' => Yii::t('app', 'Id Pendaftaran'),
            'tanggal_pembayaran' => Yii::t('app', 'Tanggal Pembayaran'),
            'total_tagihan' => Yii::t('app', 'Total Tagihan'),
            'jumlah_bayar' => Yii::t('app', 'Jumlah Bayar'),
            'kembalian' => Yii::t('app', 'Kembalian'),
            'status_pembayaran' => Yii::t('app', 'Status Pembayaran'),
            'catatan' => Yii::t('app', 'Catatan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Pendaftaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, ['id' => 'id_pendaftaran']);
    }
}
