<?php

class m160607_140544_fill_regions_table extends CDbMigration
{
	public function up()
	{
		$this->insertMultiple('region',[
			[
				'name' => 'Москва',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Санкт-Петербург',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Московская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Ленинградская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Амурская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Забайкальский край',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Мурманская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Пензенская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Пермский край',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Республика Карелия',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Республика Мордовия',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Республика Саха (Якутия)',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Самарская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Саратовская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'Тамбовская область',
				'email' => 'zapros@czpg.ru'
			],
			[
				'name' => 'ХМАО',
				'email' => 'zapros@czpg.ru'
			],
		]);
	}

	public function down()
	{
		echo "m160607_140544_fill_regions_table does not support migration down.\n";
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