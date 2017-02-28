<?php
/**
* 
*/
class CreateCodesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `codes` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`code` int(11) NOT NULL, 
		`roll_id` int(11) NOT NULL, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `codes`';

		return $query;
	}
}