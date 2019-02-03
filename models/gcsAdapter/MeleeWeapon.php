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
class MeleeWeapon extends BasicModel
{
    public $default; //ref
    public $damage; //string
    public $strength; //string
    public $usage; //string
    public $reach; //string
    public $parry; //string
    public $block; //string
    
    
    public function getMap()
    {
        return [
            'default' => 'getDefault',
            'damage' => 'getString',
            'strength' => 'getString',
            'usage' => 'getString',
            'reach' => 'getString',
            'parry' => 'getString',
            'block' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['default', 'damage', 'strength', 'usage', 'reach', 'parry', 'block'], 'safe'],
        ];
    }
}
