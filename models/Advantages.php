<?php

namespace app\models;

use Yii;

class Advantages extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'advantages';
    }
    
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Название (origin)'),
            'name_rus' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'type' => Yii::t('app', 'Типы'),
            'meta_type' => Yii::t('app', 'Мета-тип'),
            'types' => Yii::t('app', 'Типы'),
            'cost' => Yii::t('app', 'Стоимость'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'description', 'type', 'meta_type', 'types', 'cost'], 'safe'],
        ];
    }
    
    public function getAvailableTypes()
    {
        return [
            0 => 'ментальное',
            1 => 'физическое',
            2 => 'социальное',
            3 => 'экзотическое (уфо)',
            4 => 'сверхъествественное (молния)',
            5 => 'обычное',
            6 => 'оружие',
            7 => 'приспособление',
        ];
    }
    
    public function getMetaTypeName()
    {
        return \yii\helpers\ArrayHelper::getValue($this->getAvailableMetaType(), $this->meta_type, 'Error!');
    }
    
    public function getAvailableMetaType()
    {
        return [
            0 => Yii::t('app', 'Преимущество'),
            1 => Yii::t('app', 'Перк'),
            2 => Yii::t('app', 'Улучшение'),
            3 => Yii::t('app', 'Ограничение'),
            4 => Yii::t('app', 'Недостаток'),
            5 => Yii::t('app', 'Причуды'),
            6 => Yii::t('app', 'Умения'),
            7 => Yii::t('app', 'Техника'),
            8 => Yii::t('app', 'Пси'),
        ];
    }
    
    public function setTypes($types)
    {
        if (is_array($types) && !empty($types)) {
            $this->type = implode(',', $types);
        } elseif (is_string($types)) {
            $this->type = $types;
        }
    }
    
    public function getTypes()
    {
        return $this->type ? explode(',', $this->type) : [];
    }
    
    public function getQuery(AdvantagesForm $filter)
    {
        $query = self::find();
        $query->andFilterWhere(
            [
                'or', 
                ['name' => $filter->name], 
                ['name_rus' => $filter->name]
            ]
        );
        return $query;
    }
    
    public function getModifiers()
    {
        return Modifier::find()->where([
            [
                'record_type' => Modifier::TYPE_TRAIT,
                'record_id' => $this->id,
            ]
        ])->all();
    }
}
