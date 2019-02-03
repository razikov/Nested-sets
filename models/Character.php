<?php

namespace app\models;

use Yii;

// Механика строится на 3d6 = 3-18 очков, 3-4, всегда успех, 17-18 всегда провал, т.е. 5-16 очков
class Character extends \yii\db\ActiveRecord
{
//    public $id;

    // биография, внешность, поведение, привычки и умения. Как он приобрел данные качества
    // Где он родился и где вырос? Где живет сейчас?
    // Кем были его родители? Знает ли он об этом? Живы ли они сейчас? в каких они отношениях с персонажем?
    // Какую школу он прошел? Учился у кого-то? Был студентом? Учился сам?
    // Чем он занимается сейчас? Какой еще работой занимался?
    // К какому общественному классу он принадлежит? Насколько он богат?
    // Кто его друзья? Его враги? Его ближайшие коллеги?
    // Каковы были важнейшие моменты в его жизни?
    // Что он любит и что не любит? Каковы его хобби и интересы? Моральные воззрения и верования?
    // Каковые его мотивы? Планы на будущее?
    // Эти знания могут быть доступны остальным, либо у вас могут быть кое-какие секреты даже от друзей
    public $skill_list;
//    public $trait_list;
    public $advantage_list;
    public $spell_list;
    public $equipment_list;
    public $note_list;
    public $profile; //ref
    public $print_settings = null; //ref
    public $created_date; //string
    public $modified_date; //string
    public $total_points = 150; //short
    public $include_punch; //boolean
    public $include_kick; //boolean
    public $include_kick_with_boots; //boolean
    
    const NAME_ATTRIBUTE_HIT_POINT = '_hp';
    const NAME_ATTRIBUTE_FATIGUE_POINTS = '_fp';
    const NAME_ATTRIBUTE_STRENGTH = '_st';
    const NAME_ATTRIBUTE_DEXTERITY = '_dx';
    const NAME_ATTRIBUTE_INTELEGENCE = '_iq';
    const NAME_ATTRIBUTE_HEALTH = '_ht';
    const NAME_ATTRIBUTE_WILL = '_will';
    const NAME_ATTRIBUTE_PERCEPTION = '_perception';
    const NAME_ATTRIBUTE_BASE_SPEED = '_speed';
    const NAME_ATTRIBUTE_MOVE = '_move';
    
    const BASE_STRENGTH = 10;
    const BASE_DEXTERITY = 10;
    const BASE_INTELEGENCE = 10;
    const BASE_HEALTH = 10;
    const BASE_SPEED_POINT_PER_LEVEL = 0.25;
    
    const COST_STRENGTH = 10;
    const COST_DEXTERITY = 20;
    const COST_INTELEGENCE = 20;
    const COST_HEALTH = 10;
    const COST_HIT_POINT = 2;
    const COST_WILL = 5;
    const COST_PERCEPTION = 5;
    const COST_FATIGUE_POINTS = 3;
    const COST_BASE_SPEED = 5;
    const COST_MOVE = 5;
    
    // Социальное происхождение
    public $culture;
    public $language;
    // Богатство и влиятельность
    public $wealth;
    public $status; // репутация - через личные поступки, статус - через общественные правила
    // Друзья и враги

    public static function tableName()
    {
        return 'characters';
    }
    
    public function attributeLabels()
    {
        return [
            'character_name' => Yii::t('app', 'Имя персонажа'),
            'player_name' => Yii::t('app', 'Имя игрока'),
            'size_modifier' => Yii::t('app', 'Мод. размера'),
            'tech_level' => Yii::t('app', 'Тех. уровень'),
            'height' => Yii::t('app', 'Рост'),
            'weight' => Yii::t('app', 'Вес'),
            'age' => Yii::t('app', 'Возраст'),
            'sex' => Yii::t('app', 'Пол'),
            'appearance' => Yii::t('app', 'Внешность'),
            'strength' => Yii::t('app', 'Сила'),
            'dexterity' => Yii::t('app', 'Ловкость'),
            'intelegence' => Yii::t('app', 'Интелект'),
            'health' => Yii::t('app', 'Здоровье'),
            'hitPoints' => Yii::t('app', 'Единицы жизни'),
            'will' => Yii::t('app', 'Воля'),
            'perception' => Yii::t('app', 'Восприятие'),
            'fatiguePoints' => Yii::t('app', 'Удиницы усталости'),
            'baseLoad' => Yii::t('app', 'Базовый груз'),
            'burdenName' => Yii::t('app', 'Нагрузка'),
            'baseSpeed' => Yii::t('app', 'Базовая скор'),
            'baseMove' => Yii::t('app', 'Базовая движ'),
            'move' => Yii::t('app', 'Движение'),
            'dodge' => Yii::t('app', 'Уклонение'),
        ];
    }
    
    public function rules()
    {
        return [
            [['character_name', 'player_name', 'size_modifier', 'tech_level', 'height', 
                'weight', 'age', 'sex', 'appearance', 'strength', 'dexterity',
                'intelegence', 'health', 'hitPoints', 'will', 'perception',
                'fatiguePoints', 'baseSpeed', 'baseMove', 'addTrait'], 'safe'],
        ];
    }
    
    /**
     * Сила (СЛ/ST)
     * 
     * @return integer
     */
    public function getStrength()
    {
        $name = self::NAME_ATTRIBUTE_STRENGTH;
        return $this->$name;
    }
    
    public function setStrength($value)
    {
        $name = self::NAME_ATTRIBUTE_STRENGTH;
        $this->$name = $value;
        
        return $this;
    }
    
    public function getCostStrength()
    {
        $name = self::NAME_ATTRIBUTE_STRENGTH;
        return ($this->$name - self::BASE_STRENGTH) * self::COST_STRENGTH;
    }
    
    /**
     * Ловкость (ЛВ/DX);
     * 
     * @return integer
     */
    public function getDexterity()
    {
        $name = self::NAME_ATTRIBUTE_DEXTERITY;
        return $this->$name;
    }
    
    public function setDexterity($value)
    {
        $name = self::NAME_ATTRIBUTE_DEXTERITY;
        $this->$name = $value;
    
        return $this;
    }
    
    public function getCostDexterity()
    {
        $name = self::NAME_ATTRIBUTE_DEXTERITY;
        return ($this->$name - self::BASE_DEXTERITY) * self::COST_DEXTERITY;
    }
    
    /**
     * Интелект (ИН/IQ);
     * 
     * @return integer
     */
    public function getIntelegence()
    {
        $name = self::NAME_ATTRIBUTE_INTELEGENCE;
        return $this->$name;
    }
    
    public function setIntelegence($value)
    {
        $name = self::NAME_ATTRIBUTE_INTELEGENCE;
        $this->$name = $value;
    
        return $this;
    }
    
    public function getCostIntelegence()
    {
        $name = self::NAME_ATTRIBUTE_INTELEGENCE;
        return ($this->$name - self::BASE_INTELEGENCE) * self::COST_INTELEGENCE;
    }
    
    /**
     * Здоровье (ЗД/HT);
     * 
     * @return integer
     */
    public function getHealth()
    {
        $name = self::NAME_ATTRIBUTE_HEALTH;
        return $this->$name;
    }
    
    public function setHealth($value)
    {
        $name = self::NAME_ATTRIBUTE_HEALTH;
        $this->$name = $value;
    
        return $this;
    }
    
    public function getCostHealth()
    {
        $name = self::NAME_ATTRIBUTE_HEALTH;
        return ($this->$name - self::BASE_HEALTH) * self::COST_HEALTH;
    }
    
    /**
     * Единицы жизни (ЕЖ,HP);
     * ЕЖ*5 = смерть
     * 
     * @return integer
     */
    public function getHitPoints()
    {
        $name = self::NAME_ATTRIBUTE_HIT_POINT;
        return $this->$name + $this->strength;
    }
    
    public function setHitPoints($value)
    {
        $name = self::NAME_ATTRIBUTE_HIT_POINT;
        $this->$name = $value - $this->strength;
        
        return $this;
    }
    
    public function getCostHitPoints()
    {
        $name = self::NAME_ATTRIBUTE_HIT_POINT;
        return $this->$name * self::COST_HIT_POINT;
    }
    
    /**
     * Воля;
     * 
     * @return integer
     */
    public function getWill()
    {
        $name = self::NAME_ATTRIBUTE_WILL;
        return $this->$name + $this->intelegence;
    }
    
    public function setWill($value)
    {
        $name = self::NAME_ATTRIBUTE_WILL;
        $this->$name = $value - $this->intelegence;
        
        return $this;
    }
    
    public function getCostWill()
    {
        $name = self::NAME_ATTRIBUTE_WILL;
        return $this->$name * self::COST_WILL;
    }
    
    /**
     * Восприятие;
     * 
     * @return integer
     */
    public function getPerception()
    {
        $name = self::NAME_ATTRIBUTE_PERCEPTION;
        return $this->$name + $this->intelegence;
    }
    
    public function setPerception($value)
    {
        $name = self::NAME_ATTRIBUTE_PERCEPTION;
        $this->$name = $value - $this->intelegence;
        
        return $this;
    }
    
    public function getCostPerception()
    {
        $name = self::NAME_ATTRIBUTE_PERCEPTION;
        return $this->$name * self::COST_PERCEPTION;
    }
    
    /**
     * Единицы усталости (ЕУ/FP);
     * 
     * @return integer
     */
    public function getFatiguePoints()
    {
        $name = self::NAME_ATTRIBUTE_FATIGUE_POINTS;
        return $this->$name + $this->hitPoints;
    }
    
    public function setFatiguePoints($value)
    {
        $name = self::NAME_ATTRIBUTE_FATIGUE_POINTS;
        $this->$name = $value - $this->hitPoints;
        
        return $this;
    }
    
    public function getCostFatiguePoints()
    {
        $name = self::NAME_ATTRIBUTE_FATIGUE_POINTS;
        return $this->$name * self::COST_FATIGUE_POINTS;
    }
    
    /**
     * Базовый груз (БГ, BL);
     * (СЛ×СЛ)/5
     * 
     * @return float
     */
    public function getBaseLoad()
    {
        return floor($this->strength * $this->strength / 5);
    }
    
    /**
     * Базовая скорость (БС, BS);
     * (ЗД+ЛВ)/4;
     * 
     * @return float
     */
    public function getBaseSpeed()
    {
        $name = self::NAME_ATTRIBUTE_BASE_SPEED;
        return ($this->health + $this->dexterity) / 4 + $this->$name * self::BASE_SPEED_POINT_PER_LEVEL;
    }
    
    public function setBaseSpeed($value)
    {
        $name = self::NAME_ATTRIBUTE_BASE_SPEED;
        $this->$name = floor( ($value - ($this->health + $this->dexterity) / 4) / self::BASE_SPEED_POINT_PER_LEVEL);
        
        return $this;
    }
    
    public function getCostBaseSpeed()
    {
        $name = self::NAME_ATTRIBUTE_BASE_SPEED;
        return $this->$name * self::COST_BASE_SPEED;
    }
    
    /**
     * Базовое движение (БД, Move); 
     * целая часть от БС;
     * 
     * @return integer
     */
    public function getBaseMove()
    {
        $name = self::NAME_ATTRIBUTE_MOVE;
        return floor($this->baseSpeed) + $this->$name;
    }
    
    public function setBaseMove($value)
    {
        $name = self::NAME_ATTRIBUTE_MOVE;
        $this->$name = $value - floor($this->baseSpeed);
        
        return $this;
    }
    
    public function getCostBaseMove()
    {
        $name = self::NAME_ATTRIBUTE_MOVE;
        return $this->$name * self::COST_MOVE;
    }
    
    public function getAttributeCost()
    {
        $array = [
            $this->costStrength,
            $this->costDexterity,
            $this->costIntelegence,
            $this->costHealth,
            $this->costHitPoints,
            $this->costWill,
            $this->costPerception,
            $this->costFatiguePoints,
            $this->costBaseSpeed,
            $this->costBaseMove,
        ];
        return array_sum($array);
    }
    
    public function getMove()
    {
        $arr = [
            0 => 1,
            1 => 0.8,
            2 => 0.6,
            3 => 0.4,
            4 => 0.2,
        ];
        return floor($this->baseMove * $arr[$this->burden]);
    }
    
    public function getDodge()
    {
        $arr = [
            0 => 0,
            1 => -1,
            2 => -2,
            3 => -3,
            4 => -4,
        ];
        return $this->move + 3 + $arr[$this->burden];
    }
    
    public function getBurden()
    {
        if ($this->load <= $this->baseLoad) {
            return 0;
        } elseif ($this->load <= $this->baseLoad * 2) {
            return 1;
        } elseif ($this->load <= $this->baseLoad * 3) {
            return 2;
        } elseif ($this->load <= $this->baseLoad * 6) {
            return 3;
        } elseif ($this->load <= $this->baseLoad * 10) {
            return 4;
        }
    }
    
    public function getLoad()
    {
        return 0;
    }

    public function getBurdenName()
    {
        $loadList = [
            0 => 'Нет',
            1 => 'Легкая',
            2 => 'Средняя',
            3 => 'Тяжелая',
            4 => 'Оч. тяж.',
        ];
        return $loadList[$this->burden];
    }
    
    // (Вред, Dmg); по таблице
    public function getDirectDamage()
    {
        $dmg = [
            1 => '1к-6',
            2 => '1к-6',
            3 => '1к-5',
            4 => '1к-5',
            5 => '1к-4',
            6 => '1к-4',
            7 => '1к-3',
            8 => '1к-3',
            9 => '1к-2',
            10 => '1к-2',
            11 => '1к-1',
            12 => '1к-1',
            13 => '1к',
            14 => '1к',
            15 => '1к+1',
            16 => '1к+1',
            19 => '1к+2',
            20 => '1к+2',
            17 => '2к-1',
            18 => '2к-1',
            21 => '2к',
            22 => '2к',
            23 => '2к+1',
            24 => '2к+1',
            25 => '2к+2',
            26 => '2к+2',
            27 => '3к-1',
            28 => '3к-1',
            29 => '3к',
            30 => '3к',
            31 => '3к+1',
            32 => '3к+1',
            33 => '3к+2',
            34 => '3к+2',
            35 => '4к-1',
            36 => '4к-1',
            37 => '4к',
            38 => '4к',
            39 => '4к+1',
            40 => '4к+1',
            45 => '5к',
            50 => '5к+2',
            55 => '6к',
            60 => '7к-1',
            65 => '7к+1',
            70 => '8к',
            75 => '8к+2',
            80 => '9к',
            85 => '9к+2',
            90 => '10к',
            95 => '10к+2',
            100 => '11к',
        ];
        return \yii\helpers\ArrayHelper::getValue($dmg, $this->strength, '?');
    }
    
    // (Вред, Dmg); по таблице
    public function getAmplitudeDamage()
    {
        $dmg = [
            1 => '1к-5',
            2 => '1к-5',
            3 => '1к-4',
            4 => '1к-4',
            5 => '1к-3',
            6 => '1к-3',
            7 => '1к-2',
            8 => '1к-2',
            9 => '1к-1',
            10 => '1к',
            11 => '1к+1',
            12 => '1к+2',
            13 => '2к-1',
            14 => '2к',
            15 => '2к+1',
            16 => '2к+2',
            19 => '3к-1',
            20 => '3к',
            17 => '3к+1',
            18 => '3к+2',
            21 => '4к-1',
            22 => '4к',
            23 => '4к+1',
            24 => '4к+2',
            25 => '5к-1',
            26 => '5к',
            27 => '5к+1',
            28 => '5к+1',
            29 => '5к+2',
            30 => '5к+2',
            31 => '6к-1',
            32 => '6к-1',
            33 => '6к',
            34 => '6к',
            35 => '6к+1',
            36 => '6к+1',
            37 => '6к+2',
            38 => '6к+2',
            39 => '7к-1',
            40 => '7к-1',
            45 => '7к+1',
            50 => '8к-1',
            55 => '8к+1',
            60 => '9к',
            65 => '9к+2',
            70 => '10к',
            75 => '10к+2',
            80 => '11к',
            85 => '11к+2',
            90 => '12к',
            95 => '12к+2',
            100 => '13к',
        ];
        return \yii\helpers\ArrayHelper::getValue($dmg, $this->strength, '?');
    }
    
//    public function getAvailableTraits()
//    {
//        return \yii\helpers\ArrayHelper::map(\app\models\Advantages::find()->orderBy(['id' => SORT_DESC])->all(), 'id', function($item) {
//            return $item->name_rus . ' [' . $item->getMetaTypeName($item->type) . ']';
//        });
//    }
//    
//    public function getAddTrait()
//    {
//        return null;
//    }
//    
//    public function setAddTrait($value)
//    {
//        $advantage = \app\models\Advantages::find()->where(['id' => $value])->one();
//        if ($advantage) {
//            $ref_trait = ReferenceTraits::find()->where([
//                'advantage_id' => $advantage->id,
//                'character_id' => $this->id,
//            ])->one();
//            if (!$ref_trait) {
//                $ref_trait = new ReferenceTraits();
//                $ref_trait->advantage_id = $advantage->id;
//                $ref_trait->character_id = $this->id;
//                $ref_trait->save();
//            }
//        }
//        return $this;
//    }
//    
//    public function getRefTraits()
//    {
//        return $this->hasMany(ReferenceTraits::className(), ['character_id' => 'id']);
//    }
//    
//    public function getTraits()
//    {
//        return $this->hasMany(Advantages::className(), ['id' => 'advantage_id'])
//            ->via('refTraits');
//    }
//    
//    public function getTraitsDP()
//    {
//        return new \yii\data\ActiveDataProvider([
//            'query' => ReferenceTraits::find()->where([
//                'character_id' => $this->id,
//            ]),
//            'pagination' => [
//                'pageSize' => 0,
//            ],
//        ]);
//    }
}
