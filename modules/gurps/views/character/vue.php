<?php
use yii\helpers\Json;

$this->registerJs('NS.character("#character", '.Json::encode($model).')');
?>

<div id="character"></div>