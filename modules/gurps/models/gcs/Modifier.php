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
class Modifier extends BasicModel
{
    public $version; //unsignedShort
    public $enabled; //YesNo
    
    public $cost; //ref
    public $skill_bonus; //ref
    public $attribute_bonus; //ref
    public $name; //StringWithCompareAttribute
    public $notes; //StringWithCompareAttribute
    public $levels; //unsignedInt
    public $reference; //string
    public $affects; //string
    
    public function getAttrs()
    {
        return [
            'version',
            'enabled',
        ];
    }
    
    public function getMap()
    {
        return [
            'cost' => 'getCost',
            'skill_bonus' => 'getSkillBonus',
            'attribute_bonus' => 'getAttributeBonus',
            'name' => 'getStringWithCompareAttribute',
            'notes' => 'getStringWithCompareAttribute',
            'levels' => 'getUnsignedInt',
            'reference' => 'getString',
            'affects' => 'getString', // total || base only || levels only
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'enabled', 'cost', 'skill_bonus', 'attribute_bonus',
                'name', 'notes', 'levels', 'reference','affects'], 'safe'],
        ];
    }
    
}
