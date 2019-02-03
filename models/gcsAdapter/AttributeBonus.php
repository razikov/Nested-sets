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
class AttributeBonus extends BasicModel
{
    public $attribute; //ref
    public $amount; //ref
    
    public function getMap()
    {
        return [
            'attribute' => 'getAttribute',
            'amount' => 'getAmount',
        ];
    }
    
    public function rules()
    {
        return [
            [['attribute', 'amount'], 'safe'],
        ];
    }
}
