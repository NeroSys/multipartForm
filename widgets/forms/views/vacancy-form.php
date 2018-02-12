<?php
use yii\widgets\ActiveForm;
?>

<?$form = ActiveForm::begin([

    'id' => 'dynamic-form',
    'options' =>
        [
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ]
]) ?>

<div class="page_heading">
    <h1><?= Yii::t('forms', 'Онлайн-форма Подачи Резюме') ?></h1>
    <div class="resume_place_holder">
        <?= Yii::t('forms', 'на должность') ?>

        <div class="filters_business_filter">

<!--            поле формы для выпадающего списка -->
            <?= $form->field($modelMain, 'on_position')->dropDownList($vacancies, ['prompt' => 'Выберите вакансию'])->label(false) ?>

        </div>


<!--        -->
<!--        <span class="resume_place">инженер-программист</span>-->
    </div>
</div>

    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'Личные данные') ?></span>
        </div>
        <div class="form_group required">

                <?=$form->field($modelMain, 'firstName', [
                    'template'=>'<div class="form_flex_row"><label for="corp_name">'.Yii::t('forms', 'Фамилия').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
                ])
                    ->textInput()->label(false);?>

        </div>
        <div class="form_group required">

            <?=$form->field($modelMain, 'name', [
                'template'=>'<div class="form_flex_row"><label for="city">'.Yii::t('forms', 'Имя').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group required">

            <?=$form->field($modelMain, 'parentName', [
                'template'=>'<div class="form_flex_row"><label for="country">'.Yii::t('forms', 'Отчество').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">


                <?=$form->field($modelMain, 'birthday', [
                    'template'=>'
                <div class="form_flex_row not_fw_row">
                       <label for="time3">
                            '.Yii::t('forms', 'Дата рождения*').'
                       </label>
                    <div class="calendar_container">
                        <div class="calendar_wrap">
                            {input}{error}
                        </div>
                    </div>
                </div>
                ',
//            'options' => ['tag' => true]
                ])
                    ->textInput()->label(false);?>
<!--                <label for="time3"></label>-->
<!--                <div class="calendar_container">-->
<!--                    <div class="calendar_wrap">-->
<!--                        <input class="datepicker_input" type="text" id="time3" name="time3" readonly>-->
<!--                    </div>-->
<!--                </div>-->

        </div>
    </div>
    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'Контакты') ?></span>
        </div>
        <div class="form_group required">

            <?=$form->field($modelMain, 'phone', [
                'template'=>'<div class="form_flex_row"><label for="name1">'.Yii::t('forms', 'Контактный телефон').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group required">

            <?=$form->field($modelMain, 'email', [
                'template'=>'<div class="form_flex_row"><label for="secondname1">'.Yii::t('forms', 'Контактный e-mail').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group required">

            <?=$form->field($modelMain, 'city', [
                'template'=>'<div class="form_flex_row"><label for="place1">'.Yii::t('forms', 'Город').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>

        <?=$form->field($modelMain, 'photo', [ 'template'=>
            '<div class="form_btn_row">
            {input}{label}
            <span class="tip">'. Yii::t('forms', 'Допустимые форматы: jpg, png') .'</span>
        </div>',
            'options' => ['tag' => false] ])->label(Yii::t('forms', 'Загрузить фотографию'), ['class'=>"form_file_btn form_file_btn_wide"])->fileInput();?>

<!--        <div class="form_btn_row">-->
<!--            <input type="file" id="form_img" name="form_img">-->
<!--            <label for="form_img" class="form_file_btn form_file_btn_wide">Загрузить фотографию</label>-->
<!--            <span class="tip">--><?//= Yii::t('forms', 'Допустимые форматы: jpg, png') ?><!--</span>-->
<!--        </div>-->
    </div>


<!--first level-->
<?=$this->render('dynamic-form/education', compact('form','modelEducation'));?>

<!--second level-->

<?=$this->render('dynamic-form/job', compact('form','modelJob'));?>



    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'Дополнительные сведения') ?></span>
        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'languages', [
                'template'=>'<div class="form_flex_row"><label for="yourname">'.Yii::t('forms', 'Владение иностранными языками').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'education', [
                'template'=>'<div class="form_flex_row"><label for="yoursecname">'.Yii::t('forms', 'Дополнительная информация').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
    </div>
    <div class="form_sector">
        <div class="tip"><?= Yii::t('forms', 'Введите символы с картинки') ?>   </div>
        <div class="form_group">
            <div class="form_flex_row">
                <div class="capcha_block">
                    <div class="capcha_img">
                        <img src="/frontend/web/img/capcha.png" alt="">
                    </div>
                    <input type="text" id="capcha" name="capcha">
                </div>
                                            <input type="submit" value="Отправить">
            </div>
        </div>
    </div>


<?php $form = ActiveForm::end() ?>