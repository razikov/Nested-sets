<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TreeForm;
use app\models\NestedSets;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $tree = new \app\models\Tree();
        $data = \app\fixtures\DataTree::getData();
//        $treeData = $tree->createTree(['userId', 'groupId', 'id'], $data);
        $treeData = $tree->createTree(['groupId', 'userId', 'id'], $data);
//        $avgData = $tree->getTreeAvg('param1', $treeData);
//        $countData = $tree->getTreeCount('param1', $treeData);
        $availablePaths = $tree->getMaterializedPathsTree($treeData);
        $getKey = $tree->getBranchPath($availablePaths[1]);
        var_dump(\yii\helpers\ArrayHelper::getValue($treeData, $getKey), $availablePaths, $treeData['rows'][6]['rows'][2]);
        exit;
    }
    
    public function actionError()
    {
        return $this->redirect('/');
    }
    
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

}
