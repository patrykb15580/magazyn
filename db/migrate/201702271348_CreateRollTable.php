<?php
/**
* 
*/
class CreateRollTable
{
	
	public function up(){
		$query = 'CREATE TABLE `rolls` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`order_id` int(11) NOT NULL, 
		`start_number` int(11) NOT NULL, 
		`codes_quantity` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `rolls`';

		return $query;
	}
}