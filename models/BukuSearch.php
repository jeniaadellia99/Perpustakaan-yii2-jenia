<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Buku;

/**
 * BukuSearch represents the model behind the search form of `app\models\Buku`.
 */
class BukuSearch extends Buku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['nama', 'tahun_terbit', 'sinopsis', 'sampul', 'berkas'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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

    public function getQuerySearch($params)
    {
        $query = BukuSearch::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'nama' => $this->nama,
            'tahun_terbit' => $this->tahun_terbit,
            'id_kategori' => $this->id_kategori,
            'id_penulis' => $this->id_penulis,
            'id_penerbit' => $this->id_penerbit,
            'sinopsis' => $this->sinopsis,
            'sampul' => $this->sampul,
            'berkas' => $this->berkas,
      
        ]);

        return $query;
    }
    public function search($params)
    {
        $query = $this->getQuerySearch($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);        

        return $dataProvider;
    }
}
