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
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            NestedSets::generateData($form->number);
        }

        $tree = NestedSets::findDefault();

        return $this->render('index', ['model' => $form, 'items' => $tree]);
    }
    
    public function actionError()
    {
        return $this->redirect('/');
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
