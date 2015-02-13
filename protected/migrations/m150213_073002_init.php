<?php

class m150213_073002_init extends CDbMigration
{
	public function up()
	{
        $columns = array(
                'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
                'sku' => 'VARCHAR(30)',
                'title' => 'VARCHAR(30)',
                'price' => 'DECIMAL(4,1)'
        );
        $options = 'ENGINE InnoDB';
        $this->createTable('product', $columns, $options);
	}

	public function down()
	{
		echo "m150213_073002_init does not support migration down.\n";
		return false;
	}

}