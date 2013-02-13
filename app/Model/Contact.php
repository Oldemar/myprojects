<?php

class Contact extends AppModel {
	public $name = 'Contact';

	public $belongsTo = array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
				),
				'ResCountry' => array(
					'className' => 'Country',
					'foreignKey' => 'res_country_id'
				),
				'ResRegion' => array(
					'className' => 'Region',
					'foreignKey' => 'res_region_id'
				),
				'ResCity' => array(
					'className' => 'City',
					'foreignKey' => 'res_city_id'
				),
				'BusCountry' => array(
					'className' => 'Country',
					'foreignKey' => 'bus_country_id'
				),
				'BusRegion' => array(
					'className' => 'Region',
					'foreignKey' => 'bus_region_id'
				),
				'BusCity' => array(
					'className' => 'City',
					'foreignKey' => 'bus_city_id'
				),
				'BirthCountry' => array(
					'className' => 'Country',
					'foreignKey' => 'birth_country_id'
				),
				'BirthRegion' => array(
					'className' => 'Region',
					'foreignKey' => 'birth_region_id'
				),
				'BirthCity' => array(
					'className' => 'City',
					'foreignKey' => 'birth_city_id'
				),
				'City' => array(
						'className' => 'City',
						'foreignKey' => 'city_id',
						'conditions' => '',
						'fields' => '',
						'order' => ''
				)
				
		);

}

?>
