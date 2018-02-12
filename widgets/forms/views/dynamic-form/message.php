<?

use wbraganca\dynamicform\DynamicFormWidget;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper_q', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items_msg', // required: css class selector
    'widgetItem' => '.item_msg', // required: css class
    'limit' => 4, // the maximum times, an element can be added (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add_msg_bt', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelFeedback[0],
    'formId' => 'dynamic-form',
    'formFields' => [

        'name',
        'first_name',
        'position',
        'subdivision',
        'date',
        'text',
        'comment',
    ],
]); ?>



<div class="form_sector">
    <div class="form_sector_heading">
        <span><?= Yii::t('forms', 'Сообщали ли Вы о случившемся инциденте кому - либо? Если да, то укажите кому')?></span>
    </div>

    <?php foreach ($modelFeedback as $i => $modePersonnelFeedback){?>
    <div class="panel-body">
        <div class="container-items_msg">
            <div class="item_msg">
            <?=$form->field($modePersonnelFeedback, '['.$i.']name', [
                'template'=>'<div class="form_flex_row"><label for="told_name">'.Yii::t('forms', 'Имя').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>



            <?=$form->field($modePersonnelFeedback, '['.$i.']first_name', [
                'template'=>'<div class="form_flex_row"><label for="told_second_name">'.Yii::t('forms', 'Фамилия').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>



            <?=$form->field($modePersonnelFeedback, '['.$i.']position', [
                'template'=>'<div class="form_flex_row"><label for="told_place">'.Yii::t('forms', 'Должность').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>



            <?=$form->field($modePersonnelFeedback, '['.$i.']subdivision', [
                'template'=>'<div class="form_flex_row"><label for="told_structural">'.Yii::t('forms', 'Название структурного подразделения').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>


            <?=$form->field($modePersonnelFeedback, '['.$i.']date', [
                'template'=>'<div class="form_flex_row"><label for="time2">'.Yii::t('forms', 'Если да, укажите когда произошел инцидент').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>

            <?=$form->field($modePersonnelFeedback, '['.$i.']text', [
                'template'=>'
                <div class="form_sector_heading">
                    <span>'.Yii::t('forms', 'Опишите меры, предпринятые данным лицом после Вашего заявления').'</span>
                </div>
                <div class="form_flex_row"><label for="text2">'.Yii::t('forms', 'Text').'</label>{input}{error}</div>
                            <div class="textarea_description">
                <p>'.Yii::t('forms', '(максимальная длина текста - 800 знаков)').'</p>
            </div>',
            ])->textInput()->label(false);?>




            <?=$form->field($modePersonnelFeedback, '['.$i.']comment', [
                'template'=>'
                    <div class="form_sector_heading">
                        <span>'.Yii::t('forms', 'Ваши комментарии по поводу предпринятых мер').'</span>
                    </div>
                    <div class="form_flex_row"><label for="text3">'.Yii::t('forms', '').'</label>{input}{error}</div>',
            ])->textInput()->label(false);?>

        </div>
    </div>
    </div>
    <?}?>

    <div class="hidden_content_btn_holder">
        <div class="btn_holder">
            <a href="#" class="hidden_content_btn_show add_msg_bt">
                <span><?= Yii::t('forms', 'Добавить') ?></span>
                <div class="main_arrow"><img src="/frontend/web/img/arrow_gold_down.png" alt=""></div>
                <div class="hover_arrow"><img src="/frontend/web/img/arrow_white_down.png" alt=""></div>
            </a>
        </div>
    </div>

    <?php DynamicFormWidget::end(); ?>

    <?php $script = <<< JS

        $(".dynamicform_wrapper_msg").on("beforeInsert", function(e, item) {
            console.log("beforeInsert");
        });

        $(".dynamicform_wrapper_msg").on("afterInsert", function(e, item) {
            console.log("afterInsert");
        });

        $(".dynamicform_wrapper_msg").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper_msg").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper_msg").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

JS;
    $this->registerJs($script, yii\web\View::POS_END );
    ?>


</div>