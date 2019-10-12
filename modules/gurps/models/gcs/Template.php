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
class Template extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort, required
    // неограниченно
    public $skill_list; //ref
    public $advantage_list; //ref
    public $spell_list; //ref
    public $equipment_list; //ref
    public $note_list; //ref
    public $notes; //string
    
    
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
            'notes' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'skill_list', 'advantage_list',
                'spell_list', 'equipment_list', 'note_list', 'notes'], 'safe'],
        ];
    }
}
