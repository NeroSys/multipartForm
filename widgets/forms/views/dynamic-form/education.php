<?
use wbraganca\dynamicform\DynamicFormWidget;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper_e', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items_ed', // required: css class selector
    'widgetItem' => '.item_ed', // required: css class
    'limit' => 4, // the maximum times, an element can be added (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add_ed_bt', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelEducation[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'dateStart',
        'dateEnd',
        'education',
        'speciality',
        'qualification',
    ],
]); ?>

<div class="form_sector">
    <div class="form_sector_heading">
        <span><?=  Yii::t('forms', 'Образование')?></span>
    </div>

    <?php foreach ($modelEducation as $i => $modelItemEducation){?>
    <div class="panel-body">
        <div class="container-items_ed">
            <div class="item_ed">

                <div>
                    <div class="form_flex_row not_fw_row">

                        <label><?= Yii::t('forms', 'Период обучения') ?>*</label>

                        <?=$form->field($modelItemEducation, '['.$i.']dateStart', [
                            'template'=>'<div class="calendar_container">
                                             <span>'.Yii::t('forms', 'c').'</span>
                                             <div class="calendar_wrap">
                                                {input}{error}
                                                </div>
                                         </div>',
                        ])->textInput(['class'=>"datepicker_input"])->label(false);?>


                        <?=$form->field($modelItemEducation, '['.$i.']dateEnd', [
                            'template'=>'<div class="calendar_container">
                                             <span>'.Yii::t('forms', 'по').'</span>
                                             <div class="calendar_wrap">
                                                {input}{error}
                                                </div>
                                         </div>',
                        ])->textInput(['class'=>"datepicker_input"])->label(false);?>

                    </div>
                </div>




                    <?=$form->field($modelItemEducation, '['.$i.']education', [
                        'template'=>'<div class="form_flex_row">
                                            <label for="place2">'.Yii::t('forms', 'Учебное заведение').'*</label>
                                                {input}{error}
                                     </div>',
                    ])->textInput()->label(false);?>


                        <?=$form->field($modelItemEducation, '['.$i.']speciality', [
                            'template'=>'<div class="form_flex_row"><label for="place3">'.Yii::t('forms', 'Специальность').'*</label>{input}{error}</div>',
                        ])->textInput()->label(false);?>



                    <?=$form->field($modelItemEducation, '['.$i.']qualification', [
                        'template'=>'<div class="form_flex_row"><label for="place4">'.Yii::t('forms', 'Квалификация').'*</label>{input}{error}</div>',
                    ])->textInput()->label(false);?>
            </div>
        </div>
    </div>
    <?}?>
    <div class="hidden_content_btn_holder">
        <div class="btn_holder">
            <a href="#" class="hidden_content_btn_show add_ed_bt">
                <span><?= Yii::t('forms', 'Добавить') ?></span>
                <div class="main_arrow"><img src="/frontend/web/img/arrow_gold_down.png" alt=""></div>
                <div class="hover_arrow"><img src="/frontend/web/img/arrow_white_down.png" alt=""></div>
            </a>
        </div>
    </div>


    <?php DynamicFormWidget::end(); ?>

    <?php $script = <<< JS

        $(".dynamicform_wrapper_ed").on("beforeInsert", function(e, item) {
            console.log("beforeInsert");
        });

        $(".dynamicform_wrapper_ed").on("afterInsert", function(e, item) {
            console.log("afterInsert");
        });

        $(".dynamicform_wrapper_ed").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper_ed").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper_ed").on("limitReached", function(e, item) {
            alert("Limit reached");
        });

JS;
    $this->registerJs($script, yii\web\View::POS_END );
    ?>
</div>
