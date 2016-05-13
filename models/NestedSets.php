<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Description of NestedSets
 *
 * @author razikov
 */
class NestedSets extends ActiveRecord {

    public static function tableName() {
        return 'nestedsets';
    }

    /**
     * Найти все дочерние элементы текущего узла
     */
    public function getThread()
    {
        return self::find()->where([
            'and',
            ['>=','lft', $this->lft],
            ['<=','rgt', $this->rgt]
        ])->orderBy('lft')->all();
    }

}
