<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MaterializeAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Schedule',
        //'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' => Url::toRoute(['/schedule']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => \Yii::t('app', 'Загрузить'),
                    'url' => ['/schedule/upload'],
//                    'visible' => !$isGuest,
                ],
                [
                    'label' => \Yii::t('app', 'Список'),
                    'url' => ['/schedule/index'],
//                    'visible' => !$isGuest,
                ],
                [
                    'label' => \Yii::t('app', 'Расписание'),
                    'url' => ['/schedule/presentation'],
//                    'visible' => !$isGuest,
                ],
                [
                    'label' => \Yii::t('app', 'Аудитории'),
                    'url' => ['/schedule/show'],
//                    'items' => [
//                        ['label' => \Yii::t('app', 'Дерево'), 'url' => ['/tree/list'], 'visible' => !$isGuest],
//                        ['label' => \Yii::t('app', 'Пользователи'), 'url' => ['/user/list'], 'visible' => !$isGuest],
//                        ['label' => \Yii::t('app', 'Файлы'), 'url' => ['/files/list'], 'visible' => !$isGuest],
//                        ['label' => \Yii::t('app', 'Статистика'), 'visible' => !$isGuest],
//                        ['label' => \Yii::t('app', 'по сессиям'), 'url' => ['/statistics/session'], 'visible' => !$isGuest],
//                    ],
//                    'visible' => !$isGuest,
                ],
            ]
        ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Razikov А.А. <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php
$this->registerJs('
    $(function () {
        $("body").on("click", ".js-show-modal", function (event) {
            event.preventDefault();
            
            function showError(e) {
                alert(e.responseText);
            }
            
            function showModal(_modal) {
                _modal.modal();
                _modal.on("hidden.bs.modal", () => _modal.remove());
                _modal.on("click", ".js-submit", () => submitForm(_modal));
            }
            function processResponse(response) {
                if (response.hasOwnProperty("form")) {
                    return showModal($(response.form));
                }
                if (response.hasOwnProperty("model")) {
                    window.location.reload();
                    return;
                }
                if (response.hasOwnProperty("location")) {
                    window.location = response.location;
                    return;
                }
                showError({responseText: "Invalid response\n" + response, status: 0});
                return;
            }
            function submitForm(_modal) {
                const form = $("form", _modal);
                const params = {
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: form.serialize(),
                    dataType: "json"
                };
                $.ajax(params)
                    .always(() => _modal.modal("hide"))
                    .done((result) => processResponse(result))
                    .fail((e) => showError(e));
            }
            
            $.ajax({
                type: "GET",
                url: $(this).attr("href"),
                data: {},
                dataType: "json"
            }).done((response) => processResponse(response))
            .fail((e) => showError(e));
        });
    });    
');
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
