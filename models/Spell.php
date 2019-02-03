<?php

namespace app\models;

use Yii;

class Spell extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'spells';
    }
    
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Название (origin)'),
            'name_rus' => Yii::t('app', 'Название'),
            'descryption' => Yii::t('app', 'Описание'),
            'class' => Yii::t('app', 'Класс'),
            'type' => Yii::t('app', 'Школа'),
            'duration' => Yii::t('app', 'Длительность'),
            'cost' => Yii::t('app', 'Стоимость'),
            'time_of_creation' => Yii::t('app', 'Время сотворения'),
            'requirement' => Yii::t('app', 'Требования'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'descryption', 'class', 'type', 'duration', 'cost', 'time_of_creation', 'requirement'], 'safe'],
        ];
    }
    
    public function getClassName()
    {
        return \yii\helpers\ArrayHelper::getValue($this->getAvailableClasses(), $this->class);
    }
    
    public function getAvailableClasses()
    {
        return [
            0 => 'Обычное',
            1 => 'Областное',
            2 => 'Касательное',
            3 => 'Метательное',
            4 => 'Блокирующее',
            5 => 'Информационное',
            6 => 'Сопротивляемое',
            7 => 'Особое',
        ];
    }
    
    public function getTypeName()
    {
        return \yii\helpers\ArrayHelper::getValue($this->getAvailableTypes(), $this->type);
    }
    
    public function getAvailableTypes()
    {
        return [
            0 => 'Воздух',
            1 => 'Земля',
            2 => 'Вода',
            3 => 'Огонь',
            4 => 'Контроль тела',
            5 => 'Общения и понимания',
            6 => 'Заклинания наложения чар',
            7 => 'Заклинания врат',
            8 => 'Заклинания лечения',
            9 => 'Заклинания знаний',
            10 => 'Заклинания света и тьмы',
            11 => 'Заклинания мета-магии',
            12 => 'Заклинания контроля разума',
            13 => 'Заклинания перемещения',
            14 => 'Заклинания некромантии',
            15 => 'Заклинания защиты и предупреждения',
        ];
    }
}
