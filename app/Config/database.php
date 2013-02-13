<?php

class DATABASE_CONFIG {
// office

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '192.168.1.10',
		'login' => 'root',
		'password' => 'alpha2012!',
		'database' => 'living_alpha',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	
	var $amazon_s3 = array(
			'datasource' => 'AmazonS3.AmazonS3',
			'access_key' => 'AKIAJKZMV7O35L7RIWOQ',
			'secret_key' => '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'
	);
	
}
