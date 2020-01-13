<?php

?>

<div class="list-group-item">
    <div class="">
        <h4><strong><?= $model->name; ?></strong></h4>
        Время: <strong><?= $model->startTime ?><?= $model->endTime ? (" - " . $model->endTime) : ""; ?></strong><br/>
        Аудитория: <strong><?= $model->class ?></strong><br/>
        Куратор: <strong><?= $model->teacher; ?></strong><br/>
        Подразделение: <?= $model->division ?><br/>
    </div>
</div>