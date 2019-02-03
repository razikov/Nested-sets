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
class RangedWeapon extends BasicModel
{
    public $default; //ref // зависит от
    public $damage; //string
    public $strength; //string
    public $usage; //string
    public $accuracy; //string
    public $range; //string
    public $rate_of_fire; //string
    public $recoil; //string
    public $shots; //string
    public $bulk; //string
    
    
    public function getMap()
    {
        return [
            'default' => 'getDefault',
            'damage' => 'getString',
            'strength' => 'getString',
            'usage' => 'getString',
            'accuracy' => 'getString',
            'range' => 'getString',
            'rate_of_fire' => 'getString',
            'recoil' => 'getString',
            'shots' => 'getString',
            'bulk' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['default', 'damage', 'strength', 'usage', 'accuracy', 'range',
                'rate_of_fire', 'recoil', 'shots', 'bulk'], 'safe'],
        ];
    }
}
