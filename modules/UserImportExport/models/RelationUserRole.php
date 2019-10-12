<?php

namespace app\modules\UserImportExport\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class RelationUserRole extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->get('ilias');
    }
    
    public static function tableName()
    {
        return 'rbac_ua';
    }
    
    public function attributeLabels()
    {
        return [
        ];
    }
    
    public function rules()
    {
        return [
        ];
    }
    
}
