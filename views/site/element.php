<?php

use yii\web\View;

$this->title = 'Element';

app\assets\ElementAsset::register($this);
$this->registerJs("NS.App();", View::POS_END);
?>

<div id="app"></div>
