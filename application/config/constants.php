<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('SHA_SECRET',							'raHa5!4');

define('KEY',									'key');
define('LETTER_TYPE',							'letter_type');
define('USER',									'user');
define('USER_TYPE',									'user_type');

/*
define('STATUS_NOTA_PENDING',					1);

define('DB_NAME',								'shop_db');
define('ADDRESS',								'address');
define('BANK_ACCOUNT',							'bank_account');
define('CATEGORY',								'category');
define('CITY',									'city');
define('COUNTRY',								'country');
define('BLOG',									'blog');
define('BLOG_STATUS',							'blog_status');
define('CATALOG',								'catalog');
define('CURRENCY',								'currency');
define('ITEM',									'item');
define('ITEM_CATALOG',							'item_catalog');
define('ITEM_CATEGORY',							'item_category');
define('ITEM_PICTURE',							'item_picture');
define('ITEM_PRICE',							'item_price');
define('ITEM_STATUS',							'item_status');
define('NEWSLETTER',							'newsletter');
define('NOTA',									'nota');
define('PAYMENT_METHOD',						'payment_method');
define('PICTURE',								'picture');
define('PROVINCE',								'province');
define('STATUS_NOTA',							'status_nota');
define('STORE',									'store');
define('STORE_DETAIL',							'store_detail');
define('STORE_IMAGE_SLIDE',						'store_image_slide');
define('STORE_PAYMENT_METHOD',					'store_payment_method');
define('THEME',									'theme');
define('TRANSACTION',							'transaction');

define('USER_STORE',							'user_store');

/*	*/


/* End of file constants.php */
/* Location: ./application/config/constants.php */