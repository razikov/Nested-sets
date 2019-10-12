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
class SkillPrereq extends BasicModel
{
    public $has; //required, YesNo
    // неограниченный
    public $name; //StringWithCompareAttribute
    public $level; //IntegerWithCompareAttribute
    public $specialization; //StringWithCompareAttribute
    
    public function getAttrs()
    {
        return [
            'has',
        ];
    }
    
    public function getMap()
    {
        return [
            'name' => 'getStringWithCompareAttribute',
            'level' => 'getIntegerWithCompareAttribute',
            'specialization' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['has', 'name', 'level', 'specialization'], 'safe'],
        ];
    }
}
