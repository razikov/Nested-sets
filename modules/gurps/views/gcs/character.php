<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($model->skill_list->skill[0]);exit;
//var_dump($model->advantage_list);exit;
//var_dump($model->spell_list);exit;
//var_dump($model->equipment_list);exit;
//var_dump($model->note_list);exit;
//var_dump($model);exit;
?>
<div class="row">
    <div class="col-sm-2"><?= yii\helpers\Html::img('data:image/jpg;base64,'.$model->profile->portrait); ?></div>
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-5">
                <h5><b>Личность</b></h5>
                <div class="row"><div class="col-sm-6">Имя</div><div class="col-sm-6"><?= $model->profile->name ?></div></div>
                <div class="row"><div class="col-sm-6">Статус</div><div class="col-sm-6"><?= $model->profile->title ?></div></div>
                <div class="row"><div class="col-sm-6">Религия</div><div class="col-sm-6"><?= '?' ?></div></div>
            </div>
            <div class="col-sm-7">
                <h5><b>Информация об игроке</b></h5>
                <div class="row"><div class="col-sm-4">Игрок</div><div class="col-sm-8"><?= $model->profile->player_name ?></div></div>
                <div class="row"><div class="col-sm-4">Компания</div><div class="col-sm-8"><?= $model->profile->campaign ?></div></div>
                <div class="row"><div class="col-sm-4">Создан</div><div class="col-sm-8"><?= $model->created_date ?></div></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5><b>Описание</b></h5>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="row"><div class="col-sm-6">Расса</div><div class="col-sm-6"><?= $model->profile->race ?></div></div>
                        <div class="row"><div class="col-sm-6">Пол</div><div class="col-sm-6"><?= $model->profile->gender ?></div></div>
                        <div class="row"><div class="col-sm-6">Возраст</div><div class="col-sm-6"><?= $model->profile->age ?></div></div>
                        <div class="row"><div class="col-sm-6">Д.Р.</div><div class="col-sm-6"><?= $model->profile->birthday ?></div></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="row"><div class="col-sm-6">Рост</div><div class="col-sm-6"><?= $model->profile->height ?></div></div>
                        <div class="row"><div class="col-sm-6">Вес</div><div class="col-sm-6"><?= $model->profile->weight ?></div></div>
                        <div class="row"><div class="col-sm-6">Размер</div><div class="col-sm-6"><?= $model->profile->SM ?></div></div>
                        <div class="row"><div class="col-sm-6">ТУ</div><div class="col-sm-6"><?= $model->profile->tech_level ?></div></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row"><div class="col-sm-4">Волосы</div><div class="col-sm-8"><?= $model->profile->hair ?></div></div>
                        <div class="row"><div class="col-sm-4">Глаза</div><div class="col-sm-8"><?= $model->profile->eyes ?></div></div>
                        <div class="row"><div class="col-sm-4">Кожа</div><div class="col-sm-8"><?= $model->profile->skin ?></div></div>
                        <div class="row"><div class="col-sm-4">Рука</div><div class="col-sm-8"><?= $model->profile->handedness ?></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="3"></div>
</div>
<br>
<div class="row">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-6">Сила:</div><div class="col-sm-6"><?= $model->ST ?></div>
            <div class="col-sm-6">Ловкость:</div><div class="col-sm-6"><?= $model->DX ?></div>
            <div class="col-sm-6">Интелект:</div><div class="col-sm-6"><?= $model->IQ ?></div>
            <div class="col-sm-6">Здоровье:</div><div class="col-sm-6"><?= $model->HT ?></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-6">HP:</div><div class="col-sm-6"><?= $model->HP ?></div>
            <div class="col-sm-6">Will:</div><div class="col-sm-6"><?= $model->Will ?></div>
            <div class="col-sm-6">Per:</div><div class="col-sm-6"><?= $model->Perception ?></div>
            <div class="col-sm-6">FP:</div><div class="col-sm-6"><?= $model->FP ?></div>
            <div class="col-sm-6">BS:</div><div class="col-sm-6"><?= $model->speed + ($model->HT + $model->DX)/4 ?></div>
            <div class="col-sm-6">Move:</div><div class="col-sm-6"><?= $model->move + floor($model->speed + ($model->HT + $model->DX)/4) ?></div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <h4>Преимущества/Недостатки</h4>
        <?= $model->advantage_list->render() ?>
    </div>
    <div class="col-sm-6">
        <h4>Умения</h4>
        <?php foreach ($model->skill_list->skill as $skill): ?>
        <?php if ($skill instanceof \app\models\gcsAdapter\Skill): ?>
        <div class="row">
            <div class="col-sm-4"><?=$skill->name['value']?></div>
            <div class="col-sm-2"><?=$skill->getEffectiveLevel()?></div>
            <div class="col-sm-2"><?=$skill->difficulty?></div>
            <div class="col-sm-2"><?=$skill->points?></div>
            <div class="col-sm-2"><?=$skill->reference?></div>
        </div>
        <?php elseif($skill instanceof \app\models\gcsAdapter\SkillContainer): ?>
        <?php var_dump($skill);exit;?>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <h4>Заклинания</h4>
        <?= $model->spell_list ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <h4>Имущество</h4>
        <?= $model->equipment_list ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <h4>Заметки</h4>
        <?= $model->note_list ?>
    </div>
</div>