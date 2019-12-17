<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tests';
?>

<?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-primary js-show-modal']) ?>

<?= $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'columns' => [
        'id',
        [
            'header' => "Направление - Куратор",
            'format' => 'html',
            'value' => function($item) {
                return "<div class='verysmall_black_head'>$item->division</div>"
                        . "<div class='verysmall_gray_head'>$item->teacher</div>";
            }
        ],
        [
            'header' => "Курс",
            'format' => 'html',
            'attribute' => 'name',
            'value' => function($item) {
                return "<div class='verysmall_gray_head'>$item->name</div><i>$item->cstudent</i>";
            }
        ],
        [
            'header' => "Дата",
            'format' => 'html',
            'value' => function($item) {
                return "<div class='verysmall_black_head'>$item->wdate</div>";
            }
        ],
        [
            'header' => "<b>Время</b> - Кабинет",
            'format' => 'html',
            'value' => function($item) {
                return "<div class='verysmall_black_head'>$item->startTime - $item->endTime</div>"
                        . "<div class='verysmall_gray_head'>$item->class</div>";
            }
        ],
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

