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
class DrBonus extends BasicModel
{
    public $amount; //ref
    public $location; //string
    
    
    public function getMap()
    {
        return [
            'amount' => 'getAmount',
            'location' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['amount', 'location'], 'safe'],
        ];
    }
}
