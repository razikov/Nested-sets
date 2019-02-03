<?php

namespace app\models;

use Yii;

class Categories
{
    private $_category = []; // array string
    
    public function setCategory(string $value) : Categories
    {
        $this->_category = explode(',', $value);
        return $this;
    }
    
    public function getCategory() : array
    {
        return $this->_category;
    }
    
    public function getCategoryAsString() : string
    {
        return implode(',', $this->_category);
    }
    
}
