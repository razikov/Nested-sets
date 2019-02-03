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
class NoteContainer extends BasicModel
{
    public $open; //string, required
    public $version; //unsignedShort, required
    // неограниченный
    public $text; //string
    public $note; //ref
    
    
    public function getAttrs()
    {
        return [
            'open',
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'text' => 'getString',
            'note' => 'getNote',
        ];
    }
    
    public function rules()
    {
        return [
            [['open', 'version', 'text', 'note'], 'safe'],
        ];
    }
}