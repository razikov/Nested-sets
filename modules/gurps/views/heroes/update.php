<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Select;
use app\widgets\CKEditor;

$form = ActiveForm::begin([
        
]); 

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
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'character_name'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'player_name'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'height'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'weight'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'age'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'sex'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            Статус: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Репутация: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'size_modifier'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'tech_level'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <?= $form->field($model, 'appearance')->textarea(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'strength'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'dexterity'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'intelegence'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'health'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'hitPoints'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'will'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'perception'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'fatiguePoints'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseSpeed'); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseMove'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'baseLoad')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'load')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'burdenName')->input('text', ['disabled' => true]); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'directDamage')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'amplitudeDamage')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'move')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <?= $form->field($model, 'dodge')->input('text', ['disabled' => true]); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Парирование: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Блок: 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <?= $form->field($model, 'addTrait')->widget(
                                Select::class,
                                [
                                    'options' => [
                                        'class' => 'form-control ',
                                        'data-style' => 'btn-default',
                                        'data-width' => '100%',
                                        'data-live-search' => 'true',
                                        'data-size' => 10,
                                        'prompt' => Yii::t('app', 'Нет'),
                                    ],
                                    'items' =>  $model->getAvailableTraits(),
                                ]
                            ); ?>
                            <?= \yii\grid\GridView::widget([
                                'dataProvider' => $model->traitsDP,
                                'columns' => [
                                    'id' => [
                                        'attribute' => 'id',
                                        'format' => 'html',
                                        'value' => function ($item) {
                                            return Html::a($item->id, ['advantages/update', 'id' => $item->advantage->id]);
                                        }
                                    ],
                                    'category' => [
                                        'format' => 'html',
                                        'value' => function ($item) {
                                            return $item->advantage->metaTypeName;
                                        }
                                    ],
                                    'trait_name_en' => [
                                        'format' => 'html',
                                        'value' => function ($item) {
                                            return $item->advantage->name;
                                        }
                                    ],
                                    'trait_name_ru' => [
                                        'format' => 'html',
                                        'value' => function ($item) {
                                            return $item->advantage->name_rus;
                                        }
                                    ],
                                    'cost' => [
                                        'format' => 'html',
                                        'value' => function ($item) {
                                            return $item->cost;
                                        }
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        Очков: <?= $model->points ?>; Очков в характеристиках: <?= $model->attributeCost ?>; Осталось: <?= $model->points - $model->attributeCost ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br>
        </div>
    </div>
</fieldset>
    
<div class="content--footer--toolbar">
    <?= Html::submitButton(
        Yii::t('app', 'Сохранить'),
        ['class' => 'btn btn-green']
    ) ?>
    <a class="btn btn-outline btn-outline--green" href="<?= \yii\helpers\Url::toRoute('list') ?>">
        <?=Yii::t('app', 'Отмена')?>
    </a>
</div>
<?php ActiveForm::end(); ?>