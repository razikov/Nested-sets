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
        return $this->hp + $this->ST + $this->getBonusByName('hp');
    }
    
    public function setFP($value)
    {
        $this->fp = $value;
        return $this;
    }
    
    public function getFP()
    {
        return $this->fp + $this->HT + $this->getBonusByName('fp');
    }
    
    public function setST($value)
    {
        $this->st = $value - 10;
        return $this;
    }
    
    public function getST()
    {
        return $this->st + 10 + $this->getBonusByName('st');
    }
    
    public function setDX($value)
    {
        $this->dx = $value - 10;
        return $this;
    }
    
    public function getDX()
    {
        return $this->dx + 10 + $this->getBonusByName('dx');
    }
    
    public function setIQ($value)
    {
        $this->iq = $value - 10;
        return $this;
    }
    
    public function getIQ()
    {
        return $this->iq + 10 + $this->getBonusByName('iq');
    }
    
    public function setHT($value)
    {
        $this->ht = $value - 10;
        return $this;
    }
    
    public function getHT()
    {
        return $this->ht + 10 + $this->getBonusByName('ht');
    }
    
    public function getWill()
    {
        return $this->will + $this->IQ + $this->getBonusByName('will');
    }
    
    public function getPerception()
    {
        return $this->perception + $this->IQ + $this->getBonusByName('perception');
    }
    
    public function getBonusByName($name)
    {
        $result = 0;
        foreach ($this->advantage_list->getAllAttributeBonus() as $bonus) {
            if ($bonus->attribute['value'] == $name) {
                $result += (int)$bonus->amount['value'];
            }
        }
        return $result;
    }
}
