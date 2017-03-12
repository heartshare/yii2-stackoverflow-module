<?php

namespace shamanzpua\module\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shamanzpua\module\models\StackoverflowAnswer;

/**
 * StackoverflowAnswerSearch represents the model behind the search form about `common\modules\models\StackoverflowAnswer`.
 */
class StackoverflowAnswerSearch extends StackoverflowAnswer
{
    public $search_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['score', 'content', 'question_id', 'search_id'], 'safe'],
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
        $query = StackoverflowAnswer::find();

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
            'question_id' => $this->question_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->andFilterWhere(['like', 'score', $this->score]);

        return $dataProvider;
    }
}
