<?php

class m150228_085311_new_series_column extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('series', 'brand_id');
        $this->addColumn('series', 'brand_id', 'int(6)');
        $this->createIndex('series_brand_id_index', 'series', 'brand_id');
        $this->dropIndex('brand_id_index', 'brand');
        $this->createIndex('brand_id_index', 'brand', 'id');
        $this->addForeignKey('fk_series_brand', 'series', 'brand_id', 'brands', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m150228_085311_new_series_column does not support migration down.\n";
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