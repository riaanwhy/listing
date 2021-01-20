<?php

namespace backend\modules\mdata\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mdata\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form of `backend\modules\mdata\models\Companies`.
 */
class CompaniesSearch extends Companies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sic_code', 'sector', 'sub_sector', 'country', 'created_by', 'updated_by'], 'integer'],
            [['name', 'exchange', 'website', 'profile', 'created_at', 'updated_at'], 'safe'],
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
        $query = Companies::find();

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
            'sic_code' => $this->sic_code,
            'sector' => $this->sector,
            'sub_sector' => $this->sub_sector,
            'country' => $this->country,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'exchange', $this->exchange])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'profile', $this->profile]);

        return $dataProvider;
    }
}
