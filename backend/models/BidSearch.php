<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bid;

/**
 * BidSearch represents the model behind the search form about `common\models\Bid`.
 */
class BidSearch extends Bid
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'user_id', 'term'], 'integer'],
            [['currency', 'comment', 'status'], 'safe'],
            [['price'], 'number'],
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
        $query = Bid::find();

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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'price' => $this->price,
            'term' => $this->term,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
