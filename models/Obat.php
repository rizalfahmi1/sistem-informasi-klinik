<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "obat".
 *
 * @property int $id
 * @property string $kode_obat
 * @property string $nama_obat
 * @property int|null $id_jenis_obat
 * @property string $satuan
 * @property int $stok
 * @property float $harga_beli
 * @property float $harga_jual
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ResepObat[] $resepObats
 */
class Obat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obat';
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
            [['kode_obat', 'nama_obat', 'satuan', 'harga_beli', 'harga_jual', 'status'], 'required'],
            [['id_jenis_obat', 'stok', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['harga_beli', 'harga_jual'], 'number'],
            [['kode_obat', 'satuan'], 'string', 'max' => 20],
            [['nama_obat'], 'string', 'max' => 100],
            [['kode_obat'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kode_obat' => Yii::t('app', 'Kode Obat'),
            'nama_obat' => Yii::t('app', 'Nama Obat'),
            'id_jenis_obat' => 'Jenis Obat',
            'satuan' => Yii::t('app', 'Satuan'),
            'stok' => Yii::t('app', 'Stok'),
            'harga_beli' => Yii::t('app', 'Harga Beli'),
            'harga_jual' => Yii::t('app', 'Harga Jual'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[ResepObats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResepObats()
    {
        return $this->hasMany(ResepObat::class, ['id_obat' => 'id']);
    }

    public function getJenisObat()
    {
        return $this->hasOne(JenisObat::class, ['id' => 'id_jenis_obat']);
    }
}
