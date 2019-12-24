<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\Holding
 * @var $form yii\widgets\ActiveForm
 */
?>

<?php Modal::begin([
    'header' => '<h4 class="modal-title">'.($model->isNewRecord ? Yii::t('app', 'Создание') : Yii::t(
            'app',
            'Редактирование'
        )).'</h4>',
    'footer' =>
        Html::button(Yii::t('app', 'Закрыть'), ['class' => 'btn btn-sm btn-default', 'data-dismiss' => 'modal']).
        Html::button(
            $model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Сохранить'),
            ['class' => 'btn btn-primary js-submit']
        )
]); ?>
<?= Html::errorSummary($model) ?>
<?php $form = ActiveForm::begin(['options' => ['autocomplete' => 'off']]); ?>
<?= $form->field($model, 'teacher')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'name')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'division')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'wdate')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'startTime')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'endTime')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'class')->textInput(['class' => 'form-control']); ?>
<?php ActiveForm::end(); ?>
<?php Modal::end() ?>