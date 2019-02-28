<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ElementAsset extends AssetBundle
{
    public $sourcePath = '@app/node_modules/element-ui/lib';
    public $css = [
        'theme-chalk/index.css',
    ];
}
