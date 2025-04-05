<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "wilayah".
 *
 * @property int $id
 * @property string $nama_wilayah
 * @property string $jenis_wilayah
 * @property int|null $id_induk
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Wilayah $induk
 * @property Wilayah[] $wilayahs
 */
class Wilayah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wilayah';
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
            [['nama_wilayah', 'jenis_wilayah'], 'required'],
            [['jenis_wilayah'], 'string'],
            [['id_induk', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nama_wilayah'], 'string', 'max' => 100],
            [['id_induk'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['id_induk' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama_wilayah' => Yii::t('app', 'Nama Wilayah'),
            'jenis_wilayah' => Yii::t('app', 'Jenis Wilayah'),
            'id_induk' => Yii::t('app', 'Id Induk'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Induk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInduk()
    {
        return $this->hasOne(Wilayah::class, ['id' => 'id_induk']);
    }

    /**
     * Gets query for [[Wilayahs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWilayahs()
    {
        return $this->hasMany(Wilayah::class, ['id_induk' => 'id']);
    }
}
