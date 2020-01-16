<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class InfoCourseThemes extends ActiveRecord
{
    
    public function rules()
    {
        return [
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'IDCourse' => Yii::t('app', 'Курс'),
            'IDTheme' => Yii::t('app', 'Занятие'),
            'IDTeacher' => Yii::t('app', 'Куратор'),
            'Date1' => Yii::t('app', 'Дата'),
            'Time1' => Yii::t('app', 'Время'),
        ];
    }
    
    public function getTeacher()
    {
        return $this->hasOne(InfoTeacher::class, ['ID' => 'IDTeacher']);
    }
    
    public function getCourse()
    {
        return $this->hasOne(InfoCourse::class, ['ID' => 'IDCourse']);
    }
    
    public function getTheme()
    {
        return $this->hasOne(InfoThemes::class, ['ID' => 'IDTheme']);
    }
    
    public static function getDb()
    {
        return \Yii::$app->get('schedule_info');
    }

    public static function tableName()
    {
        return '{{%coursethemes}}';
    }

}