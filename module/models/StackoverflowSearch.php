<?php

namespace shamanzpua\module\models;

use Yii;
use shamanzpua\module\models\StackoverflowAnswer;
use shamanzpua\module\models\StackoverflowQuestion;
use shamanzpua\stackexchange\data\process\stackoverflow\Process;
use shamanzpua\stackexchange\Stackoverflow;

/**
 * This is the model class for table "{{%stackoverflow_search}}".
 *
 * @property integer $id
 * @property string $search
 *
 * @property StackoverflowQuestion[] $stackoverflowQuestions
 */
class StackoverflowSearch extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stackoverflow_search}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['search'], 'required'],
            [['search'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'search' => Yii::t('app', 'Search'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function grab()
    {
        if ($this->save() === false) {
            return $this;
        }
                
        $api = Yii::$app
            ->getModule('stackoverflow')
            ->stackexchange
            ->getApi('stackoverflow');
        $data = $api->grab($this->search);
        
        $transaction = Yii::$app->db->beginTransaction();
        $this->saveQuestions($data);
        
        ($this->hasErrors()) ? $transaction->rollBack() : $transaction->commit() ;
        
        return $this;
    }
    
    /**
     * @param array $data
     */
    public function saveQuestions($data)
    {
        if (empty($data)) {
            return;
        }
        foreach ($data as $item) {
            $attributes = [
                'search_id' => $this->id,
                'number' => $item[Process::TARGET_QUESTION_ID],
                'content'=> $item[Process::TARGET_BODY],
            ];
            $question = Yii::createObject(StackoverflowQuestion::class);
            $question->setAttributes($attributes);
            $question->save();
            if ($question->hasErrors()) {
                $this->addErrors($question->getErrors());
                break;
            }
            if (isset($item[Stackoverflow::FIELD_ANSWERS])) {
                $this->saveAnswers($item[Stackoverflow::FIELD_ANSWERS], $question);
            }
        }
    }
    
    /**
     *
     * @param array $data
     * @param StackoverflowQuestion $parrent
     */
    public function saveAnswers($data, $parrent)
    {
        if (empty($data)) {
            return;
        }
        foreach ($data as $item) {
            $attributes = [
                'question_id' => $parrent->id,
                'score' => $item[Process::TARGET_SCORE],
                'content'=> $item[Process::TARGET_BODY],
            ];
            $answer = Yii::createObject(StackoverflowAnswer::class);
            $answer->setAttributes($attributes);
            $answer->save();
            if ($answer->hasErrors()) {
                $this->addErrors($answer->getErrors());
                break;
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStackoverflowQuestions()
    {
        return $this->hasMany(StackoverflowQuestion::className(), ['search_id' => 'id']);
    }
}
