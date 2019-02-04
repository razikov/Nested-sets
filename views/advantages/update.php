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
//                                        'disabled' => true,
                                    ],
                                    'items' =>  $model->getAvailableMetaType(),
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
                            <?= $form->field($model, 'types')->widget(
                                Select::class,
                                [
                                    'options' => [
                                        'class' => 'form-control ',
                                        'data-style' => 'btn-default',
                                        'data-width' => '100%',
                                        'multiple' => true,
                                    ],
                                    'items' =>  $model->getAvailableTypes(),
                                ]
                            ); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'cost') ?>
                        </div>
                    </div>
                </div>
            </div>
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