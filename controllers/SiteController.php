<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TreeForm;
use app\models\Utils;
use app\models\NestedSets;
use yii\helpers\Url;
use app\components\GeneratorNestedSets;

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
        //Поведение!!
        $model = new TreeForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = GeneratorNestedSets::generate($model->number);
            NestedSets::deleteAll();
            Yii::$app->db->createCommand()->batchInsert('nestedsets', ['id', 'name', 'lft', 'rgt', 'lvl'], $data)->execute();
        }

        $tree = NestedSets::find()->orderBy('lft')->All();
        // var_dump($tree);exit;
        return $this->render('index', ['model' => $model, 'items' => $tree]);
    }

    public function actionThread($ids)
    {
        //Поведение!!
        $form = new TreeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $data = GeneratorNestedSets::generate($form->number);
            NestedSets::deleteAll();
            Yii::$app->db->createCommand()->batchInsert('nestedsets', ['id', 'name', 'lft', 'rgt', 'lvl'], $data)->execute();
        }

        // Получить параметры запроса
        $list = explode(',', $ids);
        $nodes = NestedSets::findAll($list);
        if ($nodes == null) {
            return $this->redirect(['site/index']);
        }
        // Создать корневой узел
        $root = new NestedSets();
        $root->attributes = [ 'lvl' => 0, 'id' => 1, 'name' => 'root' ];
        $model = [$root];
        // Получить ветку каждого искомого узла и добавить её в корень нового дерева
        foreach ($nodes as $node) {
            $thread = $node->thread;
            // Сделать ветку потомком нулевого узла
    		if ($thread[0]->lvl != 1) {
    			$delta = $thread[0]->lvl - 1; // Разница уровней

    			foreach ($thread as $threadNode) {
    				$threadNode->lvl -= $delta; // Скорректировать уровень узла на разницу
    			}
    		}
            $model = array_merge($model, $thread);
        }

        return $this->render('index', ['model' => $form, 'items' => $model]);
    }
}
