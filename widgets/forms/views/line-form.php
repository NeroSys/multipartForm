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

    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'С каким предприятием Группы СКМ связан инцидент?') ?></span>
        </div>


    <div class="form_group">
        <?=$form->field($modelMain, 'enterprise', [
            'template'=>'<div class="form_flex_row"><label for="corp_name">'.Yii::t('forms', 'Название предприятия').'*</label>{input}{error}</div>',
//            'options' => ['tag' => true]
        ])
            ->textInput()->label(false);?>
    </div>
    <div class="form_group">
        <?=$form->field($modelMain, 'city', [
            'template'=>'<div class="form_flex_row"><label for="city">'.Yii::t('forms', 'Город').'*</label>{input}{error}</div>',
//            'options' => ['tag' => true]
        ])
            ->textInput()->label(false);?>
    </div>
    <div class="form_group">
        <?=$form->field($modelMain, 'country', [
            'template'=>'<div class="form_flex_row"><label for="country">'.Yii::t('forms', 'Страна').'*</label>{input}{error}</div>',
//            'options' => ['tag' => true]
        ])
            ->textInput()->label(false);?>
    </div>
    <div class="form_group">
        <?=$form->field($modelMain, 'address', [
            'template'=>'<div class="form_flex_row"><label for="address">'.Yii::t('forms', 'Адрес').'*</label>{input}{error}</div>',
//            'options' => ['tag' => true]
        ])
            ->textInput()->label(false);?>

    </div>

    <div class="form_sector">
        <div class="form_sector_heading required">


            <span><?= Yii::t('forms', 'Опишите суть инцидента') ?></span>
        </div>
    <div class="form_group">

            <?=$form->field($modelMain, 'text', [
                'template'=>'<div class="form_flex_row"><label for="incident_sut">'.Yii::t('forms', '').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>
            <div class="textarea_description">
                <p><?= Yii::t('forms', 'Укажите как можно больше подробностей, которые сможете вспомнить. По возможности, укажите время, дату, место и имена.')?><br>
                    <?= Yii::t('forms','Максимальная длинна текста - 8000 знаков)') ?></p>
            </div>
    </div>

    </div>



    <!--первая таблица line_personnel_trouble -->
    <?=$this->render('dynamic-form/guilt', compact('form','modelTrouble'));?>



<!--end of block-->
    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'Опишите подробности инцидента') ?></span>
        </div>

        <div class="form_group">
        <?=$form->field($modelMain, 'trouble', [
            'template'=>'<div class="form_flex_row"><label for="event_occur">'.Yii::t('forms', 'Произошел ли уже инцидент, о котором Вы сообщаете').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
        ])
            ->dropDownList(
                [
                    'Уже произошел' => Yii::t('forms', 'Уже произошел'),
                    'Происходит сейчас' => Yii::t('forms', 'Происходит сейчас'),
                    'Произойдёт в будущем'=> Yii::t('forms', 'Произойдёт в будущем')
                ])
            ->label(false);?>
        </div>
        <div class="form_group">
            <?=$form->field($modelMain, 'happened', [
                'template'=>'<div class="form_flex_row"><label for="time1">'.Yii::t('forms', 'Если да, укажите когда произошел инцидент').'</label>{input}{error}</div>',
            ])
                ->textInput()->label(false);?>
        </div>





        <?=$form->field($modelMain, 'file', [ 'template'=>
            '<div class="form_sector_heading">
                <span>'.Yii::t('forms', 'Если Вы располагаете документами, которые Вы можете предоставить в качестве доказательства, перешлите их нам в электронном формате').'</span>
            </div>
            <div class="form_btn_row">
                    {input}{label}
                    
            </div>',
            'options' => ['tag' => false] ])->label(Yii::t('forms', 'Выберите файл'), ['class'=>"form_file_btn"])->fileInput();?>







        <!--вторая таблица line_personnel_feedback-->
        <?=$this->render('dynamic-form/message', compact('form','modelFeedback'));?>

<!--end of block-->

    <div class="form_sector">
        <div class="form_sector_heading">
            <span><?= Yii::t('forms', 'Сообщите Ваши контакты, если хотите, чтобы мы с Вами связались') ?></span>
        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'name', [
                'template'=>'<div class="form_flex_row"><label for="yourname">'.Yii::t('forms', 'Имя').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'first_name', [
                'template'=>'<div class="form_flex_row"><label for="yoursecname">'.Yii::t('forms', 'Фамилия').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'email', [
                'template'=>'<div class="form_flex_row"><label for="email">'.Yii::t('forms', 'Адрес электронной почты').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'phone', [
                'template'=>'<div class="form_flex_row"><label for="phone">'.Yii::t('forms', 'Телефон').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'personnel', [
                'template'=>'<div class="form_flex_row"><label for="placeyour">'.Yii::t('forms', 'Должность').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->textInput()->label(false);?>

        </div>
        <div class="form_group">

            <?=$form->field($modelMain, 'is_stuff', [
                'template'=>'<div class="form_flex_row"><label for="ttt">'.Yii::t('forms', 'Какое отношение Вы имеете к компаниям Группы СКМ').'</label>{input}{error}</div>',
//            'options' => ['tag' => true]
            ])
                ->dropDownList(
                    [
                        'Сотрудник' => Yii::t('forms', 'Сотрудник'),
                        'Бизнес' => Yii::t('forms', 'Бизнес'),
                        'Не имею отношения к компании'=> Yii::t('forms', 'Не имею отношения к компании')
                    ]
                )->label(false);?>

        </div>
    </div>
    <div class="form_sector">
        <div class="form_group">
            <div class="form_flex_row form_flex_row_end">
                <?//= Html::submitButton(Yii::t('app', 'ОТПРАВИТЬ'), ['class' => 'btn btn_callback']) ?>
                <input type="submit" value="Отправить">

            </div>
        </div>
    </div>
<!--</form>-->




<?php $form = ActiveForm::end() ?>




