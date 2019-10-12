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
class NoteList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $note; //ref
    public $note_container; //ref
    
    
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
            'note' => 'getNote',
            'note_container' => 'getNoteContainer',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'note', 'note_container'], 'safe'],
        ];
    }
}