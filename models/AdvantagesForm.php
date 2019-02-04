<?php

namespace app\models;

use Yii;

class AdvantagesForm extends \yii\base\Model
{
    public $name;
    public $description;
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'description', 'type', 'meta_type', 'types', 'cost'], 'safe'],
        ];
    }
    
}
