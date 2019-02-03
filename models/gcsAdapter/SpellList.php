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
class SpellList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $spell_container; //ref
    public $spell; //ref
    
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
            'spell_container' => 'getSpellComtainer',
            'spell' => 'getSpell',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'spell_container', 'spell'], 'safe'],
        ];
    }
}
