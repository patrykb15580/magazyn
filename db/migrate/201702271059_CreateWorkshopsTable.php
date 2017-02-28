<?php
/**
* 
*/
class CreateWorkshopsTable
{
	
	public function up(){
		$query = 'CREATE TABLE `workshops` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(191) NOT NULL, 
		`street` varchar(191) NOT NULL, 
		`post_code` varchar(191) NOT NULL,
		`city` varchar(191) NOT NULL, 
		`phone` varchar(191) NULL,
		`nip` varchar(191) NULL,
		`email` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `workshops`';

		return $query;
	}
}