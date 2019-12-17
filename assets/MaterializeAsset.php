<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@app/node_modules/materialize-css/dist';
    public $css = [
        'css/materialize.css',
    ];
    public $js = [
        'js/materialize.js',
    ];
}
