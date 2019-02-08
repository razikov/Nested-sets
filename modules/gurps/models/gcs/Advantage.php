<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\gurps\models\gcs;

/**
 * Description of AdvantageList
 *
 * @author aleksey
 */
class Advantage extends BasicModel
{
    public $version; // unsignedShort, required
    public $round_down; // string
    
    public $categories; //ref
    public $prereq_list; //ref
    public $dr_bonus; //ref
    public $attribute_bonus; //ref
    public $skill_bonus; //ref
    public $spell_bonus; //ref
    public $weapon_bonus; //ref
    public $melee_weapon; //ref
    public $ranged_weapon; //ref
    public $cost_reduction; //ref
    public $cr; //ref // Самоконтроль, бросок самоконтроля необходимо кидать чтобы не подчиниться способности
    public $modifier; //ref
    public $name; //StringWithCompareAttribute
    public $type; //string
    public $levels; //unsignedInt
    public $points_per_level; //short
    public $base_points; //integer
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    public function getAttrs()
    {
        return [
            'version',
            'round_down',
        ];
    }
    
    public function getMap()
    {
        return [
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'dr_bonus' => 'getDrBonus',
            'attribute_bonus' => 'getAttributeBonus',
            'skill_bonus' => 'getSkillBonus',
            'spell_bonus' => 'getSpellBonus',
            'melee_weapon' => 'getMeleeWeapon',
            'ranged_weapon' => 'getRangedWeapon',
            'cost_reduction' => 'getCostReduction',
            'cr' => 'getCr',
            'modifier' => 'getModifier',
            'name' => 'getStringWithCompareAttribute',
            'type' => 'getString',
            'levels' => 'getUnsignedInt',
            'points_per_level' => 'getShort',
            'base_points' => 'getInteger',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'round_down', 'categories', 'prereq_list', 'dr_bonus',
                'attribute_bonus', 'skill_bonus', 'spell_bonus', 'weapon_bonus',
                'melee_weapon', 'ranged_weapon', 'cost_reduction', 'cr',
                'modifier', 'name', 'type', 'levels', 'points_per_level', 'base_points',
                'reference', 'notes'], 'safe'],
        ];
    }
}
