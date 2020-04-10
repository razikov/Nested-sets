<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\DefinitionSearch;

class DictionaryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new DefinitionSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
