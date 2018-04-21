<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\helpers\ViewHelper as vh;

$this->title = 'Tests';


?>
<div class="site-index">
    <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'number')->label('Количество узлов');
        echo Html::submitButton('Сгенерировать дерево', ['class' => 'btn btn-primary']);
        ActiveForm::end();
        echo '<br>';
        echo vh::renderNestedSetTree($items);
    ?>
</div>
