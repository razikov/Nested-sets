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
class Equipment extends BasicModel
{
    public $state; //StateType // equipped || carried || not carried
    public $version; //unsignedShort, required
    // неограниченный
    public $categories; //ref
    public $prereq_list; //ref
    public $attribute_bonus; //ref
    public $skill_bonus; //ref
    public $spell_bonus; //ref
    public $weapon_bonus; //ref
    public $dr_bonus; //ref
    public $melee_weapon; //ref
    public $ranged_weapon; //ref
    public $quantity; //IntegerWithCompareAttribute
    public $description; //string
    public $tech_level; //string
    public $legality_class; //string
    public $value; //string
    public $weight; //string
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'state',
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'attribute_bonus' => 'getAttributeBonus',
            'skill_bonus' => 'getSkillBonus',
            'spell_bonus' => 'getSpellBonus',
            'weapon_bonus' => 'getWeaponBonus',
            'dr_bonus' => 'getDrBonus',
            'melee_weapon' => 'getMeleeWeapon',
            'ranged_weapon' => 'getRangedWeapon',
            'quantity' => 'getIntegerWithCompareAttribute',
            'description' => 'getString',
            'tech_level' => 'getString',
            'legality_class' => 'getString',
            'value' => 'getString',
            'weight' => 'getString',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['state', 'version', 'categories', 'prereq_list', 'attribute_bonus',
                'skill_bonus', 'spell_bonus', 'weapon_bonus', 'dr_bonus',
                'melee_weapon', 'ranged_weapon', 'quantity', 'description',
                'tech_level', 'legality_class', 'value', 'weight', 'reference', 'notes'], 'safe'],
        ];
    }
}