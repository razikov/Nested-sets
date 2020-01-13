<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\JqueryDatePickerAsset;

$this->title = 'Tests';
$this->registerJs('
    bindModal(".js-show-modal", {
        beforeShow: function (_modal) {
            datepicker(_modal);
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


<?= $this->render('_search', ['model' => $searchModel]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-primary js-show-modal']) ?>
        <?= Html::a(Yii::t('app', 'Импорт'), ['import'], ['class' => 'btn btn-primary js-show-modal']) ?>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'tableOptions' => ['class' => 'table table-striped'],
            'dataProvider' => $dataProvider,
            'filterModel' => null,
            'columns' => [
                'id',
                'division',
                'teacher',
                [
                    'header' => "Курс",
                    'format' => 'html',
                    'attribute' => 'name',
                    'value' => function($item) {
                        return "<div class='verysmall_gray_head'>$item->name</div><i>$item->cstudent</i>";
                    }
                ],
                'wdate',
                [
                    'header' => "<b>Время</b>",
                    'format' => 'html',
                    'value' => function($item) {
                        return "<div class='verysmall_black_head'>$item->startTime - $item->endTime</div>";
                    }
                ],
                'class',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url) {
                            return Html::a(
                                    '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
                                    $url,
                                    ['class' => 'js-show-modal', 'title' => Yii::t('app', 'Редактировать')]
                                );
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>


