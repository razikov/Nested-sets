<?php

namespace app\modules\gurps\controllers;

use Yii;
use yii\web\Controller;

class SkillsController extends Controller
{
    
    public function actionList()
    {
//        $filter = new \app\models\AdvantagesForm();
//        $filter->load(Yii::$app->request->queryParams);
        
        $model = new \yii\data\ActiveDataProvider([
//            'query' => \app\models\Advantages::getQuery($filter)->orderBy(['id' => SORT_DESC]),
            'query' => \app\models\Skill::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('list', [
            'model' => $model,
//            'filter' => $filter,
        ]);
    }
    
    public function actionView($id)
    {
        $model = \app\models\Skill::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new \app\models\Skill();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $this->redirect(['skills/list']);
        }
        
//        var_dump($model);exit;
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = \app\models\Skill::find()->where(['id' => $id])->one();
        
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
        $model = \app\models\Skill::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $model->delete();
    }
    
}
