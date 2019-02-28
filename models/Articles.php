<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class Articles extends \yii\db\ActiveRecord
{
    public $currentState;
    public $tagIds;

    public static function tableName()
    {
        return 'articles';
    }
    
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Аннотация'),
            'content' => Yii::t('app', 'Текст статьи'),
            'publish_at' => Yii::t('app', 'Опубликовать'),
            'tagIds' => Yii::t('app', 'Теги'),
        ];
    }
    
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
                'defaultValue' => 0,
            ],
        ];
    }
    
    public function getAvailableTagList()
    {
        return \yii\helpers\ArrayHelper::map(Tags::find()->all(), 'id', 'name');
    }
}
