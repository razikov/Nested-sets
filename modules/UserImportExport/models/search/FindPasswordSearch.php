<?php

namespace app\modules\UserImportExport\models\search;

use app\modules\UserImportExport\models\FindPassword;
use yii\data\ActiveDataProvider;

class FindPasswordSearch extends FindPassword
{
    public function rules()
    {
        return [
            [['login'], 'safe'],
        ];
    }
    public function search($filter)
    {
        $this->load($filter);
        
        $query = FindPasswordSearch::find();
        $query->andFilterWhere(['like', 'login', $this->login]);
        $query->andFilterWhere(['like', 'password', $this->password]);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [],
        ]);
    }
}
