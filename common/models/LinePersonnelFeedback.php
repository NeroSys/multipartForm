<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%line_personnel_feedback}}".
 *
 * @property int $id
 * @property int $item_id
 * @property string $name
 * @property string $first_name
 * @property string $position
 * @property string $subdivision
 * @property string $date
 * @property string $text
 * @property string $comment
 *
 * @property LineMessages $item
 */
class LinePersonnelFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%line_personnel_feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['name', 'first_name', 'position', 'subdivision', 'date', 'text', 'comment'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => LineMessages::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => '№ заявки',
            'name' => 'Имя',
            'first_name' => 'Фамилия',
            'position' => 'Должность',
            'subdivision' => 'Подразделение',
            'date' => 'Дата инцидента',
            'text' => 'Принятые меры',
            'comment' => 'Комментарии',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(LineMessages::className(), ['id' => 'item_id']);
    }
}
