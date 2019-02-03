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
class SkillList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $skill_container; //ref
    public $skill; //ref
    public $technique; //ref
    
    
    public function getAttrs()
    {
        return [
            'id',
            'unique_id',
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'skill_container' => 'getSkillContainer',
            'skill' => 'getSkill',
            'technique' => 'getTechnique',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'skill_container', 'skill', 'technique'], 'safe'],
        ];
    }
}
