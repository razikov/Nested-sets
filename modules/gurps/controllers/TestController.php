<?php

namespace app\modules\gurps\controllers;

use Yii;
use yii\web\Controller;
use app\modules\gurps\models\gcs\AdvantageList;
use app\modules\gurps\models\gcs\Advantage;
use app\modules\gurps\models\gcs\Character;
use app\modules\gurps\models\gcs\Template;

class TestController extends Controller
{
    
    public function actionIndex()
    {
//        $a = new \app\models\Advantage();
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Advantages/Basic Set.adq';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Iotha.gcs';
        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Louis d\'Antares.gcs';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Dai Blackthorn.gcs';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Races/Basic Set/Dragon.gct';
        $z = new \XMLReader();
//        $z->open($file);
        $z->XML(file_get_contents($file));
        
        $i = 0;
        while ($z->read()) {
            $obj = $z->expand();
            if ($obj->nodeType == 1) {
                $obj->nodeName;
                $obj->nodeValue;
                if ($obj->nodeName == 'advantage_list') {
                    $advantageList = new AdvantageList($obj);
                    var_dump($advantageList);exit;
                } elseif ($obj->nodeName == 'advantage') {
                    $advantage = new Advantage($obj);
//                    var_dump($advantage->result['categories']);exit;
                } elseif ($obj->nodeName == 'character') {
                    $character = new Character($obj);
//                    var_dump(json_decode(json_encode($character)));exit;
                    return $this->render('@app/modules/gurps/views/character/vue', ['model' => $character]);
                } elseif ($obj->nodeName == 'template') {
                    $template = new Template($obj);
                    var_dump($template);exit;
                }
            }
            $i++;
            
        }
        $a = \app\models\Advantage::find()->one();
        var_dump($a);exit;
        exit;
    }
    
    public function actionDice()
    {
        $d1 = mt_rand(1, 6);
        $d2 = mt_rand(1, 6);
        $d3 = mt_rand(1, 6);
        var_dump($d1, $d2, $d3, $d1+$d2+$d3);
        exit;
    }
    
    
}
