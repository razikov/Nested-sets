<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$form = ActiveForm::begin([
    'options' => [
        'enctype' => "multipart/form-data",
    ],
]);
?>
<fieldset>
    <div class="form-group<?= $errors ? ' has-error' : ''; ?>">
        <label class="control-label"></label>
        <?= Html::fileInput('file', null, ['id' => 'js-file']); ?>

        <div class="help-block help-block-error"><?= $errors ? Html::ul($errors) : ''; ?></div>
    </div>
</fieldset>
<?= Html::submitButton(
        Yii::t('app', 'Загрузить'),
        ['class' => 'btn btn-sm btn-primary']
    ); ?>
<?php
ActiveForm::end();