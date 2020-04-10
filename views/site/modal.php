<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJs('
    $(function () {
        $("body").on("click", ".js-update-modal", function (event) {
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
<div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        [
            'attribute' => 'description',
            'format' => 'html',
            'value' => function ($item) {
                return Html::a('Модалка', Url::toRoute(['site/update-modal-article', 'id' => $item->id]), [
                    'class' => 'btn btn-default js-update-modal',
                ]);
            },
        ],
    ],
]) ?>
</div>