<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Log;

/**
 * LogSearch represents the model behind the search form of `backend\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'created_by'], 'integer'],
            [['created_by','created_at', 'key', 'modul', 'fungsi', 'aksi', 'informasi'], 'safe'],
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
        $query = Log::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC]]
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
               // 'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);
         $query->andFilterWhere(['like', "(date_format( FROM_UNIXTIME(`created_at` ), '%Y-%m-%d %H:%i:%s' ))", $this->created_at]);
    
        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'modul', $this->modul])
            ->andFilterWhere(['like', 'fungsi', $this->fungsi])
            ->andFilterWhere(['like', 'aksi', $this->aksi])
            ->andFilterWhere(['like', 'informasi', $this->informasi]);
       

        return $dataProvider;
    }
}
