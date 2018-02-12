<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%vacancy_message}}".
 *
 * @property int $id
 * @property string $on_position
 * @property string $firstName
 * @property string $name
 * @property string $parentName
 * @property string $birthday
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $photo
 * @property string $languages
 * @property string $education
 * @property string $date
 *
 * @property VacancyMessageEducation[] $vacancyMessageEducations
 * @property VacancyMessageJobs[] $vacancyMessageJobs
 */
class VacancyMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['photo'], 'file', 'extensions' => 'jpg, png, jpeg'],
            [['on_position', 'firstName', 'name', 'parentName', 'birthday', 'phone', 'email', 'city', 'photo', 'languages', 'education'], 'string', 'max' => 255],
            [[
                'firstName',
                'name',
                'parentName',
                'birthday',
                'phone',
                'email',
                'city',

                ], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'on_position' => 'На должность',
            'firstName' => 'Фамилия',
            'name' => 'Имя',
            'parentName' => 'Отчество',
            'birthday' => 'Дата рождения',
            'phone' => 'Телефон',
            'email' => 'Email',
            'city' => 'Город',
            'photo' => 'Фото',
            'languages' => 'Владение языками',
            'education' => 'Образование',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancyMessageEducations()
    {
        return $this->hasMany(VacancyMessageEducation::className(), ['item_id' => 'id'])->inverseOf('item');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancyMessageJobs()
    {
        return $this->hasMany(VacancyMessageJobs::className(), ['item_id' => 'id'])->inverseOf('item');
    }

    public function getImage(){


        return ($this->photo) ?  '@frontPath'. $this->photo : '/frontend/web/no-image.jpg';
    }
}
