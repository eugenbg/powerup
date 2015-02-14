<?php

class m150214_130155_product_model_relation extends CDbMigration
{
	public function up()
	{
        $columns = array(
            'product_id' => 'INT(11)',
            'model_id' => 'INT(11)',
            'default' => 'TINYINT(1)'
        );

        $options = 'ENGINE InnoDB';
        $this->createTable('product_model', $columns, $options);
        $this->addForeignKey('fk_model_product_rel_product', 'product_model', 'product_id',
            'product', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_model_product_rel_model', 'product_model', 'model_id',
            'model', 'id', 'CASCADE', 'CASCADE');
    }

	public function down()
	{
		echo "m150214_130155_product_model_relation does not support migration down.\n";
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