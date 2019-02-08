<?php

namespace app\modules\gurps\models;

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
