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
class Character extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort, required
    // неограниченный
    public $skill_list; //ref
    public $advantage_list; //ref
    public $spell_list; //ref
    public $equipment_list; //ref
    public $note_list; //ref
    public $profile; //ref
    public $print_settings; //ref
    public $created_date; //string
    public $modified_date; //string
    public $hp; //unsignedShort
    public $fp; //short
    public $total_points; //short
    public $st; //unsignedShort
    public $dx; //unsignedInt
    public $iq; //unsignedShort
    public $ht; //unsignedShort
    public $will; //unsignedShort
    public $perception; //unsignedShort
    public $speed; //decimal
    public $move; //unsignedShort
    public $include_punch; //boolean
    public $include_kick; //boolean
    public $include_kick_with_boots; //boolean
    
    const BASE_STRENGTH = 10;
    const BASE_DEXTERITY = 10;
    const BASE_INTELEGENCE = 10;
    const BASE_HEALTH = 10;
    const BASE_SPEED_POINT_PER_LEVEL = 0.25;
    
    const COST_STRENGTH = 10;
    const COST_DEXTERITY = 20;
    const COST_INTELEGENCE = 20;
    const COST_HEALTH = 10;
    const COST_HIT_POINT = 2;
    const COST_WILL = 5;
    const COST_PERCEPTION = 5;
    const COST_FATIGUE_POINTS = 3;
    const COST_BASE_SPEED = 5;
    const COST_MOVE = 5;
    
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
            'skill_list' => 'getSkillList',
            'advantage_list' => 'getAdvantageList',
            'spell_list' => 'getSpellList',
            'equipment_list' => 'getEquipmentList',
            'note_list' => 'getNoteList',
            'profile' => 'getProfile',
            'print_settings' => 'getPrintSettings',
            'created_date' => 'getString',
            'modified_date' => 'getString',
            'HP' => 'getUnsignedShort',
            'FP' => 'getShort',
            'total_points' => 'getShort',
            'ST' => 'getUnsignedShort',
            'DX' => 'getUnsignedShort',
            'IQ' => 'getUnsignedShort',
            'HT' => 'getUnsignedShort',
            'will' => 'getUnsignedShort',
            'perception' => 'getUnsignedShort',
            'speed' => 'getDecimal',
            'move' => 'getUnsignedShort',
            'include_punch' => 'getBoolean',
            'include_kick' => 'getBoolean',
            'include_kick_with_boots' => 'getBoolean',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'skill_list', 'advantage_list',
                'spell_list', 'equipment_list', 'note_list', 'profile',
                'created_date', 'modified_date', 'HP', 'FP', 'total_points',
                'ST', 'DX', 'IQ', 'HT', 'will', 'perception', 'speed',
                'move', 'include_punch', 'include_kick', 'include_kick_with_boots'], 'safe'],
        ];
    }
    
    public function setHP($value)
    {
        $this->hp = $value;
        return $this;
    }
    
    public function getHP()
    {
        return $this->hp + $this->ST;
    }
    
    public function setFP($value)
    {
        $this->fp = $value;
        return $this;
    }
    
    public function getFP()
    {
        return $this->fp + $this->HT;
    }
    
    public function setST($value)
    {
        $this->st = $value;
        return $this;
    }
    
    public function getST()
    {
        return $this->st;
    }
    
    public function setDX($value)
    {
        $this->dx = $value;
        return $this;
    }
    
    public function getDX()
    {
        return $this->dx;
    }
    
    public function setIQ($value)
    {
        $this->iq = $value;
        return $this;
    }
    
    public function getIQ()
    {
        return $this->iq;
    }
    
    public function setHT($value)
    {
        $this->ht = $value;
        return $this;
    }
    
    public function getHT()
    {
        return $this->ht;
    }
    
    public function getWill()
    {
        return $this->will + $this->IQ;
    }
    
    public function getPerception()
    {
        return $this->perception + $this->IQ;
    }
    
    public function getAttributeBonusByName($name)
    {
        $fGetAdvantages = function($container) use (&$fGetAdvantages) {
            $advantageList = [];
            if ($container->advantage_container) {
                foreach($container->advantage_container as $subContainer) {
                    $advantageList = array_merge($advantageList, $fGetAdvantages($subContainer));
                }
            }
            if ($container->advantage) {
                foreach($container->advantage as $advantage) {
                    $advantageList[] = $advantage;
                }
            }
            return $advantageList;
        };
        $advantageList = $fGetAdvantages($this->advantage_list);
        
        $bonusList = [];
        foreach($advantageList as $advantage) {
            if ($advantage->attribute_bonus) {
                $bonusList = array_merge($bonusList, $advantage->attribute_bonus);
            }
        }
        
        $result = 0;
        foreach ($bonusList as $bonus) {
            if ($bonus->attribute['value'] == $name) {
                $result += (int)$bonus->amount['value'];
            }
        }
        return $result;
    }
}
