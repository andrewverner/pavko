<?php

class m160531_144932_init_migration extends CDbMigration
{
	public function up()
	{
		$this->createTable('user',[
			'id' => 'pk',
			'region_id' => 'int',
			'last_name' => 'varchar(255)',
			'first_name' => 'varchar(255)',
			'middle_name' => 'varchar(255)',
			'phone' => 'varchar(45)',
			'reg_time' => 'datetime',
		],'charset=utf8');

		$this->createTable('region',[
			'id' => 'pk',
			'name' => 'varchar(255)',
			'email' => 'varchar(255)',
		],'charset=utf8');

		$this->createTable('appeal',[
			'id' => 'pk',
			'user_id' => 'int',
			'category' => 'varchar(255)',
			'city' => 'varchar(255)',
			'address' => 'varchar(255)',
			'text' => 'text',
			'file' => 'varchar(255)',
			'email' => 'varchar(45)',
		],'charset=utf8');
	}

	public function down()
	{
		echo "m160531_144932_init_migration does not support migration down.\n";
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