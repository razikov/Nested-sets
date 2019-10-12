<?php

namespace app\modules\historyChange\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use app\modules\historyChange\models\HistoryChange;

class LoggableBehavior extends Behavior
{

    public $allowed = [];
    public $ignored = [];

    public function init()
    {
        parent::init();
        $this->ignored = ArrayHelper::merge($this->ignored, ['created_at', 'updated_at']);
    }
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'customAfterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'customAfterDelete',
        ];
    }
    
    public function customAfterUpdate($event)
    {
        $changedAttributes = $event->changedAttributes;
        $model = $event->sender;
        
        if (!empty($this->allowed)) {
            $changedAttributes = ArrayHelper::filter($changedAttributes, $this->allowed);
        }
        
        if (!$model->isNewRecord && $changedAttributes) {
            foreach ($changedAttributes as $attribute => $oldValue) {
                $newValue = $model->getAttribute($attribute);
                if ($oldValue == $newValue || in_array($attribute, $this->ignored)) {
                    continue;
                }
                
                $modelHistory = new HistoryChange();
                $modelHistory->model_name = get_class($model);
                $modelHistory->model_id = $model->id;
                $modelHistory->attribute = $attribute;
                $modelHistory->old_value = $oldValue;
                $modelHistory->new_value = $newValue;
                if (!$modelHistory->save()) {
                    throw new ErrorException(\Yii::t('app', 'Ошибка сохранения Истории изменений'));
                }
            }
            
        }
        
    }
    
    public function customAfterDelete($event)
    {
        $model = $event->sender;
        Yii::$app->db->createCommand()->delete(HistoryChange::tableName(), [
            'model_name' => get_class($model),
            'model_id' => $model->id,
        ])->execute();
    }
}
