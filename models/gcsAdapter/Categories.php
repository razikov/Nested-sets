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
class Categories extends BasicModel
{
    public $category; // string
    
    
    public function getMap()
    {
        return [
            'category' => 'getCategory',
        ];
    }
    
    public function rules()
    {
        return [
            [['category'], 'safe'],
        ];
    }
    
}
