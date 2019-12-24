<?php

namespace app\models;

class AdventOfCode
{
    public function calcucate($matrix, $x, $y)
    {
        $a7 = $matrix[$x-1][$y+1] ?? 0;
        $a8 = $matrix[$x][$y+1] ?? 0;
        $a9 = $matrix[$x+1][$y+1] ?? 0;
        $a4 = $matrix[$x-1][$y] ?? 0;
        $a6 = $matrix[$x+1][$y] ?? 0;
        $a1 = $matrix[$x-1][$y-1] ?? 0;
        $a2 = $matrix[$x][$y-1] ?? 0;
        $a3 = $matrix[$x+1][$y-1] ?? 0;
        $sum = array_sum([$a1, $a2, $a3, $a4, $a6, $a7, $a8, $a9]);
        return $sum;
    }
    
    public function next($step, $radius, $point)
    {
        $length = $radius * 2;
        if ($step == 1) {
            $newPoint = [++$point[0], $point[1]];
        } elseif ($step <= $length) {
            $newPoint = [$point[0], ++$point[1]];
        } elseif ($step <= $length * 2) {
            $newPoint = [--$point[0], $point[1]];
        } elseif ($step <= $length * 3) {
            $newPoint = [$point[0], --$point[1]];
        } elseif ($step <= $length * 4) {
            $newPoint = [++$point[0], $point[1]];
        } else {
            var_dump('Ошибка!');exit;
            return false;
        }
        if ($step == $length * 4) {
            $radius++;
            $step = 1;
        } else {
            $step++;
        }
        return [$step, $radius, $newPoint];
    }
    
    public function printMatrix($matrix, $radius)
    {
        $result = '';
        $range = range(-$radius, $radius + 1);
        foreach ($range as $x) {
            foreach ($range as $y) {
                $result .= sprintf("%-7d ", $matrix[$x][$y] ?? 0);
            }
            $result .= "<br>";
        }
        return str_replace(' ', '&nbsp;&nbsp;', $result);
    }
}