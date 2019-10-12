<?php

namespace app\modules\UserImportExport\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class ImportUser extends \yii\db\ActiveRecord
{
    const STAGE_IMPORT = 1;
    const STAGE_EDIT = 2;
    const STAGE_GENERATE_FILE = 3;
    const STAGE_EXPORT = 4;

//    public static function getDb()
//    {
//        return Yii::$app->get('ilias');
//    }
    
    public static function tableName()
    {
        return 'custom_import_user';
    }
    
    public function attributeLabels()
    {
        return [
            'step' => Yii::t('app', 'Этап'),
        ];
    }
    
    public function setRoleIds(array $value)
    {
        $this->role_ids = implode(',', $value);
        return $this;
    }
    
    public function getRoleIds()
    {
        return explode(',', $this->role_ids);
    }
    
    public function rules()
    {
        return [
            [['usersJson', 'upload_id', 'step', 'role_ids', 'upload_id_xml', 'upload_id_xls'], 'required'],
            [['upload_id', 'upload_id_xml', 'upload_id_xls'], 'number'],
            [['usersJson'], 'default', 'value' => ''],
            [['upload_id'], 'default', 'value' => null],
            [['step'], 'default', 'value' => self::STAGE_IMPORT],
        ];
    }
    
    public function getStepName()
    {
        $availableName = [
            self::STAGE_IMPORT => 'Импорт пользователей',
            self::STAGE_EDIT => 'Редактирование пользователей',
            self::STAGE_GENERATE_FILE => 'Подготовка файлов экспорта',
            self::STAGE_EXPORT => 'Экспорт пользователей',
        ];
        return \yii\helpers\ArrayHelper::getValue($availableName, $this->step, 'Не известен');
    }
    
    public function getUpload()
    {
        return $this->hasOne(\app\models\Upload::class, ['id' => 'upload_id']);
    }
    public function getUploadXls()
    {
        return $this->hasOne(\app\models\Upload::class, ['id' => 'upload_id_xls']);
    }
    public function getUploadXml()
    {
        return $this->hasOne(\app\models\Upload::class, ['id' => 'upload_id_xml']);
    }
    
}
