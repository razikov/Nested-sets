<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

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
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'division' => Yii::t('app', 'Подразделение'),
            'teacher' => Yii::t('app', 'Куратор'),
            'name' => Yii::t('app', 'Курс'),
            'cstudent' => Yii::t('app', 'Cstudent'),
            'wdate' => Yii::t('app', 'Дата'),
            'startTime' => Yii::t('app', '(Время) С'),
            'endTime' => Yii::t('app', '(Время) По'),
            'class' => Yii::t('app', 'Аудитория'),
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