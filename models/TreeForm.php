<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;

/**
 * Description of TreeForm
 *
 * @author razikov
 */
class TreeForm extends Model
{

    public $number;

    public function rules()
    {
        return [
            ['number', 'integer', 'min' => 1, 'max' => 30000,
                'message' => 'Значением поля должно быть целое число',
                'tooSmall' => 'Поле должно иметь значение большее, либо равное 1',
                'tooBig' => 'Поле должно иметь значение меньшее, либо равное 30000'],
            ['number', 'required', 'message' => 'Поле не может быть пустым'],
        ];
    }

}
