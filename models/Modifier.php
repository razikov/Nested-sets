<?php

namespace app\models;

use Yii;

/**
 * 
 */
class Modifier extends \yii\db\ActiveRecord
{
    const TYPE_TRAIT = 0;
    const TYPE_ATTRIBUTE = 1;
    const TYPE_SPELL = 2;
    
    public static function tableName()
    {
        return 'modifiers';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', ''),
            'record_type' => Yii::t('app', 'Тип бонуса'),
            'record_id' => Yii::t('app', 'Ключ бонуса'),
            'cost' => Yii::t('app', 'Стоимость'),
        ];
    }
    
    public function rules()
    {
        return [
            [['record_type'], 'safe'],
        ];
    }
    
    public function getAvailableTypes()
    {
        return [
            self::TYPE_TRAIT => 'Умение',
            self::TYPE_ATTRIBUTE => 'Атрибут',
            self::TYPE_SPELL => 'Заклинание',
        ];
    }
    
}
