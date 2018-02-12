<?php

use yii\db\Migration;

/**
 * Class m180117_163657_vacancy_request_tables
 */
class m180117_163657_vacancy_request_tables extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        //Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vacancy_message_education}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'dateStart' => $this->string(),
            'dateEnd' => $this->string(),
            'education' => $this->string(),
            'speciality' => $this->string(),
            'qualification' => $this->string(),


        ], $tableOptions);

        $this->createTable('{{%vacancy_message_jobs}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'dateStart' => $this->string(),
            'dateEnd' => $this->string(),
            'firm' => $this->string(),
            'functional' => $this->string(),
            'position' => $this->string(),
            'duties' => $this->string(),

        ], $tableOptions);

        //Создание таблиц категорий
        $this->createTable('{{%vacancy_message}}', [
            'id' => $this->primaryKey(),
            'on_position' => $this->string(),
            'firstName' => $this->string(),
            'name' => $this->string(),
            'parentName' => $this->string(),
            'birthday' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'city' => $this->string(),
            'photo' => $this->string(),
            'languages' => $this->string(),
            'education' => $this->string(),
            'date' => $this->dateTime(),

        ], $tableOptions);

        $this->createIndex('idx_vacancy_education', '{{%vacancy_message_education}}', 'item_id');

        $this->createIndex('idx_vacancy_jobs', '{{%vacancy_message_jobs}}', 'item_id');

        $this->addForeignKey(
            'FK_vacancy_message_education', '{{%vacancy_message_education}}', 'item_id', '{{%vacancy_message}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->addForeignKey(
            'FK_vacancy_message_jobs', '{{%vacancy_message_jobs}}', 'item_id', '{{%vacancy_message}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%vacancy_message_jobs}}');
        $this->dropTable('{{%vacancy_message_education}}');
        $this->dropTable('{{%vacancy_message}}');
    }
}
