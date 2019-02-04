<?php

namespace app\models;

use Yii;

class ReferenceTraits extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'ref_traits';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'advantage_id' => Yii::t('app', 'Преимущество/Недостаток'),
            'character_id' => Yii::t('app', 'Персонаж'),
            'modifiers' => Yii::t('app', 'Улучшения/Ограничения'),
        ];
    }
    
    public function rules()
    {
        return [
            [['advantage_id', 'character_id'], 'safe'],
        ];
    }
    
    public function getAdvantage()
    {
        return Advantages::findOne(['id' => $this->advantage_id]);
    }
    
    public function getCost()
    {
        return $this->advantage->cost;
    }
}
