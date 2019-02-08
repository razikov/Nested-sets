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
class Spell extends BasicModel
{
    public $version; //unsignedShort, required
    public $very_hard; //string
    // неограниченный
    public $default; //ref
    public $categories; //ref
    public $prereq_list; //ref
    public $melee_weapon; //ref
    public $ranged_weapon; //ref
    public $name; //string
    public $tech_level; //unsignedShort, default="0"
    public $college; //CollegeType
    public $power_source; //string
    public $spell_class; //string
    public $casting_cost; //string
    public $maintenance_cost; //string
    public $casting_time; //string
    public $duration; //string
    public $points; //unsignedShort
    public $reference; //string
    public $notes; //string
    
    public function getAttrs()
    {
        return [
            'version',
            'very_hard',
        ];
    }
    
    public function getMap()
    {
        return [
            'default' => 'getDefault',
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'melee_weapon' => 'getMeleeWeapon',
            'ranged_weapon' => 'getRangedWeapon',
            'name' => 'getString',
            'tech_level' => 'getUnsignedShort',
            'college' => 'getCollegeType',
            'power_source' => 'getString',
            'spell_class' => 'getString',
            'casting_cost' => 'getString',
            'maintenance_cost' => 'getString',
            'casting_time' => 'getString',
            'duration' => 'getString',
            'points' => 'getUnsignedShort',
            'reference' => 'getString',
            'notes' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'very_hard', 'default', 'categories', 'prereq_list',
                'melee_weapon', 'ranged_weapon', 'name', 'tech_level', 'college',
                'power_source', 'spell_class', 'casting_cost', 'maintenance_cost',
                'casting_time', 'duration', 'points', 'reference', 'notes'], 'safe'],
        ];
    }
}
