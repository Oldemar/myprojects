<?php 

class Location extends appModel {
	public $belongsTo = array(
							'Contact' =>	array('classname' => 'Contact',	'foreignKey' => 'contact_id'),
							'Country' =>	array('className' => 'Country',	'foreignKey' => 'country_id'),
							'Region' =>		array('className' => 'Region',	'foreignKey' => 'state_id'),
							'City' =>		array('className' => 'City',	'foreignKey' => 'city_id')
						);

}
