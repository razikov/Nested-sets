<?php
use yii\helpers\Html;
?>
<div class="row">
    <a class="btn btn-primary" href="<?= \yii\helpers\Url::toRoute('create') ?>">
        <?=Yii::t('app', 'Добавить')?>
    </a>
</div>
<br>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $model,
    'columns' => [
        'id' => [
            'attribute' => 'id',
            'format' => 'html',
            'value' => function ($item) {
                return Html::a($item->id, ['/spells/update', 'id' => $item->id]);
            }
        ],
        'name_rus',
        'class' => [
            'attribute' => 'class',
            'value' => function($item) {
                return $item->getClassName();
            },
        ],
        'type' => [
            'attribute' => 'type',
            'value' => function($item) {
                return $item->getTypeName();
            },
        ],
        'descryption',
        'duration',
        'cost',
        'time_of_creation',
        'requirement',
    ],
]) ?>