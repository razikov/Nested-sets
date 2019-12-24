<?php
namespace app\models;

use yii\db\ActiveRecord;
use app\models\Terms;

class Definitions extends ActiveRecord
{
    
    public static function getDb()
    {
        return \Yii::$app->get('dictionary');
    }

    public static function tableName()
    {
        return '{{%definitions}}';
    }
    
    public function getTerm()
    {
        return $this->hasOne(Terms::className(), ['id' => 'term_id']);
    }

}