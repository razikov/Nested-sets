<?php

namespace app\modules\UserImportExport;

/**
 * Class Module
 * @package app\modules\discount
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\UserImportExport\controllers';
    
    public function init()
    {
        parent::init();
        $this->layout = 'main';
    }
}
