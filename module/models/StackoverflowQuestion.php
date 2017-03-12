<?php

namespace shamanzpua\module\models;

use Yii;

/**
 * This is the model class for table "{{%stackoverflow_question}}".
 *
 * @property integer $id
 * @property integer $number
 * @property string $content
 * @property integer $search_id
 *
 * @property StackoverflowAnswer[] $stackoverflowAnswers
 * @property StackoverflowSearch $search
 */
class StackoverflowQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stackoverflow_question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'content'], 'required'],
            [['number', 'search_id'], 'integer'],
            [['content'], 'string'],
            [['search_id'], 'exist', 'skipOnError' => true, 'targetClass' => StackoverflowSearch::className(), 'targetAttribute' => ['search_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'content' => Yii::t('app', 'Content'),
            'search_id' => Yii::t('app', 'Search ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStackoverflowAnswers()
    {
        return $this->hasMany(StackoverflowAnswer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearch()
    {
        return $this->hasOne(StackoverflowSearch::className(), ['id' => 'search_id']);
    }
}
