<?php

class m150215_082918_alter_product_item_table extends CDbMigration
{
    public function up()
    {
        $this->dropTable('product_item');
        $columns = array(
            'id' => 'INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT',
            'product_id' => 'INT(11)',
            'item_id' => 'INT(11)',
            'default' => 'TINYINT(1)'
        );

        $options = 'ENGINE InnoDB';
        $this->createTable('product_item', $columns, $options);
        $this->addForeignKey('fk_model_product_rel_product', 'product_item', 'product_id',
            'product', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_model_product_rel_item', 'product_item', 'item_id',
            'item', 'id', 'CASCADE', 'CASCADE');
    }

	public function down()
	{
		echo "m150215_082918_alter_product_item_table does not support migration down.\n";
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