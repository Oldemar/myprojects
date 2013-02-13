<?php
App::uses('AppModel', 'Model');
/**
 * Specialty Model
 *
 * @property User $User
 * @property Specialty $ParentSpecialty
 * @property Specialty $ChildSpecialty
 * @property Work $Work
 */
class Specialty extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentSpecialty' => array(
			'className' => 'Specialty',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildSpecialty' => array(
			'className' => 'Specialty',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Work' => array(
			'className' => 'Work',
			'foreignKey' => 'specialty_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	//@TODO: validation
	//public $valiate;
	/**
	 * Transform and Database Array into an array formated for autocomplete helper
	 * @param array $result
	 * @return array
	 */
	function prepareResultsForAutocomplete($result){
		$return = array();
		foreach($result as $key => $value){
			$return[] = array('label'=>utf8_encode($value['Specialty']['name']),'id'=>$value['Specialty']['id']);
		}
		return $return;
	}
	
	
	/**
	 * Search utilized on autocomplete workplace
	 */
	function searchSpecialty($search){
		$cacheName = 'SpecialtySearch'.md5($search);
	
		if(!$result = Cache::read($cacheName,'1 hour')){
			$result = $this->find('all',
					array(
							'recursive'=>0,
							'conditions' => array(
									"Specialty.name LIKE" => "%".$search."%",
							),
							'limit'=>20,
							'order' => array('Specialty.name')
					)
			);
			Cache::write($cacheName, $result,'1 week');
		}
		return $result;
	
	}	

}
