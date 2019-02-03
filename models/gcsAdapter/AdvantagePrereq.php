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
class AdvantagePrereq extends BasicModel
{
    public $has; // YesNo, required
    // неограниченный
    public $name; //StringWithCompareAttribute
    public $notes; //StringWithCompareAttribute
    public $level; //IntegerWithCompareAttribute
    
    
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
            'notes' => 'getStringWithCompareAttribute',
            'level' => 'getIntegerWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['has', 'name', 'notes', 'level'], 'safe'],
        ];
    }
    
}
