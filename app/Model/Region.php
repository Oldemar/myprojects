<?php

class Region extends AppModel {
	public $name = 'Region';

	public $belongsTo = array('Country' => array('className' => 'Country', 'foreignKey' => 'country_id'));

	public $hasMany = array(
			'Journal' => array(
				'className' => 'Journal', 
				'foreignKey' => 'region_id'
			),
			'RegionBirth' => array(
				'className' => 'Contact', 
				'foreignKey' => 'birth_region_id'
			),
			'RegionRes' => array(
				'className' => 'Contact', 
				'foreignKey' => 'res_region_id'
			),
			'RegionBus' => array(
				'className' => 'Contact', 
				'foreignKey' => 'bus_region_id'
				)
		);
}
?>
