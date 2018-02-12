<?php

use yii\db\Migration;

/**
 * Class m180114_114241_line_messages_table
 */
class m180114_114241_line_messages_table extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        //Опции для mysql
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%line_personnel_trouble}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'guilt' => $this->string(),
            'name' => $this->string(),
            'first_name' => $this->string(),
            'position' => $this->string()
        ], $tableOptions);

        $this->createTable('{{%line_personnel_feedback}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(11),
            'name' => $this->string(),
            'first_name' => $this->string(),
            'position' => $this->string(),
            'subdivision' => $this->string(),
            'date' => $this->string(),
            'text' => $this->string(),
            'comment' => $this->string(),

        ], $tableOptions);

        //Создание таблиц категорий
        $this->createTable('{{%line_messages}}', [
            'id' => $this->primaryKey(),
            'enterprise' => $this->string(),
            'city' => $this->string(),
            'country' => $this->string(),
            'address' => $this->string(),
            'text' => $this->string(),
            'trouble' => $this->string(),
            'happened' => $this->string(),
            'file' => $this->string(),
            'name' => $this->string(),
            'first_name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'personnel' => $this->string(),
            'is_stuff' => $this->string(),
            'date' => $this->dateTime(),
            'status' => $this->string()

        ], $tableOptions);



        $this->createIndex('idx_line_personnel_trouble', '{{%line_personnel_trouble}}', 'item_id');
        $this->createIndex('idx_line_personnel_feedback', '{{%line_personnel_feedback}}', 'item_id');


        $this->addForeignKey(
            'FK_line_personnel_trouble', '{{%line_personnel_trouble}}', 'item_id', '{{%line_messages}}', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_line_personnel_feedback', '{{%line_personnel_feedback}}', 'item_id', '{{%line_messages}}', 'id', 'CASCADE', 'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%line_personnel_trouble}}');
        $this->dropTable('{{%line_personnel_feedback}}');
        $this->dropTable('{{%line_messages}}');
    }
}
