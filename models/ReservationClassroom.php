<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class ReservationClassroom extends ActiveRecord
{
    public $startTime;
    public $endTime;


    public function rules()
    {
        return [
            [['id_themes', 'time_start_at', 'classroom'], 'required'],
            [['id'], 'number'],
            [['id_themes'], 'number'],
            [['classroom'], 'string'],
            [['startTime', 'endTime'], 'string'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'id_themes' => Yii::t('app', 'Занятие'),
            'classroom' => Yii::t('app', 'Аудитория'),
            'time_start_at' => Yii::t('app', '(Время) С'),
            'time_end_at' => Yii::t('app', '(Время) По'),
        ];
    }
    
    public static function getDb()
    {
        return \Yii::$app->get('schedule');
    }

    public static function tableName()
    {
        return '{{%rasp_reservation}}';
    }

}