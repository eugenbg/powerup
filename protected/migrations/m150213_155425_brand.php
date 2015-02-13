<?php

class m150213_155425_brand extends CDbMigration
{
    public function up()
    {
        $columns = array(
            'id' => 'INT(6) AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(30)',
        );
        $options = 'ENGINE InnoDB';
        $this->createTable('brand', $columns, $options);
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