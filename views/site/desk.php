<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\helpers\ViewHelper as vh;

$this->title = 'Tests';

app\assets\VueAsset::register($this);
app\assets\AppAsset::register($this);
?>
<div class="site-index">
    <?xml version="1.0" encoding="UTF-8" ?>
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
    "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
    <svg
     xmlns="http://www.w3.org/2000/svg" version="1.1"
     xmlns:xlink="http://www.w3.org/1999/xlink"
     width="500" height="300">
    <g className='hexagon-group'>
        <g className='hexagon'>
            <polygon points="320,183.20508075688772 315,191.86533479473212 305,191.86533479473212 300,183.20508075688772 305,174.54482671904333 315,174.54482671904333 " fill="" style="" />
        </g>
    </g>
    <g className='hexagon-group'>
        <g className='hexagon'>
            <polygon points="170,96.60254037844386 165,105.26279441628824 155,105.26279441628824 150,96.60254037844386 155,87.94228634059948 165,87.94228634059948 " fill="" style="" />
        </g>
    </g>
    </svg>
</div>

<div style="width: 100%; height: 500px; overflow: auto;">
    <canvas id="hexagonCanvas" width="2800" height="2450" style="border: 0; display: block; margin: 0 auto; padding: 5px;">
</div>
