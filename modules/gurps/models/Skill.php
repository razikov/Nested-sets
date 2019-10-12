<?php

namespace app\modules\gurps\models;

use Yii;

class Skill extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'skills';
    }
    
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Название (origin)'),
            'name_rus' => Yii::t('app', 'Название'),
            'type' => Yii::t('app', 'Типы'),
            'meta_type' => Yii::t('app', 'Мета-тип'),
            'default' => Yii::t('app', 'По умолчанию'),
            'requirement' => Yii::t('app', 'Требования'),
            'description' => Yii::t('app', 'Описание'),
            'modifier' => Yii::t('app', 'Модификатор'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'description', 'type', 'meta_type', 'default', 'requirement', 'modifier'], 'safe'],
        ];
    }
    
    public function getMetaTypeName()
    {
        return \yii\helpers\ArrayHelper::getValue($this->getAvailableMetaTypes(), $this->meta_type);
    }
    
    public function getAvailableMetaTypes()
    {
        return [
            0 => 'Умение',
            1 => 'Техника',
        ];
    }
}
