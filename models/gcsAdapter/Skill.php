<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models\gcsAdapter;

/**
 * Description of AdvantageList
 *
 * @author aleksey
 */
class Skill extends BasicModel
{
    public $version; //unsignedShort, required
    // неограниченный
    public $default; //ref
    public $categories; //ref
    public $prereq_list; //ref
    public $attribute_bonus; //ref
    public $weapon_bonus; //ref
    public $name; //StringWithCompareAttribute
    public $specialization; //StringWithCompareAttribute
    public $notes; //StringWithCompareAttribute
    public $encumbrance_penalty_multiplier; //unsignedInt
    public $tech_level; //string
    public $difficulty; //string
    public $points; //unsignedInt
    public $reference; //string
    
    
    public function getAttrs()
    {
        return [
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'default' => 'getDefault',
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'attribute_bonus' => 'getAttributeBonus',
            'weapon_bonus' => 'getWeaponBonus',
            'name' => 'getStringWithCompareAttribute',
            'specialization' => 'getStringWithCompareAttribute',
            'notes' => 'getStringWithCompareAttribute',
            'encumbrance_penalty_multiplier' => 'getUnsignedInt',
            'tech_level' => 'getString',
            'difficulty' => 'getString',
            'points' => 'getUnsignedInt',
            'reference' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'default', 'categories', 'prereq_list', 'attribute_bonus',
                'weapon_bonus', 'name', 'specialization', 'notes', 'encumbrance_penalty_multiplier',
                'tech_level', 'difficulty', 'points', 'reference'], 'safe'],
        ];
    }
    
    public function getEffectiveLevel()
    {
        $r = explode('/', $this->difficulty);
        
        $attr = $r[0];
        $dificult = \yii\helpers\ArrayHelper::getValue(['E' => 0, 'A' => 1, 'H' => 2, 'VH' => 3], $r[1], null);
        [0 => 'легкое', 1 => 'среднее', 2 => 'трудное', 3 => 'очень трудное'];
        $level = [0, -1, -2, -3];
        $point = $this->points;
        
        $f = function($p1, $p2, $bonusLevel) use (&$f) {
            $result = $p1 - $p2;
            
            if ($result > 0) {
                // Если бонусный уровень 0,1,2 то вернуть заданный бонус, иначе посчитать от текущего
                $pm2table = [1,2,4];
                $bonusLevel++;
                if (isset($pm2table[$bonusLevel])) {
                    $pm2 = $pm2table[$bonusLevel];
                } else {
                    $pm2 = $p2 + 4;
                }
                return $f($p1, $pm2, $bonusLevel);
            } elseif ($result == 0) {
                return $bonusLevel;
            } else {
                return $bonusLevel - 1;
            }
        };
        $r = $level[$dificult] + $f($point, 1, 0);
        if ($r >= 0) {
            return $attr . '+' . $r;
        } else {
            return $attr . $r;
        }
    }
}
