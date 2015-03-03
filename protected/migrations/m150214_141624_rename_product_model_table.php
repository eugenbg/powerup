<?php

class m150214_141624_rename_product_model_table extends CDbMigration
{
	public function up()
	{
        $this->renameTable('product_model', 'product_item');
	}

	public function down()
	{
		echo "m150214_141624_rename_product_model_table does not support migration down.\n";
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