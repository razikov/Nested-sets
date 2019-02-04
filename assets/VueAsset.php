<?php

namespace app\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $sourcePath = '@app/node_modules/vue/dist';
    public $js = [
        'vue.esm.js',
    ];
}
