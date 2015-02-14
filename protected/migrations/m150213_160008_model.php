<?php

class m150213_160008_model extends CDbMigration
{
    public function up()
    {
        $columns = array(
            'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(30)',
            'series_id' => 'INT(6)',
            'subseries_id' => 'INT(6)',
            'brand_id' => 'INT(6)',
            'category_id' => 'INT(3)'
        );
        $options = 'ENGINE InnoDB';
        $this->createTable('model', $columns, $options);
    }

	public function down()
	{
		echo "m150213_160008_model does not support migration down.\n";
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