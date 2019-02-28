<?php

namespace app\modules\UserImportExport\models;

use Yii;
use app\modules\UserImportExport\models\query\FindPasswordQuery;

class FindPassword extends \yii\db\ActiveRecord
{

//    public static function getDb()
//    {
//        return Yii::$app->get('ilias');
//    }
    
    public static function find()
    {
        return new FindPasswordQuery(get_called_class());
    }
    
    public static function tableName()
    {
        return 'custom_user_pwd';
    }
    
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
        ];
    }
    
    public function rules()
    {
        return [
            [['login'], 'unique'],
            [
                ['login', 'password'],
                'safe',
            ],
        ];
    }
    
}
