<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%vacancy_message_jobs}}".
 *
 * @property int $id
 * @property int $item_id
 * @property string $dateStart
 * @property string $dateEnd
 * @property string $firm
 * @property string $functional
 * @property string $position
 * @property string $duties
 *
 * @property VacancyMessage $item
 */
class VacancyMessageJobs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy_message_jobs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['dateStart', 'dateEnd', 'firm', 'functional', 'position', 'duties'], 'string', 'max' => 255],
            [[
                'dateStart',
                'dateEnd',
                'firm',
                'functional',
                'position',
                'duties'
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
            'firm' => 'Организация',
            'functional' => 'Функционал',
            'position' => 'Должность',
            'duties' => 'Обязанноcти',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(VacancyMessage::className(), ['id' => 'item_id'])->inverseOf('vacancyMessageJobs');
    }
}
