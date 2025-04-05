<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pendaftaran;

/**
 * PendaftaranSearch represents the model behind the search form about `app\models\Pendaftaran`.
 */
class PendaftaranSearch extends Pendaftaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pasien', 'id_dokter', 'status_pendaftaran', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nomor_pendaftaran', 'tanggal_pendaftaran', 'keluhan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pendaftaran::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_pasien' => $this->id_pasien,
            'tanggal_pendaftaran' => $this->tanggal_pendaftaran,
            'id_dokter' => $this->id_dokter,
            'status_pendaftaran' => $this->status_pendaftaran,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nomor_pendaftaran', $this->nomor_pendaftaran])
            ->andFilterWhere(['like', 'keluhan', $this->keluhan]);

        return $dataProvider;
    }
}
