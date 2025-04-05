<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "rekam_medis".
 *
 * @property int $id
 * @property int $id_pendaftaran
 * @property string|null $diagnosa
 * @property string|null $catatan
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Pendaftaran $pendaftaran
 * @property ResepObat[] $resepObats
 * @property TindakanMedis[] $tindakanMedis
 */
class RekamMedis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekam_medis';
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
            [['id_pendaftaran'], 'required'],
            [['id_pendaftaran', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['diagnosa', 'catatan'], 'string'],
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
            'id_pendaftaran' => Yii::t('app', 'Id Pendaftaran'),
            'diagnosa' => Yii::t('app', 'Diagnosa'),
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

    /**
     * Gets query for [[ResepObats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResepObats()
    {
        return $this->hasMany(ResepObat::class, ['id_rekam_medis' => 'id']);
    }

    /**
     * Gets query for [[TindakanMedis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakanMedis()
    {
        return $this->hasMany(TindakanMedis::class, ['id_rekam_medis' => 'id']);
    }
}
