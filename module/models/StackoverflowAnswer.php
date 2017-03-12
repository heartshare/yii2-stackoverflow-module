<?php

namespace shamanzpua\module\models;

use Yii;

/**
 * This is the model class for table "{{%stackoverflow_answer}}".
 *
 * @property integer $id
 * @property integer $score
 * @property string $content
 * @property integer $question_id
 *
 * @property StackoverflowQuestion $question
 */
class StackoverflowAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stackoverflow_answer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score', 'question_id'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => StackoverflowQuestion::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'score' => Yii::t('app', 'Score'),
            'content' => Yii::t('app', 'Content'),
            'question_id' => Yii::t('app', 'Question ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(StackoverflowQuestion::className(), ['id' => 'question_id']);
    }
}
