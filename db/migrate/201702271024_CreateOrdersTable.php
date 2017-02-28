<?php
/**
* 
*/
class CreateOrdersTable
{
	
	public function up(){
		$query = 'CREATE TABLE `orders` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`workshop_id` int(11) NULL, 
		`hash_id` varchar(191) NOT NULL, 
		`customer_name` varchar(191) NOT NULL, 
		`customer_street` varchar(191) NOT NULL, 
		`customer_post_code` varchar(191) NOT NULL,
		`customer_city` varchar(191) NOT NULL, 
		`customer_phone` varchar(191) NULL,
		`customer_nip` varchar(191) NULL,
		`email` varchar(191) NOT NULL,
		`custom_shipping_name` varchar(191) NOT NULL,
		`custom_shipping_street` varchar(191) NOT NULL,
		`custom_shipping_post_code` varchar(191) NOT NULL,
		`custom_shipping_city` varchar(191) NOT NULL,
		`shipping_type` varchar(191) NOT NULL,
		`payment_status` varchar(191) NOT NULL,
		`payment_type` varchar(191) NOT NULL,
		`value` decimal(8, 2) NOT NULL,
		`download_invoice` varchar(191) NULL,
		`status` varchar(191) NOT NULL,
		`quantity` int(11) NULL, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `orders`';

		return $query;
	}
}