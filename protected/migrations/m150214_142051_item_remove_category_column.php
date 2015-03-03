<?php

class m150214_142051_item_remove_category_column extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('fk_model_rel_category', 'item');
        $this->dropColumn('item', 'category_id');
	}

	public function down()
	{
		echo "m150214_142051_item_remove_category_column does not support migration down.\n";
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