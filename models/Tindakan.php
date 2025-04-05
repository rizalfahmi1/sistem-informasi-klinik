<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "tindakan".
 *
 * @property int $id
 * @property string $kode_tindakan
 * @property string $nama_tindakan
 * @property string|null $deskripsi
 * @property float $biaya
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property TindakanMedis[] $tindakanMedis
 */
class Tindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tindakan';
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
            [['kode_tindakan', 'nama_tindakan', 'biaya', 'status'], 'required'],
            [['deskripsi'], 'string'],
            [['biaya'], 'number'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['kode_tindakan'], 'string', 'max' => 20],
            [['nama_tindakan'], 'string', 'max' => 100],
            [['kode_tindakan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kode_tindakan' => Yii::t('app', 'Kode Tindakan'),
            'nama_tindakan' => Yii::t('app', 'Nama Tindakan'),
            'deskripsi' => Yii::t('app', 'Deskripsi'),
            'biaya' => Yii::t('app', 'Biaya'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[TindakanMedis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakanMedis()
    {
        return $this->hasMany(TindakanMedis::class, ['id_tindakan' => 'id']);
    }
}
