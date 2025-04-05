<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pegawai;

/**
 * PegawaiSearch represents the model behind the search form about `app\models\Pegawai`.
 */
class PegawaiSearch extends Pegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'jenis_kelamin', 'tanggal_lahir', 'tanggal_bergabung', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nik', 'nama_lengkap', 'alamat', 'nomor_telepon', 'jabatan'], 'safe'],
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
        $query = Pegawai::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        if (isset($this->tanggal_lahir) && $this->tanggal_lahir > 1000) {
            //     $this->tgl_kegiatan = strtotime($this->tgl_kegiatan);
            $day_born = strtotime($this->tanggal_lahir) + (3600 * 7);

            $day_born = date('Y-m-d', $day_born);
            // echo $day; die;
            $day_born = strtotime($day_born);
            $day_born_end = $day_born + (3600 * 24) - 1;
        }

        if (isset($this->tanggal_bergabung) && $this->tanggal_bergabung > 1000) {
            //     $this->tgl_kegiatan = strtotime($this->tgl_kegiatan);
            $day = strtotime($this->tanggal_bergabung) + (3600 * 7);

            $day = date('Y-m-d', $day);
            // echo $day; die;
            $day = strtotime($day);
            $day_end = $day + (3600 * 24) - 1;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tanggal_bergabung' => $this->tanggal_bergabung,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'nomor_telepon', $this->nomor_telepon])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan]);

        if (isset($this->tanggal_lahir) && $this->tanggal_lahir > 1000) {
            $query->andFilterWhere(['between', 'tanggal_lahir', $day_born, $day_born_end]);
            // echo $query->createCommand()->getRawSql();
            // die;
        }
        if (isset($this->tanggal_bergabung) && $this->tanggal_bergabung > 1000) {
            $query->andFilterWhere(['between', 'tanggal_bergabung', $day, $day_end]);
            // echo $query->createCommand()->getRawSql();
            // die;
        }

        return $dataProvider;
    }
}
