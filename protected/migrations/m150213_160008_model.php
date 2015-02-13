<?php

class m150213_160008_model extends CDbMigration
{
    public function up()
    {
        $columns = array(
            'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(30)',
            'series_id' => 'INT(6) REFERENCES series (id) ON DELETE SET NULL ON UPDATE CASCADE',
            'sub_series_id' => 'INT(6) REFERENCES series (id) ON DELETE SET NULL ON UPDATE CASCADE',
            'brand_id' => 'INT(6) REFERENCES brand (id) ON DELETE CASCADE ON UPDATE CASCADE',
            'category_id' => 'INT(3) REFERENCES category (id) ON DELETE CASCADE ON UPDATE CASCADE'
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