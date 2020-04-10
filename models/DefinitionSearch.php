<?php

namespace app\models;

use app\models\Definitions;
use yii\data\ActiveDataProvider;

class DefinitionSearch extends Definitions
{
    public $termName;
    
    public function rules()
    {
        return [
            [['termName', 'definition'], 'safe'],
        ];
    }

    public function formName()
    {
        return '';
    }
    
    public function search($params)
    {
        $query = static::find()->joinWith(['term as term']);
        if ($this->load($params)) {
            $query
                ->andFilterWhere(['LIKE', 'term.name', $this->termName])
                ->andFilterWhere(['LIKE', 'definition', $this->definition])
                ;
        }

        return new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
    }
}
