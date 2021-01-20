<?php

namespace backend\modules\mdata\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\mdata\models\Finances;

/**
 * FinancesSearch represents the model behind the search form of `backend\modules\mdata\models\Finances`.
 */
class FinancesSearch extends Finances
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'created_by', 'updated_by'], 'integer'],
            [['year', 'created_at', 'updated_at'], 'safe'],
            [['sales', 'cogs', 'adm_expense', 'sales_expense', 'dep_expense', 'gm', 'nm', 'gm_percent', 'nm_percent'], 'number'],
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
        $query = Finances::find();

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
            'company_id' => $this->company_id,
            'year' => $this->year,
            'sales' => $this->sales,
            'cogs' => $this->cogs,
            'adm_expense' => $this->adm_expense,
            'sales_expense' => $this->sales_expense,
            'dep_expense' => $this->dep_expense,
            'gm' => $this->gm,
            'nm' => $this->nm,
            'gm_percent' => $this->gm_percent,
            'nm_percent' => $this->nm_percent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
