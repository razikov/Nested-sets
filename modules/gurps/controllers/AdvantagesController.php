<?php

namespace app\modules\gurps\controllers;

use Yii;
use yii\web\Controller;
use app\modules\gurps\models\AdvantagesForm;
use app\modules\gurps\models\Advantage;

class AdvantagesController extends Controller
{
    
    public function actionList()
    {
        $filter = new AdvantagesForm();
        $filter->load(Yii::$app->request->queryParams);
        
        $model = new \yii\data\ActiveDataProvider([
            'query' => Advantage::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('list', [
            'model' => $model,
            'filter' => $filter,
        ]);
    }
    
    public function actionView($id)
    {
        $model = Advantage::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Advantage();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $this->redirect(['advantages/list']);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = Advantage::find()->where(['id' => $id])->one();
        
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
        $model = Advantage::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $model->delete();
    }
    
}
