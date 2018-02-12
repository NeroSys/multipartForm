<?php

namespace common\models\ckm;

use Yii;

/**
 * This is the model class for table "{{%line_personnel_trouble}}".
 *
 * @property int $id
 * @property int $item_id
 * @property string $guilt
 * @property string $name
 * @property string $first_name
 * @property string $position
 *
 * @property LineMessages $item
 */
class LinePersonnelTrouble extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%line_personnel_trouble}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['guilt', 'name', 'first_name', 'position'], 'string', 'max' => 255],
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
            'guilt' => 'Отношение к инциденту',
            'name' => 'Имя',
            'first_name' => 'Фамилия',
            'position' => 'Должность',
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
