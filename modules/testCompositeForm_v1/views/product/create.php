<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
        ]);
?>
<div>
    <h1><?= $this->title ?></h1>
</div>

<fieldset>
    <div class="row">
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'code') ?>
        </div>
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'price_new') ?>
        </div>
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'price_old') ?>
        </div>
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'meta_title') ?>
        </div>
        <div class="col-sm-12 col-xl-6">
            <?= $form->field($model, 'meta_description') ?>
        </div>
    </div>
</fieldset>

<div>
    <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-default']); ?>
    <a class="btn btn-default" href="<?= Url::toRoute('list') ?>">
        <?= Yii::t('app', 'Отмена') ?>
    </a>
</div>
<?php ActiveForm::end(); ?>