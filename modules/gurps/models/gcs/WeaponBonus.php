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
class WeaponBonus extends BasicModel
{
    public $amount; //ref
    public $name; //StringWithCompareAttribute
    public $specialization; //StringWithCompareAttribute
    public $level; //IntegerWithCompareAttribute
    
    
    public function getMap()
    {
        return [
            'amount' => 'getAmount',
            'name' => 'getStringWithCompareAttribute',
            'specialization' => 'getStringWithCompareAttribute',
            'level' => 'getIntegerWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['amount', 'name', 'specialization', 'level'], 'safe'],
        ];
    }
}
