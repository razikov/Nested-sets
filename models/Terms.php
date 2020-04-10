<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Definitions;

class Terms extends ActiveRecord
{
    
    public static function getDb()
    {
        return \Yii::$app->get('dictionary');
    }

    public static function tableName()
    {
        return '{{%terms}}';
    }
    
    public function getDefinitions()
    {
        return $this->hasMany(Definitions::className(), ['term_id' => 'id']);
    }
}
