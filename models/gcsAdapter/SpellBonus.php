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
class SpellBonus extends BasicModel
{
    public $all_colleges; //string
    
    public $amount; //ref
    public $spell_name; //StringWithCompareAttribute
    public $college_name; //StringWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'all_colleges',
        ];
    }
    
    public function getMap()
    {
        return [
            'amount' => 'getAmount',
            'spell_name' => 'getStringWithCompareAttribute',
            'college_name' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['all_colleges', 'amount', 'spell_name', 'college_name'], 'safe'],
        ];
    }
    
}
