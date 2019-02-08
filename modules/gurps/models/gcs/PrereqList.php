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
class PrereqList extends BasicModel
{
    public $all; //required, YesNo
    // неограниченный
    public $prereq_list; //ref
    public $skill_prereq; //ref
    public $spell_prereq; //ref
    public $attribute_prereq; //ref
    public $advantage_prereq; //ref
    public $contained_weight_prereq; //ref
    public $when_tl; //IntegerWithCompareAttribute
    public $college_count; //IntegerWithCompareAttribute
    
    
    public function getAttrs()
    {
        return [
            'all',
        ];
    }
    
    public function getMap()
    {
        return [
            'prereq_list' => 'getPrereqList',
            'skill_prereq' => 'getSkillPrereq',
            'spell_prereq' => 'getSpellPrereq',
            'attribute_prereq' => 'getAttributePrereq',
            'advantage_prereq' => 'getAdvantagePrereq',
            'contained_weight_prereq' => 'getContainedWeightPrereq',
            'when_tl' => 'getIntegerWithCompareAttribute',
            'college_count' => 'getIntegerWithCompareAttribute',
        ];
    }
    
    public function rules()
    {
        return [
            [['all', 'prereq_list', 'skill_prereq', 'spell_prereq', 'attribute_prereq',
                'advantage_prereq', 'contained_weight_prereq', 'when_tl', 'college_count'], 'safe'],
        ];
    }
}
