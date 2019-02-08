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
class EquipmentList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $equipment; //ref
    public $equipment_container; //ref
    
    
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
            'equipment' => 'getEquipment',
            'equipment_container' => 'getEquipmentContainer',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'equipment', 'equipment_container'], 'safe'],
        ];
    }
}