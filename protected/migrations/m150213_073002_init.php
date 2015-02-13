<?php

class m150213_073002_init extends CDbMigration
{
	public function up()
	{
        $this->execute('CREATE DATABASE batareiki;');
	}

	public function down()
	{
		echo "m150213_073002_init does not support migration down.\n";
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