<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\HoldingSearch
 * @var $form yii\widgets\ActiveForm
 */
$this->registerJs('$("body").on("click", ".js-filter", function () { $("#js-search").toggle(); });');
?>
<?= Html::a(Yii::t('app', 'Фильтр'), '#', ['class' => 'btn btn-success js-filter']) ?>

<div id="js-search" style="display: none;">
    <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get',]); ?>
    <section class="content-filters">
        <div class="css-xs-padding row">
            <div class="col-sm-4">
                <?= $form->field($model, 'teacher')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'name')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'division')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'wdate')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'startTime')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'endTime')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'class')->textInput(['class' => 'form-control input-sm']); ?>
            </div>
            <div class="col-sm-3">
                <div class="form-group"> 
                    <label for="" class="control-label">&nbsp;</label>
                    <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Сброс'), [''], ['class' => 'btn btn-sm btn-default']) ?>
                </div>
            </div>
        </div>
    </section>
    <?php ActiveForm::end(); ?>
</div>
