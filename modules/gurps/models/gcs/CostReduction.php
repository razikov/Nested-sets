<?php

namespace app\modules\gurps\models\gcs;

/**
 * Уменьшение стоимости атрибутов в процентах
 * возможно понижение для СЛ,ЛВ,ИН,ЗД
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
