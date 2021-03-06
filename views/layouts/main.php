<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
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
        'brandLabel' => 'Tests',
        'brandUrl' => Url::toRoute(['/']),
        'options' => [
            'class' => 'navbar-inverse',
        ],
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

<?php
$this->registerJs('
    function showError(e) {
        alert(e.responseText);
    }

    function showModal(_modal, options) {
        options.beforeShow(_modal, options);
        _modal.modal();
        _modal.on("hidden.bs.modal", () => _modal.remove());
        _modal.on("click", ".js-submit", () => submitForm(_modal, options));
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

    function submitForm(_modal, options) {
        const form = $("form", _modal);
        const params = {
            type: form.attr("method"),
            url: form.attr("action"),
            data: form.serialize(),
            dataType: "json"
        };
        $.ajax(params)
            .always(() => _modal.modal("hide"))
            .done((response) => processResponse(response, options))
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
$this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
