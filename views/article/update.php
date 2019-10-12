<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Select;
use app\widgets\CKEditor;
use app\widgets\DateTimePicker;

$form = ActiveForm::begin([
        
]); 


//obj{
//    p1: ...,
//    p2: ...,
//    p3: ...,
//    items: [
//        obj{...}
//    ],
//}

// Есть row а есть listRow
//collectionObj{
//    items: [
//        obj{
//            p1: ...,
//            p2: ...,
//            p3: ...,
//        }, ...
//    ],
//    itemsContainer: [
//        objContainer{
//            items: [
//                obj{...}
//            ]
//            itemsContainer: [
//                objContainer{...},
//            ],
//        },
//    ],
//}

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
                            <?= $form->field($model, 'title') ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'publish_at')->widget(
                                DateTimePicker::class,
                                [
                                    'format' => 'Y-m-d H:i:00',
                                    'options' => [
                                        'class' => 'form-control input-sm',
                                    ],
                                ]
                            ); ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <?= $form->field($model, 'tagIds')->widget(
                                Select::class,
                                [
                                    'options' => [
                                        'class' => 'form-control ',
                                        'data-style' => 'btn-default',
                                        'data-width' => '100%',
                                        'prompt' => 'Не указано',
                                    ],
                                    'items' =>  $model->getAvailableTagList(),
                                ]
                            ); ?>
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
                            <?= $form->field($model, 'content')->widget(
                                CKEditor::class,
                                [
                                    'options' => [
                                        'class' => 'form-control',
                                        'language' => 'ru'
                                    ],
                                ]
                            ); ?>
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