<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ArticleController extends Controller
{
    
    public function actionList()
    {
        $articles = \app\models\Articles::find()->where()->all();
        
        if (!$articles) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('list', [
            'articles' => $articles,
        ]);
    }
    
    public function actionView($id)
    {
        $model = \app\models\Articles::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new \app\models\Articles();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = \app\models\Articles::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = \app\models\Articles::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $model->delete();
    }
    
}
