<?php

namespace app\modules\UserImportExport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\UserImportExport\models\ImportUser;
use app\modules\UserImportExport\models\ImportUserForm;

class ImportUserController extends Controller
{
    
    public function actionList()
    {
        $dp = new \yii\data\ActiveDataProvider([
            'query' => ImportUser::find()
        ]);
        
        return $this->render('list', [
            'dataProvider' => $dp,
        ]);
    }
    
    public function actionCreate($id = null)
    {
        $availableRoles = \yii\helpers\ArrayHelper::map(
            \app\modules\UserImportExport\models\Role::find()->all(),
            'role_id',
            function($item) {
                return \yii\helpers\ArrayHelper::getValue($item, ['objectData', 'title']);
            }
        );
        
        if ($id) {
            $model = ImportUserForm::find()->where(['id' => $id])->one();
        } else {
            $model = new ImportUserForm();
        }
        $model->load(Yii::$app->getRequest()->post());
        if ($model->step == ImportUserForm::STAGE_GENERATE_FILE && $model->validate()) {
            $saveModel = new ImportUser();
            $saveModel->load($model->attributes, '');
            $saveModel->step = ImportUser::STAGE_EXPORT;
            if ($saveModel->save()) {
                $this->redirect(\yii\helpers\Url::to(['', 'id' => $saveModel->id]));
            };
        }
        
        return $this->render('create', [
            'model' => $model,
            'roles' => $availableRoles,
        ]);
    }
    
    public function actionView($id)
    {
        $model = ImportUser::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = ImportUser::find()->where(['id' => $id])->one();
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $model->delete();
        
        $this->redirect(\yii\helpers\Url::to('list'));
    }
    
}
