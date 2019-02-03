<?php

namespace app\models;

use Yii;

// Механика строится на 3d6 = 3-18 очков, 3-4, всегда успех, 17-18 всегда провал, т.е. 5-16 очков
class Hero extends \yii\db\ActiveRecord
{
    public $points = 150;
    public $advantages;
    public $disAdvantages;
    public $skills;
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
    
    public $strength = 10; // (СЛ/ST); ±10 очков/уровень 10
    public $dexterity = 10; // (ЛВ/DX); ±20 очков/уровень
    public $health = 10; // (ЗД/HT); ±10 очков/уровень 
    public $intelligence = 10; // (ИН/IQ); ±20 очков/уровень
    
    public $damages; // (Вред, Dmg); по таблице
    public $baseLoad; // (БГ, BL); (СЛ×СЛ)/5
    public $hitPoints; // (ЕЖ,HP); СЛ ±2 очка/уровень; ЕЖ*5 = смерть
    public $will; // ИН ±5 очков/уровень
    public $perception; // ИН ±5 очков/уровень
    public $fatiguePoints; // Единицы усталости (ЕУ/FP); ЕЗ ±3 очка/уровень
    public $baseSpeed; // (БС, BS); (ЗД+ЛВ)/4; ±5 очков за ±0,25
    public $move; // (БД, Move); целая часть от БС; ±5 очков за ±1 ярд/с
    
    public $height; // Рост 5'5''
    public $weight; // Вес 145ф
    public $age; // Возраст 27
    public $sizeModifier; // (МР, SM)
    public $appearance; // Внешность.
    
    // Социальное происхождение
    public $techLevel;
    public $culture;
    public $language;
    // Богатство и влиятельность
    public $wealth;
    public $status; // репутация - через личные поступки, статус - через общественные правила
    // Друзья и враги

    public static function tableName()
    {
        return 'heroes';
    }
    
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Название (origin)'),
            'name_rus' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'type' => Yii::t('app', 'Типы'),
            'types' => Yii::t('app', 'Типы'),
            'cost' => Yii::t('app', 'Стоимость'),
        ];
    }
    
    public function rules()
    {
        return [
            [['name', 'name_rus', 'description', 'type', 'types', 'cost'], 'safe'],
        ];
    }
    
}
