<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "tindakan_medis".
 *
 * @property int $id
 * @property int $id_rekam_medis
 * @property int $id_tindakan
 * @property int|null $jumlah
 * @property float $biaya
 * @property string|null $catatan
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property RekamMedis $rekamMedis
 * @property Tindakan $tindakan
 */
class TindakanMedis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tindakan_medis';
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
            [['id_rekam_medis', 'id_tindakan', 'biaya'], 'required'],
            [['id_rekam_medis', 'id_tindakan', 'jumlah', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['biaya'], 'number'],
            [['catatan'], 'string'],
            [['id_rekam_medis'], 'exist', 'skipOnError' => true, 'targetClass' => RekamMedis::class, 'targetAttribute' => ['id_rekam_medis' => 'id']],
            [['id_tindakan'], 'exist', 'skipOnError' => true, 'targetClass' => Tindakan::class, 'targetAttribute' => ['id_tindakan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_rekam_medis' => Yii::t('app', 'Id Rekam Medis'),
            'id_tindakan' => Yii::t('app', 'Id Tindakan'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'biaya' => Yii::t('app', 'Biaya'),
            'catatan' => Yii::t('app', 'Catatan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[RekamMedis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRekamMedis()
    {
        return $this->hasOne(RekamMedis::class, ['id' => 'id_rekam_medis']);
    }

    /**
     * Gets query for [[Tindakan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakan()
    {
        return $this->hasOne(Tindakan::class, ['id' => 'id_tindakan']);
    }
}
