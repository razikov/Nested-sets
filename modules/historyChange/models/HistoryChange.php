<?php

namespace app\modules\historyChange\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\models\User;

class HistoryChange extends ActiveRecord
{
    const ACTION_UPDATE = 1;

    public static function tableName()
    {
        return 'history_change';
    }

    public function rules()
    {
        return [
            [['model_name', 'model_id', 'attribute'], 'required'],
            [['action', 'model_id', 'user_id'], 'integer'],
            [['action'], 'default', 'value' => self::ACTION_UPDATE],
            [['model_name', 'attribute'], 'string', 'max' => 255],
        ];
    }
    
    public static function findAllForModel($modelName, $modelId)
    {
        $query = parent::find();
        $query->andWhere(['model_name' => $modelName]);
        $query->andWhere(['model_id' => $modelId]);
        $query->orderBy(['id' => SORT_DESC]);
        return $query;
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'model_name' => \Yii::t('app', 'Модель'),
            'model_id' => \Yii::t('app', 'ID Модели'),
            'attribute' => \Yii::t('app', 'Атрибут'),
            'old_value' => \Yii::t('app', 'Старое Значение'),
            'new_value' => \Yii::t('app', 'Новое Значение'),
            'action' => \Yii::t('app', 'Действие'),
            'change_at' => \Yii::t('app', 'Изменено'),
            'user_id' => \Yii::t('app', 'Изменил'),
        );
    }
    
    public function getUser()
    {
        return User::findIdentity($this->user_id);
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'change_at',
                'updatedAtAttribute' => 'change_at',
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
        ];
    }
}
