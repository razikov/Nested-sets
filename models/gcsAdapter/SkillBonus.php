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
class SkillBonus extends BasicModel
{
    public $amount; //ref
    public $name; //StringWithCompareAttribute
    public $specialization; //StringWithCompareAttribute
    
    
    public function getMap()
    {
        return [
            'amount' => 'getAmount',
            'name' => 'getStringWithCompareAttribute',
            'specialization' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['amount', 'name', 'specialization'], 'safe'],
        ];
    }
}
