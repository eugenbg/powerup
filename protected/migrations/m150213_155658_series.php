<?php

class m150213_155658_series extends CDbMigration
{
    public function up()
    {
        $columns = array(
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(30)',
            'parent_series_id' => 'INT(6)'
        );
        $options = 'ENGINE InnoDB';
        $this->createTable('series', $columns, $options);
    }

    public function down()
    {
        echo "m150213_155425_brand does not support migration down.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}