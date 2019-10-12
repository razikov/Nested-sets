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
class SkillContainer extends BasicModel
{
    public $version; //unsignedShort, required
    public $open; //string, required
    // неограниченный
    public $categories; //ref
    public $skill_container; //ref
    public $skill; //ref
    public $technique; //ref
    public $name; //StringWithCompareAttribute
    public $notes; //StringWithCompareAttribute
    public $reference; //string
    
    
    public function getAttrs()
    {
        return [
            'version',
            'open',
        ];
    }
    
    public function getMap()
    {
        return [
            'categories' => 'getCategories',
            'skill_container' => 'getSkillContainer',
            'skill' => 'getSkill',
            'technique' => 'getTechnique',
            'name' => 'getStringWithCompareAttribute',
            'notes' => 'getStringWithCompareAttribute',
            'reference' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'open', 'categories', 'skill_container', 'skill', 
                'technique', 'name', 'notes', 'reference'], 'safe'],
        ];
    }
}
