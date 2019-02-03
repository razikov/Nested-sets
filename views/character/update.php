<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Select;
use app\widgets\CKEditor;

$form = ActiveForm::begin([
        
]); 

?>
<div class="content--header">
    <h1 class="title"><?= $this->title ?></h1>
</div>
<fieldset class="fieldset">
    <div class="fieldset--row">
        <div class="row">
            <div class="col-sm-24 fieldset--col"> 
                <div class="fieldset--padding">
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'strength'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'dexterity'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'intelegence'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'health'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'hitPoints'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'will'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'perception'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'fatiguePoints'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseSpeed'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseMove'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseLoad')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'load')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'burdenName')->input('text', ['disabled' => true]); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'directDamage')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'amplitudeDamage')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'move')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Парирование: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Блок: 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        Очков: <?= $model->total_points ?>; Очков в характеристиках: <?= $model->attributeCost ?>; Осталось: <?= $model->total_points - $model->attributeCost ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br>
        </div>
    </div>
</fieldset>
    
<div class="content--footer--toolbar">
    <?= Html::submitButton(
        Yii::t('app', 'Сохранить'),
        ['class' => 'btn btn-green']
    ) ?>
    <a class="btn btn-outline btn-outline--green" href="<?= \yii\helpers\Url::toRoute('list') ?>">
        <?=Yii::t('app', 'Отмена')?>
    </a>
</div>
<?php ActiveForm::end(); ?>