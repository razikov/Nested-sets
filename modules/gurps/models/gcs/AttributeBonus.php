<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\gurps\models\gcs;

/*
 * Премии возможны для следующих аттрибутов:
 * СЛ,ЛВ,ИН,ЗД,
 * Воля, Проверки страха, Восприятие, зрение, слух, вкус и запах, осязание,
 * уклонение, парирование, блок,
 * БС,БД,ЕУ,ЕЖ,МР
 */

/**
 *
 * @author aleksey
 */
class AttributeBonus extends BasicModel
{
    public $attribute; //ref
    public $amount; //ref
    
    public function getMap()
    {
        return [
            'attribute' => 'getAttribute',
            'amount' => 'getAmount',
        ];
    }
    
    public function rules()
    {
        return [
            [['attribute', 'amount'], 'safe'],
        ];
    }
}
