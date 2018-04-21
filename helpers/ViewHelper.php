<?php

namespace app\helpers;

/**
 * Description of ViewHelper
 *
 * @author razikov
 */
class ViewHelper
{

    public static function renderNestedSetTree($items)
    {
        $tree = '<div id="jstree"><ul>';
        for ($i = 0; $i < count($items); $i++) {
            // Вывести элемент
            $tree .= '<li data-jstree=\'{"opened":true}\'>' . $items[$i]->name;
            // Уровень текущего элемента
            $current = $items[$i]->lvl;
            // Уровень следующего элемента
            $next = isset($items[$i + 1]) ? $items[$i + 1]->lvl : 0;
            // Если следующий элемент является потомком, открыть список
            if ($next > $current) {
                $tree .= '<ul>';
            }
            // Если следующий элемент является предком
            if ($next < $current) {
                for ($j = 1; $j <= ($current - $next); $j++) {
                    // Закрываем необходимое количество элементов и списков
                    $tree .= '</li></ul>';
                }
            }
            // Если следующий элемент на том же уровне, закрываем текущий элемент
            if ($next == $current) {
                $tree .= '</li>';
            }
        }
        return $tree;
    }

}