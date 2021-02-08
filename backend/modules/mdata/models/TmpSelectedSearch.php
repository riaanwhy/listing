<?php

namespace backend\modules\mdata\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mdata\models\TmpSelected;

/**
 * TmpSelectedSearch represents the model behind the search form of `backend\modules\mdata\models\TmpSelected`.
 */
class TmpSelectedSearch extends TmpSelected
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'companies_id', 'finances_id'], 'integer'],
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
        $query = TmpSelected::find();

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
            'companies_id' => $this->companies_id,
            'finances_id' => $this->finances_id,
        ]);

        return $dataProvider;
    }
}
