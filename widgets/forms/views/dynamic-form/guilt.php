<?
use wbraganca\dynamicform\DynamicFormWidget;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 4, // the maximum times, an element can be added (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add_guilt', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelTrouble[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'full_name',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
    ],
]); ?>

<div class="form_sector">
    <div class="form_sector_heading">
        <span><?= Yii::t('forms', 'Назовите и опишите лица, ответственные за инцидент (и/или имеющие информацию об инциденте)')?></span>
    </div>
    <?php foreach ($modelTrouble as $i => $modePersonnelTrouble){?>
        <div class="panel-body">
            <div class="container-items">

                <div class="item">
                    <?=$form->field($modePersonnelTrouble, '['.$i.']guilt', [
                        'template'=>'<div class="form_flex_row"><label for="incident_sut">'.Yii::t('forms', 'Какое отношение к инциденту имеет это лицо').'</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>


                    <?=$form->field($modePersonnelTrouble, '['.$i.']name', [
                        'template'=>'<div class="form_flex_row"><label for="incident_sut">'.Yii::t('forms', 'Имя').'</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>

                    <?=$form->field($modePersonnelTrouble, '['.$i.']first_name', [
                        'template'=>'<div class="form_flex_row"><label for="incident_sut">'.Yii::t('forms', 'Фамилия').'</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>

                    <?=$form->field($modePersonnelTrouble, '['.$i.']position', [
                        'template'=>'<div class="form_flex_row"><label for="incident_sut">'.Yii::t('forms', 'Должность').'</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>


                </div>

            </div>
        </div>
    <?}?>

    <div class="hidden_content_btn_holder">
        <div class="btn_holder">
            <a href="#" class="hidden_content_btn_show add_guilt">
                <span><?= Yii::t('forms', 'Добавить лицо') ?></span>
                <div class="main_arrow"><img src="/frontend/web/img/arrow_gold_down.png" alt=""></div>
                <div class="hover_arrow"><img src="/frontend/web/img/arrow_white_down.png" alt=""></div>
            </a>
        </div>
    </div>

    <?php DynamicFormWidget::end(); ?>

<?php $script = <<< JS

        $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
            console.log("beforeInsert");
        });

        $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
            console.log("afterInsert");
        });

        $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

JS;
$this->registerJs($script, yii\web\View::POS_END );
?>
</div>
