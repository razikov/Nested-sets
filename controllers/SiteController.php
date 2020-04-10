<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TreeForm;
use app\models\NestedSets;
use app\helpers\NestedSetsHelper;

class SiteController extends Controller
{
    
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
