<?php

class m150214_130916_model_relations extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey('fk_model_rel_brand', 'model', 'brand_id',
            'brand', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_model_rel_series', 'model', 'series_id',
            'series', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_model_rel_subseries', 'model', 'subseries_id',
            'series', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_model_rel_category', 'model', 'category_id',
            'category', 'id', 'CASCADE', 'CASCADE');

    }

	public function down()
	{
		echo "m150214_130916_model_relations does not support migration down.\n";
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