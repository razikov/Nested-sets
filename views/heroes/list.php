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
                return Html::a($item->id, ['/heroes/update', 'id' => $item->id]);
            }
        ],
        'character_name',
    ],
]) ?>