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
class BasicModel extends \yii\base\Model
{
    public $result = [];
    
    public function __construct($domElement)
    {
        $elements = $domElement->childNodes;
        
        for ($i = $elements->length; --$i >= 0; ) {
            $el = $elements->item($i);
            $type = $el->nodeType;
            if (in_array($type, [XML_TEXT_NODE, XML_COMMENT_NODE])) {
                continue;
            }
            foreach ($this->getAttrs() as $attr) {
                $this->result[$attr] = $domElement->getAttribute($attr);
            }
            $f = \yii\helpers\ArrayHelper::getValue($this->getMap(), $el->nodeName, false);
            if ($f) {
                $this->$f($el);
            } else {
                throw new \yii\base\Exception(sprintf('Функция %s не найдена', $el->nodeName));
            }
        }
        $this->load($this->result, '');
//        $this->result = true;
//        var_dump($this->result);exit;
        
        return $this;
    }
    
    public function getAttrs()
    {
        return [];
    }
    
    public function getMap()
    {
        return [];
    }
    
    public function getAdvantage($el)
    {
        $this->result[$el->nodeName][] = new Advantage($el);
    }
    
    public function getAdvantageList($el)
    {
        $this->result[$el->nodeName] = new AdvantageList($el);
    }
    
    public function getAdvantageContainer($el)
    {
        $this->result[$el->nodeName][] = new AdvantageContainer($el);
    }
    
    public function getPrintSettings($el)
    {
        $this->result[$el->nodeName] = 'Не поддерживается';
    }
    
    public function getProfile($el)
    {
        $this->result[$el->nodeName] = new Profile($el);
    }
    
    public function getDefault($el)
    {
        $this->result[$el->nodeName][] = new Default_my($el);
    }
    
    public function getCategories($el)
    {
        $this->result[$el->nodeName] = new Categories($el);
    }
    
    public function getCategory($el)
    {
        $this->result[$el->nodeName][] = trim($el->nodeValue);
    }
    
    public function getPrereqList($el)
    {
        $this->result[$el->nodeName][] = new PrereqList($el);
    }
    
    public function getContainedWeightPrereq($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'has' => trim($el->getAttribute('has')), // yes|no, no == отрицание условия
            'compare' => trim($el->getAttribute('compare')), // =(is) !=(is not) <=(at least) >=(at most)
        ];
    }
    
    public function getAdvantagePrereq($el)
    {
        $this->result[$el->nodeName][] = new AdvantagePrereq($el);
    }
    
    public function getAttributePrereq($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'has' => trim($el->getAttribute('has')), // yes|no, no == отрицание условия
            'which' => trim($el->getAttribute('which')), // атрибут на который будет оказано действие
            'compare' => trim($el->getAttribute('compare')), // =(is) !=(is not) <=(at least) >=(at most)
            'combined_with' => trim($el->getAttribute('combined_with')),
        ];
    }
    
    public function getEquipment($el)
    {
        $this->result[$el->nodeName][] = new Equipment($el);
    }
    
    public function getEquipmentList($el)
    {
        $this->result[$el->nodeName] = new EquipmentList($el);
    }
    
    public function getEquipmentContainer($el)
    {
        $this->result[$el->nodeName][] = new EquipmentContainer($el);
    }
    
    public function getNoteContainer($el)
    {
        $this->result[$el->nodeName][] = new NoteContainer($el);
    }
    
    public function getNoteList($el)
    {
        $this->result[$el->nodeName][] = new NoteList($el);
    }
    
    public function getNote($el)
    {
        $this->result[$el->nodeName][] = new Note($el);
    }
    
    public function getSkill($el)
    {
        $this->result[$el->nodeName][] = new Skill($el);
    }
    
    public function getTechnique($el)
    {
        $this->result[$el->nodeName][] = new Technique($el);
    }
    
    public function getSkillList($el)
    {
        $this->result[$el->nodeName] = new SkillList($el);
    }
    
    public function getSkillPrereq($el)
    {
        $this->result[$el->nodeName][] = new SkillPrereq($el);
    }
    
    public function getSpellPrereq($el)
    {
        $this->result[$el->nodeName][] = new SpellPrereq($el);
    }
    
    public function getDrBonus($el)
    {
        $this->result[$el->nodeName] = new DrBonus($el);
    }
    
    public function getAttributeBonus($el)
    {
        $this->result[$el->nodeName][] = new AttributeBonus($el);
    }
    
    public function getSkillBonus($el)
    {
        $this->result[$el->nodeName][] = new SkillBonus($el);
    }
    
    public function getSpellBonus($el)
    {
        $this->result[$el->nodeName][] = new SpellBonus($el);
    }
    
    public function getMeleeWeapon($el)
    {
        $this->result[$el->nodeName][] = new MeleeWeapon($el);
    }
    
    public function getRangedWeapon($el)
    {
        $this->result[$el->nodeName][] = new RangedWeapon($el);
    }
    
    public function getCostReduction($el)
    {
        $this->result[$el->nodeName] = new CostReduction($el);
    }
    
    public function getCr($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'adj' => trim($el->getAttribute('adj')),
        ];
    }
    
    public function getCost($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'type' => trim($el->getAttribute('type')), // $this->getAvailableCostTypes
            'per_level' => trim($el->getAttribute('per_level')),
        ];
    }
    
    public function getAttribute($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'limitation' => trim($el->getAttribute('limitation')), // not work
        ];
    }
    
    public function getAmount($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'per_level' => trim($el->getAttribute('per_level')),
        ];
    }
    
    public function getModifier($el)
    {
        $this->result[$el->nodeName][] = new Modifier($el);
    }
    
    public function getStringWithCompareAttribute($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'compare' => trim($el->getAttribute('compare')),
        ];
    }
    
    public function getCollegeType($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'compare' => trim($el->getAttribute('compare')),
        ];
    }
    
    public function getIntegerWithCompareAttribute($el)
    {
        $this->result[$el->nodeName] = [
            'value' => trim($el->nodeValue),
            'compare' => trim($el->getAttribute('compare')),
        ];
    }
    
    public function getString($el)
    {
        $this->result[$el->nodeName] = trim($el->nodeValue);
    }
    
    public function getInteger($el)
    {
        $this->result[$el->nodeName] = (int)trim($el->nodeValue);
    }
    
    public function getDecimal($el)
    {
        $this->result[$el->nodeName] = (float)trim($el->nodeValue);
    }
    
    public function getUnsignedInt($el)
    {
        $this->result[$el->nodeName] = (int)trim($el->nodeValue);
    }
    
    public function getShort($el)
    {
        $this->result[$el->nodeName] = (int)trim($el->nodeValue);
    }
    
    public function getUnsignedShort($el)
    {
        $this->result[$el->nodeName] = (int)trim($el->nodeValue);
    }
    
    public function getBoolean($el)
    {
        $this->result[$el->nodeName] = (bool)trim($el->nodeValue);
    }
    
    
    public function getAvailableCostTypes()
    {
        return [
            'points',
            'percentage',
            'multiplier',
            'race', // ??
            'meta_trait', // ??
            'alternative_abilities', // ??
        ];
    }
}
