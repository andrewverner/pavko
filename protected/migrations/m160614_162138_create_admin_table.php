<?php

class m160614_162138_create_admin_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('admin',[
			'id' => 'pk',
			'login' => 'varchar(45) not null',
			'password' => 'varchar(32) not null',
		],'charset=utf8');
	}

	public function down()
	{
		echo "m160614_162138_create_admin_table does not support migration down.\n";
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