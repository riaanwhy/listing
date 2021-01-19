<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Status;

/**
 * StatusSearch represents the model behind the search form of `backend\models\Status`.
 */
class StatusSearch extends Status
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'impor', 'pekerja', 'karir', 'pendapatan', 'potongan', 'otoritas', 'otoritaspekerja', 'pendidikan', 'jabatan', 'kalender', 'kalenderdetilupah', 'tabel', 'tabeldetil', 'bank', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['status'], 'safe'],
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
        $query = Status::find();

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
            'impor' => $this->impor,
            'pekerja' => $this->pekerja,
            'karir' => $this->karir,
            'pendapatan' => $this->pendapatan,
            'potongan' => $this->potongan,
            'otoritas' => $this->otoritas,
            'otoritaspekerja' => $this->otoritaspekerja,
            'pendidikan' => $this->pendidikan,
            'jabatan' => $this->jabatan,
            'kalender' => $this->kalender,
            'kalenderdetilupah' => $this->kalenderdetilupah,
            'tabel' => $this->tabel,
            'tabeldetil' => $this->tabeldetil,
            'bank' => $this->bank,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
