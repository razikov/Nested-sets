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
class EquipmentContainer extends BasicModel
{
    public $state; //StateType // equipped || carried || not carried
    public $open; //required, YesNo
    public $version; //unsignedShort, required
    // неограниченный
    public $equipment; //ref
    public $equipment_container; //ref
    public $categories; //ref
    public $prereq_list; //ref
    public $melee_weapon; //ref
    public $skill_bonus; //ref
    public $dr_bonus; //ref
    public $description; //string
    public $legality_class; //string
    public $value; //string
    public $weight; //string
    public $tech_level; //string
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'state',
            'open',
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'equipment' => 'getEquipment',
            'equipment_container' => 'getEquipmentContainer',
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'melee_weapon' => 'getMeleeWeapon',
            'skill_bonus' => 'getSkillBonus',
            'dr_bonus' => 'getDrBonus',
            'description' => 'getString',
            'legality_class' => 'getString',
            'value' => 'getString',
            'weight' => 'getString',
            'tech_level' => 'getString',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['state', 'open', 'version', 'equipment', 'equipment_container',
                'categories', 'prereq_list', 'melee_weapon', 'skill_bonus',
                'dr_bonus', 'description', 'legality_class', 'value',
                'weight', 'tech_level', 'reference', 'notes'], 'safe'],
        ];
    }
}