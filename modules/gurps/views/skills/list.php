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
                return Html::a($item->id, ['/skills/update', 'id' => $item->id]);
            }
        ],
        'name_rus',
        'meta_type' => [
            'attribute' => 'meta_type',
            'value' => function($item) {
                return $item->getMetaTypeName();
            },
        ],
        'type',
        'default',
        'requirement',
        'description' => [
            'attribute' => 'description',
            'format' => 'html',
        ],
        'modifier',
    ],
]) ?>