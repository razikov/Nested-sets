<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\gurps\models\gcs;

/**
 * Уровень и навык, которые можно использовать по умолчанию для проверки умения
 *
 * @author aleksey
 */
class Default_my extends BasicModel
{
    public $name; // StringWithCompareAttribute
    public $specialization; // StringWithCompareAttribute
    public $type; // string
    public $modifier; // short
    
    
    public function getMap()
    {
        return [
            'name' => 'getStringWithCompareAttribute',
            'specialization' => 'getStringWithCompareAttribute',
            'type' => 'getString',
            'modifier' => 'getShort',
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'specialization', 'type', 'modifier'], 'safe'],
        ];
    }
}
