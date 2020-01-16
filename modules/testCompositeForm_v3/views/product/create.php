<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<h2>Common</h2>

<?= $form->field($model, 'code')->textInput() ?>
<?= $form->field($model, 'name')->textInput() ?>

<h2>Price</h2>

<?= $form->field($model->price, 'new')->textInput() ?>
<?= $form->field($model->price, 'old')->textInput() ?>

<h2>Characteristics</h2>

<?php foreach ($model->values as $i => $valueForm): ?>
    <?= $form->field($valueForm, '[' . $i . ']value')->textInput() ?>
<?php endforeach; ?>

<h2>SEO</h2>

<?= $form->field($model->meta, 'title')->textInput() ?>
<?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>

<?php ActiveForm::end(); ?>