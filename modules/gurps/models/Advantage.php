<?php

namespace app\modules\gurps\models;

use Yii;

/*
 * Хранить как JSON, XML, DB
 */
class Advantage extends \yii\db\ActiveRecord
{
    public $version; // unsignedShort, required
    public $round_down; // string +
    
    public $categories; //ref
    public $prereq_list = []; //ref [array]
    public $dr_bonus = []; //ref [array]
    public $attribute_bonus = []; //ref [array]
    public $skill_bonus = []; //ref [array]
    public $spell_bonus = []; //ref [array]
    public $weapon_bonus = []; //ref [array]
    public $melee_weapon = []; //ref [array]
    public $ranged_weapon = []; //ref [array]
    public $cost_reduction = []; //ref [array]
    public $cr; //ref // Самоконтроль, бросок самоконтроля необходимо кидать чтобы не подчиниться способности
    public $modifier = []; //ref [array]
    public $name; //StringWithCompareAttribute
    // + name_rus
    // + description_rus
    public $type; //string
    public $levels; //unsignedInt
    public $points_per_level; //short
    public $base_points; //integer
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    public static function tableName()
    {
        return 'advantages';
    }
    
    public function getAvailableTypes()
    {
        return [
            0 => 'ментальное',
            1 => 'физическое',
            2 => 'социальное',
            3 => 'экзотическое',
            4 => 'сверхъествественное',
            5 => 'обычное',
            6 => 'оружие',
            7 => 'приспособление',
        ];
    }
    
    public function getAvailableCategories()
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
    
    public function getType()
    {
        return implode(',', $this->type);
    }
    
    public function setType($value)
    {
        $this->type = explode(',', $value);
        return $this;
    }
    
    public function getCategoriesName()
    {
        return \yii\helpers\ArrayHelper::getValue($this->getAvailableCategories(), $this->categories);
    }
}
