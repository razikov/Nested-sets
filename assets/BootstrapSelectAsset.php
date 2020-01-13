<?php

namespace app\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

class BootstrapSelectAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-select/dist';
    public $js = [
        'js/bootstrap-select.js',
    ];
    public $depends = [
        BootstrapPluginAsset::class,
    ];

    public function init()
    {
        parent::init();

        $this->js[] = \Yii::$app->language == 'ru' ? 'js/i18n/defaults-ru_RU.js' : 'js/i18n/defaults-en_US.js';
    }
}
