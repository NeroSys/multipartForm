<?
use wbraganca\dynamicform\DynamicFormWidget;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper_j', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items_job', // required: css class selector
    'widgetItem' => '.item_job', // required: css class
    'limit' => 4, // the maximum times, an element can be added (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add_job_bt', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelJob[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'dateStart',
        'dateEnd',
        'firm',
        'functional',
        'position',
        'duties'
    ],
]); ?>

<div class="form_sector">
    <div class="form_sector_heading">
        <span><?=  Yii::t('forms', 'Опыт работы')?></span>
    </div>

    <?php foreach ($modelJob as $i => $modelItemJob){?>
        <div class="panel-body">
            <div class="container-items_job">
                <div class="item_job">

                    <div>
                        <div class="form_flex_row not_fw_row">

                            <label><?= Yii::t('forms', 'Период работы') ?>*</label>

                            <?=$form->field($modelItemJob, '['.$i.']dateStart', [
                                'template'=>'<div class="calendar_container">
                                             <span>'.Yii::t('forms', 'c').'</span>
                                             <div class="calendar_wrap">
                                                {input}{error}
                                                </div>
                                         </div>',
                            ])->textInput(['class'=>"datepicker_input"])->label(false);?>


                            <?=$form->field($modelItemJob, '['.$i.']dateEnd', [
                                'template'=>'<div class="calendar_container">
                                             <span>'.Yii::t('forms', 'по').'</span>
                                             <div class="calendar_wrap">
                                                {input}{error}
                                                </div>
                                         </div>',
                            ])->textInput(['class'=>"datepicker_input"])->label(false);?>

                        </div>
                    </div>




                    <?=$form->field($modelItemJob, '['.$i.']firm', [
                        'template'=>'<div class="form_flex_row">
                                            <label for="place5">'.Yii::t('forms', 'Организация').'*</label>
                                                {input}{error}
                                     </div>',
                    ])->textInput()->label(false);?>


                    <?=$form->field($modelItemJob, '['.$i.']functional', [
                        'template'=>'<div class="form_flex_row"><label for="otnoshenie1">'.Yii::t('forms', 'Функционал').'*</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>

                    
                    <?=$form->field($modelItemJob, '['.$i.']position', [
                        'template'=>'<div class="form_flex_row"><label for="place6">'.Yii::t('forms', 'Должность').'*</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>

                    <?=$form->field($modelItemJob, '['.$i.']duties', [
                        'template'=>'<div class="form_flex_row"><label for="place7">'.Yii::t('forms', 'Обязанности').'*</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>
                </div>
            </div>
        </div>
    <?}?>
    <div class="hidden_content_btn_holder">
        <div class="btn_holder">
            <a href="#" class="hidden_content_btn_show add_job_bt">
                <span><?= Yii::t('forms', 'Добавить') ?></span>
                <div class="main_arrow"><img src="/frontend/web/img/arrow_gold_down.png" alt=""></div>
                <div class="hover_arrow"><img src="/frontend/web/img/arrow_white_down.png" alt=""></div>
            </a>
        </div>
    </div>


    <?php DynamicFormWidget::end(); ?>

    <?php $script = <<< JS

        $(".dynamicform_wrapper_job").on("beforeInsert", function(e, item) {
            console.log("beforeInsert");
        });

        $(".dynamicform_wrapper_job").on("afterInsert", function(e, item) {
            console.log("afterInsert");
        });

        $(".dynamicform_wrapper_job").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper_job").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper_job").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

JS;
    $this->registerJs($script, yii\web\View::POS_END );
    ?>
</div>
