<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BlogController extends Controller
{

    public function actionIndex()
    {
        $articles = \app\models\Articles::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();
        
        return $this->render('index', [
            'articles' => $articles,
        ]);
    }

}
