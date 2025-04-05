<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property int|null $id_user
 * @property string|null $nik
 * @property string $nama_lengkap
 * @property int $jenis_kelamin
 * @property int $tanggal_lahir
 * @property string $alamat
 * @property string $nomor_telepon
 * @property string $jabatan
 * @property int $tanggal_bergabung
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Pendaftaran[] $pendaftarans
 * @property User $user
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
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
            [['id_user', 'jenis_kelamin', 'tanggal_lahir', 'tanggal_bergabung', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'nomor_telepon', 'jabatan', 'tanggal_bergabung', 'status', 'nik'], 'required'],
            [['alamat'], 'string'],
            [['nik', 'nomor_telepon'], 'string', 'max' => 20],
            [['nama_lengkap'], 'string', 'max' => 100],
            [['jabatan'], 'string', 'max' => 50],
            [['id_user'], 'unique'],
            [['nik'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_user' => Yii::t('app', 'Id User'),
            'nik' => 'Nomor Induk Pegawai',
            'nama_lengkap' => Yii::t('app', 'Nama Lengkap'),
            'jenis_kelamin' => Yii::t('app', 'Jenis Kelamin'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'alamat' => Yii::t('app', 'Alamat'),
            'nomor_telepon' => Yii::t('app', 'Nomor Telepon'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'tanggal_bergabung' => Yii::t('app', 'Tanggal Bergabung'),
            'status' => Yii::t('app', 'Status'),
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
        return $this->hasMany(Pendaftaran::class, ['id_dokter' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
