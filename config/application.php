<?php
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_MONETARY, 'pl_PL');

// Environment
include 'config/environment.php';
include 'config/environment/'.Config::get('env').'.php';

// List of files to minify
Config::set('js_files',  ['application.js']);
Config::set('css_files', ['application.css']);

include 'config/secret.php';

// TIME FOR DATABASE
Config::set('mysqltime', "Y-m-d H:i:s");

$domain = (Config::get('env') == 'development') ? 'magazyn.dev' : 'magazyn.info';
Config::set('domain', $domain);

Config::set('package_price', 100.00);

// Shipping prices
Config::set('shipping_prices', ['poczta_polska_cod'=>15.00,
								'personal_collection'=>0.00]);

Config::set('shipping_name', ['ups'=>'Kurier UPS',
							  'ups_cod'=>'Kurier UPS - pobranie',
                        	  'poczta_polska'=>'Poczta Polska Kurier48',
                        	  'poczta_polska_cod'=>'Poczta Polska Kurier48 - pobranie',
                        	  'personal_collection'=>'Odbiór osobisty',
                        	  'free_delivery'=>'Darmowa dostawa']);