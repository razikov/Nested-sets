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
class Note extends BasicModel
{
    public $version; //unsignedShort, required
    // неограниченный
    public $text; //string
    
    
    public function getAttrs()
    {
        return [
            'version',
        ];
    }
    
    public function getMap()
    {
        return [
            'text' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['version', 'text'], 'safe'],
        ];
    }
}