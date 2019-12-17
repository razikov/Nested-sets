<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tests';

$action = ['index'];
?>

<?php $form = ActiveForm::begin([
    'action' => $action,
    'method' => 'get',
]); ?>
<section class="content-filters">
    <div class="css-xs-padding row">
        <div class="col-sm-4">
            <?= $form->field($searchModel, 'termName')->textInput(['class' => 'form-control input-sm']); ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($searchModel, 'definition')->textInput(['class' => 'form-control input-sm']); ?>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Найти'), ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Сброс'),
                        $action, 
                        ['class' => 'btn btn-sm btn-default']) ?>
            </div>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>

<?= GridView::widget([
    'tableOptions' => ['class' => 'table table-striped'],
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'columns' => [
        'id',
        [
            'attribute' => 'term',
            'value' => function ($item) {
//                var_dump($item);exit;
                return $item->term ? $item->term->name : 'неизвестно';
            }
        ],
        'definition',
//        [
//            'header' => 'definition',
//            'format' => 'html',
//            'value' => function ($item) {
//                $definitions = [];
//                foreach ($item->definitions as $definition) {
//                    $definitions[$definition->id] = $definition->definition;
//                }
//                return Html::ol($definitions);
//            }
//        ],
    ],
]); ?>