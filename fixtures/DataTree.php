<?php

namespace app\fixtures;

class DataTree
{
    
    public static function getData() : array
    {
        return [
            [
                'id' => 1,
                'userId' => 2,
                'groupId' => 6,
                'param1' => 378,
                'param2' => 345,
                'param3' => 222,
            ],
            [
                'id' => 2,
                'userId' => 3,
                'groupId' => 6,
                'param1' => 14,
                'param2' => 33,
                'param3' => 2,
            ],
            [
                'id' => 3,
                'userId' => 2,
                'groupId' => 1,
                'param1' => 66,
                'param2' => 33,
                'param3' => 89765,
            ],
            [
                'id' => 4,
                'userId' => 5,
                'groupId' => 2,
                'param1' => 14,
                'param2' => 37,
                'param3' => 75,
            ],
            [
                'id' => 5,
                'userId' => 2,
                'groupId' => 6,
                'param1' => 431,
                'param2' => 52,
                'param3' => 24,
            ],
        ];
    }
    
}
