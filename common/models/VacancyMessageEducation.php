<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%vacancy_message_education}}".
 *
 * @property int $id
 * @property int $item_id
 * @property string $dateStart
 * @property string $dateEnd
 * @property string $education
 * @property string $speciality
 * @property string $qualification
 *
 * @property VacancyMessage $item
 */
class VacancyMessageEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy_message_education}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['dateStart', 'dateEnd', 'education', 'speciality', 'qualification'], 'string', 'max' => 255],
            [[
                'dateStart',
                'dateEnd',
                'education',
                'speciality',
                'qualification'
            ], 'required'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => VacancyMessage::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'dateStart' => 'С',
            'dateEnd' => 'По',
            'education' => 'Учебное заведение',
            'speciality' => 'Специальность',
            'qualification' => 'Квалификация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(VacancyMessage::className(), ['id' => 'item_id'])->inverseOf('vacancyMessageEducations');
    }
}
