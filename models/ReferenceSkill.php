<?php

namespace app\models;

use Yii;

class ReferenceSkill extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'ref_skills';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => '',
            'skill_id' => Yii::t('app', 'Название (origin)'),
            'character_id' => Yii::t('app', 'Название'),
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
