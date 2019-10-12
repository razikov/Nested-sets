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
class Technique extends BasicModel
{
    public $version; //unsignedShort, required
    public $limit; //short
    // неограниченный
    public $default; //ref
    public $categories; //ref
    public $prereq_list; //ref
    public $melee_weapon; //ref
    public $name; //StringWithCompareAttribute
    public $difficulty; //string
    public $points; //unsignedShort
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'version',
            'limit',
        ];
    }
    
    public function getMap()
    {
        return [
            'default' => 'getDefault',
            'categories' => 'getCategories',
            'prereq_list' => 'getPrereqList',
            'melee_weapon' => 'getMeleeWeapon',
            'name' => 'getStringWithCompareAttribute',
            'difficulty' => 'getString',
            'points' => 'getUnsignedShort',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'limit', 'default', 'categories', 'prereq_list', 'melee_weapon', 
                'name', 'difficulty', 'points', 'reference', 'notes'], 'safe'],
        ];
    }
}
