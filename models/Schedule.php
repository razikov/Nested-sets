<?php
namespace app\models;

use yii\db\ActiveRecord;
use app\models\Terms;

class Schedule extends ActiveRecord
{
    
    public function rules()
    {
        return [
            [['id'], 'number'],
            [['name'], 'string'],
            [['division', 'teacher', 'cstudent', 'wdate'], 'string'],
            [['startTime', 'endTime'], 'string'],
            [['class'], 'string'],
        ];
    }
    
    public static function getDb()
    {
        return \Yii::$app->get('schedule');
    }

    public static function tableName()
    {
        return '{{%rasp_event}}';
    }

}