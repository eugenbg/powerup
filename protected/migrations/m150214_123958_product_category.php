<?php

class m150214_123958_product_category extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey('fk_product_category', 'product', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
    }

	public function down()
	{
		echo "m150214_123958_product_category does not support migration down.\n";
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