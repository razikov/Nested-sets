<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Tests';

?>

<?= $this->render('_search', ['model' => $searchModel]); ?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <?php foreach ($h as $title) : ?>
            <th class="text-center"><?= $title ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($busy as $key => $row) : ?>
        <tr>
            <td align='center' class='sh'><?=$key?></td>
            <?php foreach ($row as $cell) : ?>
            <?php $class = ""; if ($cell == '1') {$class = 'success';} elseif ($cell != 0) {$class = 'danger';}  ?>
            <td width='8%' align='center' class="<?=$class?>"><?= $class == "" ? "&nbsp;" : $cell ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

