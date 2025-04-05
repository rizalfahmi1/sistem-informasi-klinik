<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "pendaftaran".
 *
 * @property int $id
 * @property string $nomor_pendaftaran
 * @property int $id_pasien
 * @property string $tanggal_pendaftaran
 * @property int|null $id_dokter
 * @property string $keluhan
 * @property int|null $status_pendaftaran
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Pegawai $dokter
 * @property Pasien $pasien
 * @property Pembayaran[] $pembayarans
 * @property RekamMedis[] $rekamMedis
 */
class Pendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran';
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
            [['nomor_pendaftaran', 'id_pasien', 'tanggal_pendaftaran', 'keluhan'], 'required'],
            [['id_pasien', 'id_dokter', 'status_pendaftaran', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['tanggal_pendaftaran'], 'safe'],
            [['keluhan'], 'string'],
            [['nomor_pendaftaran'], 'string', 'max' => 20],
            [['nomor_pendaftaran'], 'unique'],
            [['id_dokter'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['id_dokter' => 'id']],
            [['id_pasien'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::class, 'targetAttribute' => ['id_pasien' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nomor_pendaftaran' => Yii::t('app', 'Nomor Pendaftaran'),
            'id_pasien' => 'Nama Pasien',
            'tanggal_pendaftaran' => Yii::t('app', 'Tanggal Pendaftaran'),
            'id_dokter' => 'Nama Dokter',
            'keluhan' => Yii::t('app', 'Keluhan'),
            'status_pendaftaran' => Yii::t('app', 'Status Pendaftaran'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Dokter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDokter()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'id_dokter']);
    }

    /**
     * Gets query for [[Pasien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(Pasien::class, ['id' => 'id_pasien']);
    }

    /**
     * Gets query for [[Pembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPembayarans()
    {
        return $this->hasMany(Pembayaran::class, ['id_pendaftaran' => 'id']);
    }

    /**
     * Gets query for [[RekamMedis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRekamMedis()
    {
        return $this->hasMany(RekamMedis::class, ['id_pendaftaran' => 'id']);
    }
}
