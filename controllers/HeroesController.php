<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HeroesController extends Controller
{
    
    public function actionList()
    {
        $model = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Character::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('list', [
            'model' => $model,
        ]);
    }
    
    public function actionView($id)
    {
        $model = \app\models\Character::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new \app\models\Character();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $this->redirect(['heroes/list']);
        }
        
//        var_dump($model);exit;
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = \app\models\Character::find()->where(['id' => $id])->one();
        
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
        $model = \app\models\Character::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $model->delete();
    }
    
}
