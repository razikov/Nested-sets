<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TreeForm;
use app\models\NestedSets;

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
//        $a = new \app\models\Advantage();
        $file = Yii::getAlias('@app') . '/gcs_library/Library/Advantages/Basic Set.adq';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Iotha.gcs';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Louis d\'Antares.gcs';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Characters/Basic Set/Dai Blackthorn.gcs';
//        $file = Yii::getAlias('@app') . '/gcs_library/Library/Races/Basic Set/Dragon.gct';
        $z = new \XMLReader();
//        $z->open($file);
        $z->XML(file_get_contents($file));
        
        $i = 0;
        while ($z->read()) {
            $obj = $z->expand();
            if ($obj->nodeType == 1) {
                $obj->nodeName;
                $obj->nodeValue;
                if ($obj->nodeName == 'advantage_list') {
                    $advantageList = new \app\models\gcsAdapter\AdvantageList($obj);
                    var_dump($advantageList->advantage['Zeroed']);exit;
                } elseif ($obj->nodeName == 'advantage') {
                    $advantage = new \app\models\gcsAdapter\Advantage($obj);
//                    var_dump($advantage->result['categories']);exit;
                } elseif ($obj->nodeName == 'character') {
                    $character = new \app\models\gcsAdapter\Character($obj);
                    return $this->render('//gcs/character', ['model' => $character]);
                } elseif ($obj->nodeName == 'template') {
                    $template = new \app\models\gcsAdapter\Template($obj);
                    return $this->render('//gcs/template', ['model' => $template]);
                }
            }
            $i++;
            
        }
        $a = \app\models\Advantage::find()->one();
        var_dump($a);exit;
        exit;
        
        $d1 = mt_rand(1, 6);
        $d2 = mt_rand(1, 6);
        $d3 = mt_rand(1, 6);
        var_dump($d1, $d2, $d3, $d1+$d2+$d3);
        
        $tree = new \app\models\Tree();
        $data = \app\fixtures\DataTree::getData();
//        $treeData = $tree->createTree(['userId', 'groupId', 'id'], $data);
        $treeData = $tree->createTree(['groupId', 'userId', 'id'], $data);
//        $avgData = $tree->getTreeAvg('param1', $treeData);
//        $countData = $tree->getTreeCount('param1', $treeData);
        $availablePaths = $tree->getMaterializedPathsTree($treeData);
        $getKey = $tree->getBranchPath($availablePaths[1]);
//        var_dump(\yii\helpers\ArrayHelper::getValue($treeData, $getKey), $availablePaths, $treeData['rows'][6]['rows'][2]);
        exit;
    }
    
    public function actionDesk()
    {
        return $this->render('desk', []);
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
                return ['uploaded' => true, 'url' => $fileStorage->getUrl($model)];
            }

            // TODO: в ошибки передать массив сообщений
            return ['uploaded' => false, 'errors' => $model->getErrors()];
        }

        return ['uploaded' => false, 'errors' => 'Должен был быть post запрос'];
    }
    
    public function actionFlushCashe()
    {
        exit;
    }

}
