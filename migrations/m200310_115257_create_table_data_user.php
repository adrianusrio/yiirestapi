<?php

use yii\db\Migration;

class m200310_115257_create_table_data_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%data_user}}', [
            'Id' => $this->primaryKey(),
            'ParentName' => $this->string(100)->notNull(),
            'ChildName' => $this->string(100)->notNull(),
            'Phone' => $this->integer()->notNull(),
            'BirthDate' => $this->integer()->notNull(),
            'BirthMonth' => $this->integer()->notNull(),
            'BirthYear' => $this->integer()->notNull(),
            'City' => $this->string(100)->notNull(),
            'Email' => $this->string(100)->notNull(),
            'Sex' => $this->string(10)->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%data_user}}');
    }
}
