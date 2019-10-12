<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$form = ActiveForm::begin([
    
]);
?>
<fieldset>
    <?= $form->field($model, 'login'); ?>
    <?= $form->field($model, 'password'); ?>
</fieldset>
<?= Html::submitButton(
        $model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Сохранить'),
        ['class' => 'btn btn-sm btn-primary', 'id' => 'js-save-form']
    ); ?>
<?php
ActiveForm::end();