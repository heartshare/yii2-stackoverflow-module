<?php

namespace shamanzpua\module\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shamanzpua\module\models\StackoverflowQuestion;

/**
 * StackoverflowQuestionSearch represents the model behind the search form about `common\modules\models\StackoverflowQuestion`.
 */
class StackoverflowQuestionSearch extends StackoverflowQuestion
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['number', 'content', 'search_id'], 'safe'],
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
        $query = StackoverflowQuestion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'search_id' => $this->search_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);
        $query->andFilterWhere(['like', 'content', $this->content]);
        
        return $dataProvider;
    }
}
