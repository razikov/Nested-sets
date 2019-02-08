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
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'meta_type')->widget(
                                Select::class,
                                [
                                    'options' => [
                                        'class' => 'form-control ',
                                        'data-style' => 'btn-default',
                                        'data-width' => '100%',
                                    ],
                                    'items' =>  $model->getAvailableMetaTypes(),
                                ]
                            ); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'name_rus') ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'name') ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'type'); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'default'); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'requirement'); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'description')->widget(
                                CKEditor::class,
                                [
                                    'options' => [
                                        'class' => 'form-control',
                                    ],
                                ]
                            ); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'modifier') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
    
<div class="content--footer--toolbar">
    <?= Html::submitButton(
        Yii::t('app', 'Добавить'),
        ['class' => 'btn btn-green']
    ) ?>
    <a class="btn btn-outline btn-outline--green" href="<?= \yii\helpers\Url::toRoute('list') ?>">
        <?=Yii::t('app', 'Отмена')?>
    </a>
</div>
<?php ActiveForm::end(); ?>