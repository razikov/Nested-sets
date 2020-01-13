<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Schedule;
use app\models\ScheduleSearch;
use yii\web\Response;

class ScheduleController extends Controller
{
    public $layout = 'schedule_main';

    public function actionIndex()
    {
        $searchModel = new ScheduleSearch();
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPresentation()
    {
//        $this->layout = 'schedule_blank';
        $searchModel = new ScheduleSearch();
        $searchModel->wdate = date("d.m.Y");
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        
        return $this->render('presentation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionUpload()
    {   
        return $this->render('error', [
            'name' => 'Ошибка',
            'message' => 'Не реализовано'
        ]);
    }
    
    public function actionShow()
    {
        $searchModel = new ScheduleSearch();
        $searchModel->wdate = date("d.m.Y");
        
        $query = $searchModel->searchQuery(\Yii::$app->request->queryParams);
        
        $rows = $query
            ->select(['wdate', 'startTime', 'class'])
            ->all();
        
        $busy = [];
        $m = array_keys(\app\models\Classroom::getList());
        $h = array('8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18');
        //массив занятости, обнуленный
        foreach ($m as $aud) {
            foreach ($h as $hour) {
                $busy[$aud][$hour] = 0;
            }
        }
        //формирование результата
        foreach ($rows as $row) {
            $hour = (int) substr($row['startTime'], 0, 2);
            $class = explode(" ", $row['class']); //!!!!!! Потенциальная ошибка
            foreach ($class as $aud) {
                if (isset($busy[$aud])) {
                    $busy[$aud][$hour] += 1;
                }
            }
        }
        array_unshift($h, 'Ауд');
        
        return $this->render('show', [
            'searchModel' => $searchModel,
            'busy' => $busy,
            'h' => $h,
        ]);
    }
    
    public function actionCreate()
    {   
        $model = new Schedule();

        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['model' => $model];
        } else {
            return ['form' => $this->renderPartial('_form', ['model' => $model])];
        }
    }
    
    public function actionUpdate($id)
    {
        $model = Schedule::findOne($id);
        
        if (!$model) {
            throw new NotFoundHttpException();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['model' => $model];
        } else {
            return ['form' => $this->renderPartial('_form', ['model' => $model])];
        }
    }
    
    public function actionDelete($id)
    {
        $model = Schedule::findOne($id);
        
        if (!$model) {
            throw new NotFoundHttpException;
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['success' => (int)$model->delete(), 'errors' => Html::errorSummary($model)];
    }

}
