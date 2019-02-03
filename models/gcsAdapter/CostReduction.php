<?php

namespace app\models\gcsAdapter;

/**
 * Уменьшение стоимости атрибутов в процентах
 *
 * @author aleksey
 */
class CostReduction extends BasicModel
{
    public $attribute; //string
    public $percentage; //integer
    
    
    public function getMap()
    {
        return [
            'attribute' => 'getString',
            'percentage' => 'getInteger',
        ];
    }
    
    public function rules()
    {
        return [
            [['attribute', 'percentage'], 'safe'],
        ];
    }
}
