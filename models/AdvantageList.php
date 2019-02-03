<?php

namespace app\models;

use Yii;

class AdvantageList extends \yii\db\ActiveRecord
{
    public $id; //string
    public $unique_id; //string
    public $version; //unsignedShort
    // неограниченный
    public $advantage_container; //ref
    public $advantage; //ref
    
    public static function tableName()
    {
        return 'advantage_list';
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
//            'unique_id' => Yii::t('app', 'uniqueId'),
//            'version' => Yii::t('app', 'Версия'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'description', 'type', 'meta_type', 'types', 'cost'], 'safe'],
        ];
    }
}
