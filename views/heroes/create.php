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
                            <?= $form->field($model, 'size_modifier'); ?>
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
                            <?= $form->field($model, 'appearance')->textarea(); ?>
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Статус: 
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            Репутация: 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6">
                            СЛ: <?= $model->strength ?> (<?= $model->costStrength ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            ЛВ: <?= $model->dexterity ?> (<?= $model->costDexterity ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            ИН: <?= $model->intelegence ?> (<?= $model->costIntelegence ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            ЗД: <?= $model->health ?> (<?= $model->costHealth ?>)
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6">
                            ЕЖ: <?= $model->hitPoints ?> (<?= $model->costHitPoints ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Воля: <?= $model->will ?> (<?= $model->costWill ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Восп: <?= $model->perception ?> (<?= $model->costPerception ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            ЕУ: <?= $model->fatiguePoints ?> (<?= $model->costFatiguePoints ?>)
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6">
                            Базовый груз: <?= $model->baseLoad ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Текущий груз: <?= $model->load ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Нагрузка: <?= $model->burdenName ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Вред: Прм <?= $model->directDamage ?> / Амп <?= $model->amplitudeDamage ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Базовая скор: <?= $model->baseSpeed ?> (<?= $model->costBaseSpeed ?>)
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Базовая движ: <?= $model->baseMove ?> (<?= $model->costBaseMove ?>)
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6">
                            Движение: <?= $model->move ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Уклонение: <?= $model->dodge ?>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Парирование: 
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            Блок: 
                        </div>
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
        Yii::t('app', 'Добавить'),
        ['class' => 'btn btn-green']
    ) ?>
    <a class="btn btn-outline btn-outline--green" href="<?= \yii\helpers\Url::toRoute('list') ?>">
        <?=Yii::t('app', 'Отмена')?>
    </a>
</div>
<?php ActiveForm::end(); ?>