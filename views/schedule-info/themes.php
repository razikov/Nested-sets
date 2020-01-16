<?php

use app\models\InfoCourse;
use app\models\InfoDivision;
use app\models\InfoTeacher;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Select;
use app\widgets\DatePicker;

$this->title = 'Tests';
$this->registerJs('
    bindModal(".js-show-modal", {
        beforeShow: function (_modal) {
            selectpicker(_modal);
            $(".timepicker", _modal).datetimepicker({
                format:"H:i", 
                lang: "ru", 
                datepicker:false,
                allowTimes:[
                    "8:00", "8:30",
                    "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30",
                    "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30",
                    "17:00", "17:30", "18:00",
                ]
            });
        }
    });
');
?>

<div>
    <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get',]); ?>
    <section class="content-filters">
        <div class="css-xs-padding row">
            <div class="col-sm-4">
                <?= $form->field($searchModel, 'idCourseDivision')->widget(
                    Select::class,
                    [
                    'options' => [
                        'class' => 'form-control',
                        'data-style' => 'btn-default',
                        'data-live-search' => 1,
                        'prompt' => Yii::t('app', 'Ничего не выбрано'),
                    ],
                    'items' => InfoDivision::getList()
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($searchModel, 'courseName')->textInput(['class' => 'form-control']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($searchModel, 'IDTeacher')->widget(
                    Select::class,
                    [
                    'options' => [
                        'class' => 'form-control',
                        'data-style' => 'btn-default',
                        'data-live-search' => 1,
                        'prompt' => Yii::t('app', 'Ничего не выбрано'),
                    ],
                    'items' => InfoTeacher::getList()
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($searchModel, 'themeName')->textInput(['class' => 'form-control']); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($searchModel, 'dateAt')->widget(
                    DatePicker::class, [
                        'format' => 'd.m.Y',
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'params' => [
                            'weeks' => true,
                        ],
                    ]);
                ?>
            </div>
            <div class="col-sm-3">
                <div class="form-group"> 
                    <label for="" class="control-label">&nbsp;</label>
                    <div class="">
                        <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Сброс'), [''], ['class' => 'btn btn-default']) ?>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php ActiveForm::end(); ?>
</div>

<?= GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'columns' => [
        [
            'attribute' => 'IDCourse',
            'value' => function($item) {
                return $item->course->Name;
            }
        ],
        [
            'attribute' => 'IDTheme',
            'value' => function($item) {
                return $item->theme->Name;
            }
        ],
        [
            'attribute' => 'IDTeacher',
            'value' => function($item) {
                return $item->teacher->fullName;
            }
        ],
        [
            'attribute' => 'Date1',
            'value' => function($item) {
                return Yii::$app->formatter->asDate($item->Date1);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{create-class}{update-class}{delete-class}',
            'buttons' => [
                'create-class' => function ($url) {
                    return Html::a(
                            '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
                            $url,
                            ['class' => 'js-show-modal', 'title' => Yii::t('app', 'Создать')]
                        );
                },
                'update-class' => function ($url) {
                    return Html::a(
                            '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                            $url,
                            ['class' => 'js-show-modal', 'title' => Yii::t('app', 'Редактировать')]
                        );
                },
                'delete-class' => function ($url) {
                    return Html::a(
                            '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>',
                            $url,
                            ['class' => 'js-show-modal', 'title' => Yii::t('app', 'Удалить')]
                        );
                },
            ],
            'visibleButtons' => [
                'create-class' => true,
                'update-class' => true,
                'delete-class' => true,
            ],
        ],
    ],
]); ?>


