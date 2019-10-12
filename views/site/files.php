<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $model,
    'filterModel' => null,
    'columns' => [
        'id',
        [
            'format' => 'html',
            'attribute' => 'url',
            'value' => function($item) {
                return Html::a($item->url, $item->url);
            },
        ]
    ],
]); ?>