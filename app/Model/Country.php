<?php

class Country extends appModel {
	public $name = 'Country';

	public $hasMany = array(
			'Journal' => array(
				'className'=>'Journal',
				'foreingKey' =>'country_id'
			),
			'CountryBirth' => array(
				'className' => 'Contact', 
				'foreignKey' => 'birth_country_id'
			),
			'CountryRes' => array(
				'className' => 'Contact', 
				'foreignKey' => 'res_country_id'
			),
			'CountryBus' => array(
				'className' => 'Contact', 
				'foreignKey' => 'bus_country_id'
				)
		);
}
?>
