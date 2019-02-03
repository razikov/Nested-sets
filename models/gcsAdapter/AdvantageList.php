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
class AdvantageList extends BasicModel
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $advantage_container; //ref
    public $advantage; //ref
    
    
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
            'advantage_container' => 'getAdvantageContainer',
            'advantage' => 'getAdvantage',
        ];
    }
    
    public function rules()
    {
        return [
            [['id', 'unique_id', 'version', 'advantage_container', 'advantage'], 'safe'],
        ];
    }
    
    public function render()
    {
        $str = '<div class="block"><b>Преимущества/Недостатки</b>';
        if ($this->advantage_container) {
            foreach ($this->advantage_container as $advantageContainer) {
                $str .= $advantageContainer->render(). '<br>';
            }
        }
        if ($this->advantage) {
            foreach($this->advantage as $advantage) {
                $str .= $advantage->render();
            }
        }
        $str .= '</div>';
        return $str;
    }
    
    // WeaponBonus
    // SpellBonus
    // SkillBonus
    // AttributeBonus
    public function getAllAttributeBonus()
    {
        $bonusList = [];
        if ($this->advantage_container) {
            foreach ($this->advantage_container as $advantageContainer) {
                $bonusList = \yii\helpers\ArrayHelper::merge($bonusList, $advantageContainer->getAllAttributeBonus());
            }
        }
        if ($this->advantage) {
            foreach ($this->advantage as $advantage) {
                if ($advantage->attribute_bonus) {
                    $bonusList = \yii\helpers\ArrayHelper::merge($bonusList, $advantage->attribute_bonus);
                }
            }
        }
        return $bonusList;
    }
}
