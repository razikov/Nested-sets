<?php

namespace app\modules\UserImportExport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\UserImportExport\models\User;
use app\modules\UserImportExport\models\ImportUserForm;
use app\modules\UserImportExport\models\ImportUser;

class UserController extends Controller
{

    public function actionList()
    {
        $dp = new \yii\data\ActiveDataProvider([
            'query' => User::find()
        ]);
        
        return $this->render('list', [
            'dataProvider' => $dp,
        ]);
    }
    
    public function actionView($id)
    {
//        $model = \app\models\Articles::find()->where(['id' => $id])->one();
//        
//        if (!$model) {
//            throw new \yii\web\NotFoundHttpException("Статья не найдена");
//        }
//        
//        return $this->render('view', [
//            'model' => $model,
//        ]);
    }

    public function actionCreate()
    {
//        $model = new \app\models\Articles();
//        
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $model->save();
//        }
//        
//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }
    
    public function actionUpdate($id)
    {
//        $model = \app\models\Articles::find()->where(['id' => $id])->one();
//        
//        if (!$model) {
//            throw new \yii\web\NotFoundHttpException();
//        }
//        
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $model->save();
//        }
//        
//        return $this->render('update', [
//            'model' => $model,
//        ]);
    }

    public function actionDelete($id)
    {
//        $model = \app\models\Articles::find()->where(['id' => $id])->one();
//        
//        if (!$model) {
//            throw new \yii\web\NotFoundHttpException();
//        }
//        
//        $model->delete();
    }
    
}
