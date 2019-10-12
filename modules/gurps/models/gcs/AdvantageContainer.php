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
class AdvantageContainer extends BasicModel
{
    public $version; // unsignedShort, required
    public $open; // YesNo, required
    public $type; // CostType
    // неограниченный
    public $categories; //ref
    public $advantage_container; //ref
    public $advantage; //ref
    public $modifier; //ref
    public $name; //StringWithCompareAttribute
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'version',
            'open',
            'type',
        ];
    }
    
    public function getMap()
    {
        return [
            'categories' => 'getCategories',
            'advantage_container' => 'getAdvantageContainer',
            'advantage' => 'getAdvantage',
            'modifier' => 'getModifier',
            'name' => 'getStringWithCompareAttribute',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'open', 'type', 'categories', 'advantage_container',
                'advantage', 'modifier', 'name', 'reference', 'notes'], 'safe'],
        ];
    }
}
