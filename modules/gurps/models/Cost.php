<?php

namespace app\modules\gurps\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class Cost extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'costs';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'value' => Yii::t('app', 'Цена'),
            'type' => Yii::t('app', 'Тип цены'),
            'per_level' => Yii::t('app', 'За уровень?'),
        ];
    }
    
    public function rules()
    {
        return [
            [['value', 'type', 'per_level'], 'safe'],
        ];
    }
    
    public function getAvailableCostTypes()
    {
        return [
            'points',
            'percentage',
            'multiplier',
            'race', // ??
            'meta_trait', // ??
            'alternative_abilities', // ??
        ];
    }
    
}
