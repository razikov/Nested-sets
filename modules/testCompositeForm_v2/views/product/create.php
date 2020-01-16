<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
 
    <h2>Common</h2>
 
    <?= $form->field($productForm, 'code')->textInput() ?>
    <?= $form->field($productForm, 'name')->textInput() ?>
 
    <h2>Price</h2>
 
    <?= $form->field($priceForm, 'new')->textInput() ?>
    <?= $form->field($priceForm, 'old')->textInput() ?>
 
    <h2>Characteristics</h2>
 
    <?php foreach ($valueForms as $i => $valueForm): ?>
        <?= $form->field($valueForm, '[' . $i . ']value')->textInput() ?>
    <?php endforeach; ?>
 
    <h2>SEO</h2>
 
    <?= $form->field($metaForm, 'title')->textInput() ?>
    <?= $form->field($metaForm, 'description')->textarea(['rows' => 2]) ?>
 
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
 
<?php ActiveForm::end(); ?>