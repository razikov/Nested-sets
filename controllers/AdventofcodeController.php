<?php

namespace app\controllers;

use app\models\AdventOfCode;
use yii\web\Controller;

class AdventofcodeController extends Controller
{
    
    public function actionQ2($n = 289326)
    {
        $helper = new AdventOfCode();
    }
    
    public function actionQ2d($n = 289326)
    {
        $helper = new AdventOfCode();
        $seqNumber = 1;
        $point = [0, 0];
        $matrix = [$point[0] => [$point[1] => $seqNumber]];
        $step = 1;
        $radius = 1;
        $sequence = [$seqNumber];
        
        while ($seqNumber < $n) {
            $result = $helper->next($step, $radius, $point);
            $step = $result[0];
            $radius = $result[1];
            $point = $result[2];
            $seqNumber = $helper->calcucate($matrix, $point[0], $point[1]);
            $matrix[$point[0]][$point[1]] = $seqNumber;
            $sequence[] = $seqNumber;
        }
        print($helper->printMatrix($matrix, $radius));
    }
    
    public function actionQ3($n = 289326)
    {
        $helper = new AdventOfCode();
    }
}
