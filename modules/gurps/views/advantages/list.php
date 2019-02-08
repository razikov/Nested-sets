<?php
use yii\helpers\Html;
?>
<div class="row">
    <?php $form = yii\widgets\ActiveForm::begin([
        'method' => 'get',
    ]); ?>
    <?= $form->field($filter, 'name'); ?>
    <?= $form->field($filter, 'description'); ?>
    <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Сбросить'), \yii\helpers\Url::toRoute(['']), ['class' => 'btn btn-default']) ?>
    <?php yii\widgets\ActiveForm::end(); ?>
</div>
<br>
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
                return Html::a($item->id, ['/gurps/advantages/update', 'id' => $item->id]);
            }
        ],
        'name_rus',
        'description_rus' => [
            'attribute' => 'description_rus',
            'format' => 'html',
        ],
        'type' => [
            'attribute' => 'type',
            'value' => function ($item) {
                $availableTypes = $item->getAvailableTypes();
                $values = array_map(function($item) use ($availableTypes) {
                    if (isset($availableTypes[$item])) {
                        return $availableTypes[$item];
                    };
                    return null;
                }, explode(',', $item->type));
                return implode(',', $values);
            }
        ],
        'cost',
        'categories' => [
            'attribute' => 'categories',
            'format' => 'html',
            'value' => function ($item) {
                return $item->categoriesName;
            }
        ],
    ],
]) ?>