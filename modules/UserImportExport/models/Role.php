<?php

namespace app\modules\UserImportExport\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class Role extends \yii\db\ActiveRecord
{
    const OBJECT_TYPE = 'role';

    public static function getDb()
    {
        return Yii::$app->get('ilias');
    }
    
    public static function tableName()
    {
        return 'role_data';
    }
    
    public function attributeLabels()
    {
        return [
        ];
    }
    
    public function rules()
    {
        return [
            ['title', 'validateTitle'],
        ];
    }
    
    public function validateTitle($attribute, $params)
    {
        if (strpos($this->title, 'il_') === true) {
            $this->addError($attribute, 'префикс "il_" в название роли зарезервировано, смените название');
        }
    }
    
    public function getObjectData()
    {
        return $this->hasOne(ObjectData::class, ['obj_id' => 'role_id'])
            ->andWhere(['obj_id' => $this->role_id]);
    }
    
    public function hasGlobal()
    {
        return Yii::$app->get('ilias')
                ->createCommand("SELECT 1 FROM ilias.rbac_fa where rol_id = :role_id and parent = 8 and assign = 'y'", [':role_id' => $this->role_id])
                ->queryScalar();
    }
    
    public function getIliasId()
    {
        //il_0_TYPE_ID
        return sprintf("il_0_%s_%s", self::OBJECT_TYPE, $this->role_id);
    }
    
}
