<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id
 * @property string $nomor_rekam_medis
 * @property string|null $nik
 * @property string $nama_lengkap
 * @property int $jenis_kelamin
 * @property int $tanggal_lahir
 * @property string $alamat
 * @property string $nomor_telepon
 * @property string|null $golongan_darah
 * @property string|null $informasi_alergi
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Pendaftaran[] $pendaftarans
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
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
            [['nomor_rekam_medis', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'nomor_telepon'], 'required'],
            [['jenis_kelamin', 'tanggal_lahir', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['alamat', 'golongan_darah', 'informasi_alergi'], 'string'],
            [['nomor_rekam_medis', 'nik', 'nomor_telepon'], 'string', 'max' => 20],
            [['nama_lengkap'], 'string', 'max' => 100],
            [['nomor_rekam_medis'], 'unique'],
            [['nik'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nomor_rekam_medis' => Yii::t('app', 'Nomor Rekam Medis'),
            'nik' => 'Nomor Induk Kependudukan',
            'nama_lengkap' => Yii::t('app', 'Nama Lengkap'),
            'jenis_kelamin' => Yii::t('app', 'Jenis Kelamin'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'alamat' => Yii::t('app', 'Alamat'),
            'nomor_telepon' => Yii::t('app', 'Nomor Telepon'),
            'golongan_darah' => Yii::t('app', 'Golongan Darah'),
            'informasi_alergi' => Yii::t('app', 'Informasi Alergi'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Pendaftarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, ['id_pasien' => 'id']);
    }
}
