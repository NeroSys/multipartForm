<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%line_messages}}".
 *
 * @property int $id
 * @property string $enterprise
 * @property string $city
 * @property string $country
 * @property string $address
 * @property string $text
 * @property string $trouble
 * @property string $happened
 * @property string $file
 * @property string $name
 * @property string $first_name
 * @property string $email
 * @property string $phone
 * @property string $personnel
 * @property string $is_stuff
 * @property string $date
 * @property string $status
 *
 * @property LinePersonnelFeedback[] $linePersonnelFeedbacks
 * @property LinePersonnelTrouble[] $linePersonnelTroubles
 */
class LineMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%line_messages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['enterprise', 'city', 'country', 'address', 'text', 'trouble', 'happened', 'file', 'name', 'first_name', 'email', 'phone', 'personnel', 'is_stuff', 'status'], 'string', 'max' => 255],
            [[
                'enterprise',
                'city',
                'country',
                'text',
                'trouble',

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
            'enterprise' => 'Предприятие',
            'city' => 'Город',
            'country' => 'Страна',
            'address' => 'Адрес',
            'text' => 'Суть инцидента',
            'trouble' => 'Статус инцидента',
            'happened' => 'Время происшествия',
            'file' => 'Документ',
            'name' => 'Имя',
            'first_name' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'personnel' => 'Должность',
            'is_stuff' => 'Отношение к СКМ',
            'date' => 'Дата',
            'status' => 'Статус заявки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinePersonnelFeedbacks()
    {
        return $this->hasMany(LinePersonnelFeedback::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinePersonnelTroubles()
    {
        return $this->hasMany(LinePersonnelTrouble::className(), ['item_id' => 'id']);
    }
}
