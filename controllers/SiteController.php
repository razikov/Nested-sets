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
    
    public function actionWorkflow()
    {
        $registry = new \Symfony\Component\Workflow\Registry();
        
        $definitionBuilder = new \Symfony\Component\Workflow\DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['draft', 'review', 'rejected', 'published'])
            ->addTransition(new \Symfony\Component\Workflow\Transition('to_review', 'draft', 'review'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('publish', 'review', 'published'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('reject', 'review', 'rejected'))
            ->build()
        ;
        $marking = new \Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore('currentState');
        $workflow = new \Symfony\Component\Workflow\Workflow($definition, $marking, null, 'articleFlow');
        $registry->addWorkflow($workflow, new \Symfony\Component\Workflow\SupportStrategy\InstanceOfSupportStrategy(\app\models\Articles::class));
        
        $definitionBuilder = new \Symfony\Component\Workflow\DefinitionBuilder();
        $definition = $definitionBuilder->addPlaces(['draft', 'wait_for_journalist', 'approved_by_journalist', 'wait_for_spellchecker', 'approved_by_spellchecker', 'testAlternative', 'published'])
            ->addTransition(new \Symfony\Component\Workflow\Transition('request_review', 'draft', ['wait_for_journalist', 'wait_for_spellchecker', 'testAlternative']))
            ->addTransition(new \Symfony\Component\Workflow\Transition('request_review2', 'draft', 'testAlternative'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('journalist_approval', 'wait_for_journalist', 'approved_by_journalist'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('spellchecker_approval', 'wait_for_spellchecker', 'approved_by_spellchecker'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('publish', ['approved_by_journalist', 'approved_by_spellchecker'], 'published'))
            ->addTransition(new \Symfony\Component\Workflow\Transition('publish2', 'testAlternative', 'published'))
            ->build()
        ;

        $marking = new \Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore('currentState');
        $workflow = new \Symfony\Component\Workflow\Workflow($definition, $marking, null, 'articleMultipleFlow');
        $registry->addWorkflow($workflow, new \Symfony\Component\Workflow\SupportStrategy\InstanceOfSupportStrategy(\app\models\Articles::class));
        //===================
        $post = new \app\models\Articles();
        $workflow = $registry->get($post, 'articleFlow');
        var_dump($post->currentState);
        var_dump($workflow->can($post, 'publish'));
        var_dump($workflow->can($post, 'to_review'));
        $workflow->apply($post, 'to_review');
        var_dump($post->currentState);
        var_dump($workflow->can($post, 'publish'));
        var_dump($workflow->can($post, 'to_review'));
        //===================
        var_dump("===================");
        $post = new \app\models\Articles();
        $workflow = $registry->get($post, 'articleMultipleFlow');
        var_dump($post->currentState);
        var_dump($workflow->can($post, 'request_review'));
        var_dump($workflow->can($post, 'journalist_approval'));
        var_dump($workflow->can($post, 'approved_by_journalist'));
        var_dump($workflow->can($post, 'spellchecker_approval'));
        var_dump($workflow->can($post, 'approved_by_spellchecker'));
        var_dump($workflow->can($post, 'testAlternative'));
        var_dump($workflow->can($post, 'publish'));
        var_dump($workflow->can($post, 'publish2'));
//        $workflow->apply($post, 'request_review');
        $workflow->apply($post, 'request_review2');
        var_dump($post->currentState);
        var_dump($workflow->can($post, 'request_review'));
        var_dump($workflow->can($post, 'journalist_approval'));
        var_dump($workflow->can($post, 'approved_by_journalist'));
        var_dump($workflow->can($post, 'spellchecker_approval'));
        var_dump($workflow->can($post, 'approved_by_spellchecker'));
        var_dump($workflow->can($post, 'testAlternative'));
        var_dump($workflow->can($post, 'publish'));
        var_dump($workflow->can($post, 'publish2'));
//        $workflow->apply($post, 'journalist_approval');
//        var_dump($post->currentState);
//        var_dump($workflow->can($post, 'request_review'));
//        var_dump($workflow->can($post, 'journalist_approval'));
//        var_dump($workflow->can($post, 'approved_by_journalist'));
//        var_dump($workflow->can($post, 'spellchecker_approval'));
//        var_dump($workflow->can($post, 'approved_by_spellchecker'));
//        var_dump($workflow->can($post, 'testAlternative'));
//        var_dump($workflow->can($post, 'publish'));
        
        exit;
    }
    
    public function actionElement()
    {
        return $this->render('element', []);
    }
    
    public function actionIndex()
    {
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $data = NestedSetsHelper::generate($form->number);
            NestedSets::deleteAll();
            Yii::$app->db->createCommand()->batchInsert('nestedsets', ['id', 'name', 'lft', 'rgt', 'lvl'], $data)->execute();
        }

        $tree = NestedSets::findDefault();

        return $this->render('index', ['model' => $form, 'items' => $tree]);
    }
    
    public function actionModal()
    {
        $provider = new \yii\data\ActiveDataProvider([
            'query' => \app\models\Articles::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('modal', ['dataProvider' => $provider]);
    }
    
    public function actionUpdateModalArticle($id)
    {
        $model = \app\models\Articles::find()->where(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('Запись не найдена');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['model' => $model];
        }
        return ['form' => $this->renderPartial('//article/updateModal', ['model' => $model])];
    }
    
    public function actionDesk()
    {
        return $this->render('desk', []);
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
