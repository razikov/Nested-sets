<?php

namespace app\modules\UserImportExport\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class User extends \yii\db\ActiveRecord
{
    const OBJECT_TYPE = 'usr';
    
    const GENDER_MALE = 'm';
    const GENDER_FEMALE = 'f';
    const GENDER_UNDEFINED = 'n';
    
    public $rawPassword;
    public $role_ids;

    public static function getDb()
    {
        return Yii::$app->get('ilias');
    }
    
    public static function tableName()
    {
        return 'usr_data';
    }
    
    public function attributeLabels()
    {
        return [
            'login' => Yii::t('app', 'Логин'),
            'passwd' => Yii::t('app', 'Пароль'),
            'rawPassword' => Yii::t('app', 'Пароль'),
            'lastname' => Yii::t('app', 'Фамилия'),
            'firstname' => Yii::t('app', 'Имя'),
        ];
    }
    
    public function rules()
    {
        return [
            [['gender'], 'default', 'value' => self::GENDER_UNDEFINED],
            [['create_date'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['active', 'time_limit_unlimited'], 'default', 'value' => true],
            [['auth_mode'], 'default', 'value' => 'local'],
            [['passwd_enc_type'], 'default', 'value' => 'md5'],
            [['login', 'firstname', 'email', 'gender'], 'required'],
            [['lastname'], 'required'], // возможно стоит отключить!
            [['role_ids'], 'required'],
            [['role_ids'], 'roleValidate'],
            [['passwd', 'rawPassword'], 'required'], // обязателен только при создании
            [['rawPassword'], 'string', 'min' => 6],
            [['login'], 'unique'],
            [
                ['lastname', 'firstname', 'email', 'phone_office', 'login', 
                    'rawPassword', 'passwd', 'institution', 'create_date', 
                    'auth_mode', 'passwd_enc_type', 'roles'],
                'safe',
            ],
        ];
    }
    
    public function roleValidate($attribute, $params)
    {
        $invalid = true;
        foreach ($this->roles as $role) {
            if ($role->hasGlobal()) {
                $invalid = false;
            }
        }
        if ($invalid) {
            $this->addError($attribute, 'Пользователь должен иметь по крайней мере 1 глобальную роль');
        }
    }
    
    public function getFullName()
    {
        return trim($this->lastname . ' ' . $this->firstname);
    }
    
    public function getValidUntil()
    {
        $now = new \DateTime();
        if ($this->time_limit_unlimited) {
            return 'Неограничен';
        } elseif ($now->getTimestamp() < $this->time_limit_from) {
            return 'Срок действия не начался';
        } elseif ($now->getTimestamp() > $this->time_limit_until) {
            return 'Срок действия истёк';
        }
        return '';
    }
    
    public function getObjectData()
    {
        return $this->hasOne(ObjectData::class, ['obj_id' => 'usr_id'])
                        ->andWhere(['type' => self::OBJECT_TYPE]);
    }
    
    public function getRoles()
    {
        return Role::find()->andFilterWhere(['role_id' => $this->role_ids])->all();
    }
    
}
