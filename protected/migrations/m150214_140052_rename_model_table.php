<?php

class m150214_140052_rename_model_table extends CDbMigration
{
	public function up()
	{
        $this->renameTable('model', 'item');
	}

	public function down()
	{
		echo "m150214_140052_rename_model_table does not support migration down.\n";
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