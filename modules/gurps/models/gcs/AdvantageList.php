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
class AdvantageList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $advantage_container; //ref
    public $advantage; //ref
    
    
    public function getAttrs()
    {
        return [
            'id',
            'unique_id',
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'advantage_container' => 'getAdvantageContainer',
            'advantage' => 'getAdvantage',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'advantage_container', 'advantage'], 'safe'],
        ];
    }
}
