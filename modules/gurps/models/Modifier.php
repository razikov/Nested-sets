<?php

namespace app\modules\gurps\models;

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
            'id' => Yii::t('app', '#'),
//            'skill_bonus' => Yii::t('app', 'Стоимость'),
//            'attribute_bonus' => Yii::t('app', 'Стоимость'),
            'cost_id' => Yii::t('app', 'Стоимость'),
            'name' => Yii::t('app', 'Название'),
            'name_rus' => Yii::t('app', 'Название'),
            'notes' => Yii::t('app', 'Заметки'),
            'levels' => Yii::t('app', 'Уровень'),
            'reference' => Yii::t('app', 'Ссылка'),
            'affects' => Yii::t('app', 'Влияет на '),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'notes', 'levels', 'reference', 'affects'], 'safe'],
        ];
    }
    
}
