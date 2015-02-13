<?php

class m150213_154429_category_table extends CDbMigration
{
    public function up()
    {
        $columns = array(
            'id' => 'INT(3) AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(30)',
        );
        $options = 'ENGINE InnoDB';
        $this->createTable('category', $columns, $options);
    }

	public function down()
	{
		echo "m150213_154429_category_table does not support migration down.\n";
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