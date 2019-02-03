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
class Profile extends BasicModel
{
    public $player_name; //string
    public $campaign; //string
    public $name; //string
    public $title; //string
    public $age; //unsignedShort
    public $birthday; //string
    public $eyes; //string
    public $hair; //string
    public $skin; //string
    public $handedness; //string
    public $height; //string
    public $weight; //string
    public $sm; //short
    public $gender; //string
    public $race; //string
    public $body_type; //string
    public $notes; //string
    public $tech_level; //string
    public $portrait; //string
    
    
    public function getMap()
    {
        return [
            'player_name' => 'getString',
            'campaign' => 'getString',
            'name' => 'getString',
            'title' => 'getString',
            'age' => 'getUnsignedShort',
            'birthday' => 'getString',
            'eyes' => 'getString',
            'hair' => 'getString',
            'skin' => 'getString',
            'handedness' => 'getString',
            'height' => 'getString',
            'weight' => 'getString',
            'SM' => 'getString',
            'gender' => 'getString',
            'race' => 'getString',
            'body_type' => 'getString',
            'notes' => 'getString',
            'tech_level' => 'getString',
            'portrait' => 'getString',
        ];
    }
    
    public function rules()
    {
        return [
            [['player_name', 'campaign', 'name', 'title', 'age', 'birthday',
                'eyes', 'hair', 'skin', 'handedness', 'height', 'weight',
                'SM', 'gender', 'race', 'body_type', 'notes', 'tech_level',
                'portrait'], 'safe'],
        ];
    }
    
    public function setSM($value)
    {
        $this->sm = $value;
        return $this;
    }
    
    public function getSM()
    {
        return $this->sm;
    }
}
