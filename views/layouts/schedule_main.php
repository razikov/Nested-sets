<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
$formatter = Yii::$app->formatter;
$now = new DateTimeImmutable();
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
        'brandLabel' => 'Расписание занятий ИРО',
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
                    'label' => \Yii::t('app', 'на импорте'),
                    'url' => '#',
                    'items' => [
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
                    ],
//                    'visible' => !$isGuest,
                ],
                [
                    'label' => \Yii::t('app', 'на информсистеме'),
                    'url' => '#',
                    'items' => [
                        [
                            'label' => \Yii::t('app', 'Список курсов'),
                            'url' => ['/schedule-info/index'],
        //                    'visible' => !$isGuest,
                        ],
                        [
                            'label' => \Yii::t('app', 'Список занятий'),
                            'url' => ['/schedule-info/themes'],
        //                    'visible' => !$isGuest,
                        ],
                        [
                            'label' => \Yii::t('app', 'Расписание'),
                            'url' => ['/schedule-info/presentation'],
        //                    'visible' => !$isGuest,
                        ],
                    ],
//                    'visible' => !$isGuest,
                ],
            ]
        ]);
    NavBar::end();
    ?>

    <div class="container">
        <div class="alert alert-info">
            Сегодня <?= $formatter->asDate($now, 'full') ?>
        </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <h3></h3>
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
    function showError(e) {
        alert(e.responseText);
    }

    function showModal(_modal, options) {
        options.beforeShow(_modal, options);
        _modal.modal();
        _modal.on("hidden.bs.modal", () => _modal.remove());
        _modal.on("click", ".js-submit", () => submitForm(_modal));
    }

    function processResponse(response, options) {
        if (response.hasOwnProperty("form")) {
            return showModal($(response.form), options);
        }
        if (response.hasOwnProperty("model")) {
            options.afterClose(options, response);
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

    function fetchModal(selector, options) {
        options = $.extend({
            afterClose: () => window.location.reload(),
            beforeShow: () => {},
            url: null,
            data: {}
        }, options || {});
        const params = {
            type: "GET",
            url: options.url || $(selector).attr("href"),
            data: options.data,
            dataType: "json"
        };
        $.ajax(params)
            .done((response) => processResponse(response, options))
            .fail((e) => showError(e));
    }

    function bindModal(selector, options) {
        $(selector).click(function () {
            fetchModal(this, options || {});
            return false;
        });
    }

    function selectpicker(selector) {
        $(".selectpicker", selector).selectpicker();
    }

    function datepicker(selector) {
        $(".datepicker", selector).datetimepicker({format: "d.m.Y", lang: "ru", dayOfWeekStart: 1, timepicker: false});
    }

    function timepicker(selector) {
        $(".timepicker", selector).datetimepicker({format:"H:i", lang: "ru", datepicker:false, });
    }

    function datetimepicker(selector) {
        $(".datetimepicker", selector).datetimepicker({format: "d.m.Y H:i", lang: "ru", dayOfWeekStart: 1});
    }    
');
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
