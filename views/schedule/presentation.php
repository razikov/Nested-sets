<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Tests';
?>

<?= $this->render('_search', ['model' => $searchModel]); ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
]); ?>

