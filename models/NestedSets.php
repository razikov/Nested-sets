<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\traits\GeneratorNestedSets;

/**
 * Description of NestedSets
 *
 * @author razikov
 */
class NestedSets extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%nestedsets}}';
    }

    /**
     * Найти все дочерние элементы текущего узла
     */
    public function getThread()
    {
        return self::find()
                        ->andWhere(['>=', 'lft', $this->lft])
                        ->andWhere(['<=', 'rgt', $this->rgt])
                        ->orderBy('lft')
                        ->all();
    }

    public static function getRoot()
    {
        $root = new NestedSets();
        $root->attributes = ['lvl' => 0, 'id' => 1, 'name' => 'root'];
        return $root;
    }

    public static function findDefault()
    {
        return self::find()->orderBy('lft')->All();
    }

    public static function findAllByThread($ids)
    {
        $list = explode(',', $ids);
        $nodes = self::find()->orderBy('lft')->andWhere(['in', 'id', $list])->All();
        if ($nodes == null) {
            return null;
        }

        $items = [NestedSets::getRoot()];
        // Получить ветку каждого искомого узла и добавить её в корень нового дерева
        foreach ($nodes as $node) {
            $thread = $node->thread;
            // Сделать ветку потомком нулевого узла
            if ($thread[0]->lvl != 1) {
                $delta = $thread[0]->lvl - 1; // Разница уровней

                foreach ($thread as $threadNode) {
                    $threadNode->lvl -= $delta; // Скорректировать уровень узла на разницу
                }
            }
            $items = array_merge($items, $thread);
        }
        return $items;
    }

}
