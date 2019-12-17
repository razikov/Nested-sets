<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TreeForm;
use app\models\NestedSets;
use app\helpers\NestedSetsHelper;
use app\helpers\Tree;

class SiteController extends Controller
{
    
    public function beforeAction($action)
    {
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionIndex()
    {
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $data = NestedSetsHelper::generate($form->number);
            NestedSets::deleteAll();
            Yii::$app->db->createCommand()->batchInsert('nestedsets', ['id', 'name', 'lft', 'rgt', 'lvl'], $data)->execute();
            $this->redirect('');
        }

        $tree = NestedSets::findDefault();

        return $this->render('index', ['model' => $form, 'items' => $tree]);
    }
    
    public function actionTree()
    {
        $tree = new Tree();
        $data = \app\fixtures\DataTree::getData();
//        $treeData = $tree->createTree(['userId', 'groupId', 'id'], $data);
        $treeData = $tree->createTree(['groupId', 'userId', 'id'], $data);
//        $avgData = $tree->getTreeAvg('param1', $treeData);
//        $countData = $tree->getTreeCount('param1', $treeData);
        $availablePaths = $tree->getMaterializedPathsTree($treeData);
        $getKey = $tree->getBranchPath($availablePaths[1]);
        var_dump(\yii\helpers\ArrayHelper::getValue($treeData, $getKey), $availablePaths, $treeData['rows'][6]['rows'][2]);
    }
    
//    public function actionError()
//    {
//        return $this->redirect('/');
//    }
    
    public function actionNestedSets()
    {
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            NestedSets::generateData($form->number);
        }

        $tree = NestedSets::findDefault();

        return $this->render('index', ['model' => $form, 'items' => $tree]);
    }

    public function actionThread($ids)
    {
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            NestedSets::generateData($form->number);
        }

        $items = NestedSets::findAllByThread($ids);

        return $this->render('index', ['model' => $form, 'items' => $items]);
    }
    
    public function actionUpload()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \app\models\Upload();
        
        if (Yii::$app->request->isPost) {
            $file = \yii\web\UploadedFile::getInstanceByName('file');
            $mimeType = $file->type;// || FileHelper::getMimeType($this->file->tempName);
            $extension = pathinfo($file->name, PATHINFO_EXTENSION);// || 'undefined';
            $newFileName = sha1_file($file->tempName).'.'. $extension;

            $fileStorage = Yii::$app->get('storageContainer')->getFileStorageByUploadType(\app\models\Upload::TYPE_LOCAL);
            $model->filename = $fileStorage->upload(
                $file->tempName,
                $newFileName,
                $mimeType
            );
            @unlink($file->tempName);
            
            if ($model->save()) {
                return ['uploaded' => true, 'url' => $fileStorage->getUrl($model), 'model' => $model];
            }

            // TODO: в ошибки передать массив сообщений
            return ['uploaded' => false, 'errors' => $model->getErrors()];
        }

        return ['uploaded' => false, 'errors' => 'Должен был быть post запрос'];
    }
    
    public function actionFiles()
    {
        $model = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Upload::find(),
        ]);
        
        return $this->render('files', ['model' => $model]);
    }
    
    public function actionFlushCashe()
    {
        $res = Yii::$app->cache->flush();
        var_dump($res);
        exit;
    }

}
