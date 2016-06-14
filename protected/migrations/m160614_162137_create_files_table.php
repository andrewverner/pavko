<?php

class m160614_162137_create_files_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('file',[
			'id' => 'pk',
			'name' => 'varchar(255) not null',
			'appeal_id' => 'int not null',
		],'charset=utf8');
	}

	public function down()
	{
		echo "m160614_162137_create_files_table does not support migration down.\n";
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