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
class SpellContainer extends BasicModel
{
    public $version; //unsignedShort, required
    public $open; //YesNo, required
    // неограниченный
    public $categories; //ref
    public $spell_container; //ref
    public $spell; //ref
    public $name; //StringWithCompareAttribute
    public $reference; //string
    public $notes; //StringWithCompareAttribute
    
    public function getAttrs()
    {
        return [
            'version',
            'open',
        ];
    }
    
    public function getMap()
    {
        return [
            'categories' => 'getCategories',
            'spell_container' => 'getSpellContainer',
            'spell' => 'getSpell',
            'name' => 'getStringWithCompareAttribute',
            'reference' => 'getString',
            'notes' => 'getStringWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'open', 'categories', 'spell_container', 'spell', 'name', 'reference', 'notes'], 'safe'],
        ];
    }
}
