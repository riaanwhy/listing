<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kalenderdetil;

/**
 * KalenderdetilSearch represents the model behind the search form of `backend\models\Kalenderdetil`.
 */
class KalenderdetilSearch extends Kalenderdetil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kalender_id', 'periode_id',
			'pu','sa','wp','ap','ar','gl','fa','pi','hr',					
				'terkini', 'anggaran', 'tugas', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['tgl_awal', 'tgl_akhir'], 'safe'],
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
    public function search($params)
    {
        $query = Kalenderdetil::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kalender_id' => $this->kalender_id,
            'periode_id' => $this->periode_id,
            'terkini' => $this->terkini,
			'pu' => $this->pu,
			'sa' => $this->sa,
			'wp' => $this->wp,
			'ap' => $this->ap,
			'ar' => $this->ar,
			'gl' => $this->gl,
			'fa' => $this->fa,
			'pi' => $this->pi,
			'hr' => $this->hr,			
	
            'tgl_awal' => $this->tgl_awal,
            'tgl_akhir' => $this->tgl_akhir,
            'anggaran' => $this->anggaran,
            'tugas' => $this->tugas,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
