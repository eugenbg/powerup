<?php

class m150214_123633_product_category extends CDbMigration
{
	public function up()
	{
        $this->addColumn('product', 'category_id', 'INT(3) REFERENCES category (id)');
	}

	public function down()
	{
		echo "m150214_123633_product_category does not support migration down.\n";
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