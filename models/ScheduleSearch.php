<?php
namespace app\models;

use app\models\Schedule;
use yii\data\ActiveDataProvider;

class ScheduleSearch extends Schedule
{
    
    public function rules()
    {
        return [
            [['id', 'name', 'division', 'teacher', 'cstudent', 'wdate', 'startTime', 'endTime', 'class'], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = $this->searchQuery($params);
        
        return new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'wdate' => SORT_ASC,
                        'startTime' => SORT_ASC,
                    ]
                ],
            ]
        );
    }
    
    public function searchQuery($params)
    {
        $this->load($params);
        
        $tableName = static::tableName();
        $query = static::find()
            ->select([
                $tableName.'.*',
            ])
            ->andFilterWhere([
                $tableName.'.id' => $this->id,
                $tableName.'.name' => $this->name,
                $tableName.'.division' => $this->division,
                $tableName.'.teacher' => $this->teacher,
                $tableName.'.cstudent' => $this->cstudent,
                $tableName.'.wdate' => $this->wdate,
//                $tableName.'.startTime' => $this->startTime,
//                $tableName.'.endTime' => $this->endTime,
                $tableName.'.class' => $this->class,
            ]);
        
        return $query;
    }

}