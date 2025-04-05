<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "resep_obat".
 *
 * @property int $id
 * @property int $id_rekam_medis
 * @property int $id_obat
 * @property int $jumlah
 * @property float $harga
 * @property string|null $dosis
 * @property string|null $catatan
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Obat $obat
 * @property RekamMedis $rekamMedis
 */
class ResepObat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resep_obat';
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
            [['id_rekam_medis', 'id_obat', 'jumlah', 'harga'], 'required'],
            [['id_rekam_medis', 'id_obat', 'jumlah', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['harga'], 'number'],
            [['dosis', 'catatan'], 'string'],
            [['id_obat'], 'exist', 'skipOnError' => true, 'targetClass' => Obat::class, 'targetAttribute' => ['id_obat' => 'id']],
            [['id_rekam_medis'], 'exist', 'skipOnError' => true, 'targetClass' => RekamMedis::class, 'targetAttribute' => ['id_rekam_medis' => 'id']],
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
            'id_obat' => Yii::t('app', 'Id Obat'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'harga' => Yii::t('app', 'Harga'),
            'dosis' => Yii::t('app', 'Dosis'),
            'catatan' => Yii::t('app', 'Catatan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Obat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObat()
    {
        return $this->hasOne(Obat::class, ['id' => 'id_obat']);
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
}
