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
class SpellPrereq extends BasicModel
{
    public $has; //required, YesNo
    // неограниченный
    public $name; //StringWithCompareAttribute
    public $college; //CollegeType
    public $college_count; //IntegerWithCompareAttribute
    public $quantity; //IntegerWithCompareAttribute
    public $any; //unsignedShort, default="0"
    
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
            'college' => 'getCollegeType',
            'college_count' => 'getIntegerWithCompareAttribute',
            'quantity' => 'getIntegerWithCompareAttribute',
            'any' => 'getUnsignedShort',
        ];
    }
    
    public function rules()
    {
        return [
            [['has', 'name', 'college', 'college_count', 'quantity', 'any'], 'safe'],
        ];
    }
}
