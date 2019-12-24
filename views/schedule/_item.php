<?php

?>

<div class="row">
    <div class="col-sm-1">
        <?= "Начало в" . "<br/>"; ?>
        <?= $model->startTime; ?>
    </div>
    <div class="col-sm-10">
        <?= $model->name . "<br/>"; ?>
        <?= $model->division . "<br/>"; ?>
        <?= "Куратор: "; ?>
        <?= $model->teacher; ?>
    </div>
    <div class="col-sm-1">
        <?= "Аудитория" . "<br/>"; ?>
        <?= $model->class; ?>
    </div>
</div>