<?php

?>

<div class="card col-sm-4">
  <!--<img src="..." class="card-img-top" alt="...">-->
  <div class="card-body">
    <h5 class="card-title"><strong>Аудитория</strong>: <?= $model->class; ?> <strong>Начало в</strong>: <?= $model->startTime; ?></h5>
    <p class="card-text"><strong>Название:</strong> <?= $model->name; ?> </p>
    <p class="card-text">Направление: <?= $model->division; ?> Куратор: <?= $model->teacher; ?></p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>