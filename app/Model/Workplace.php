<?php
App::uses('AppModel', 'Model');
/**
 * Workplace Model
 *
 * @property Work $Work
 */
class Workplace extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	/**
	 * @TODO: validate rule
	 */
	/*
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'location' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Work' => array(
			'className' => 'Work',
			'foreignKey' => 'workplace_id',
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
	
	
	/**
	 * Transform and Database Array into an array formated for autocomplete helper
	 * @param array $result
	 * @return array
	 */
	function prepareResultsForAutocomplete($result){
		$return = array();
		foreach($result as $key => $value){
			$return[] = array('label'=>utf8_encode($value['Workplace']['name']),'id'=>$value['Workplace']['id']);
		}
		return $return;
	}	

	
	/**
	 * Search utilized on autocomplete workplace
	 */
	function searchWorkplace($search){
		$cacheName = 'WorplaceSearch'.md5($search);
	
		if(!$result = Cache::read($cacheName,'1 hour')){
			$result = $this->find('all',
					array(
							'recursive'=>0,
							'conditions' => array(
									"Workplace.name LIKE" => "%".$search."%",
							),
							'limit'=>20,
							'order' => array('Workplace.name')
					)
			);
			Cache::write($cacheName, $result,'1 week');
		}
		return $result;
	
	}
	
}
