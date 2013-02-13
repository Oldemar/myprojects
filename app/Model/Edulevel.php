<?php
App::uses('AppModel', 'Model');
/**
 * Edulevel Model
 *
 * @property User $User
 * @property Education $Education
 */
class Edulevel extends AppModel {
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Education' => array(
			'className' => 'Education',
			'foreignKey' => 'edulevel_id',
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
			$return[] = array('label'=>utf8_encode($value['Edulevel']['name']),'id'=>$value['Edulevel']['id']);
		}
		return $return;
	}
	
	
	/**
	 * Search utilized on autocomplete workplace
	 */
	function searchEdulevel($search){
		$cacheName = 'EdulevelSearch'.md5($search);
	
		if(!$result = Cache::read($cacheName,'1 hour')){
			$result = $this->find('all',
					array(
							'recursive'=>0,
							'conditions' => array(
									"Edulevel.name LIKE" => "%".$search."%",
							),
							'limit'=>20,
							'order' => array('Edulevel.name')
					)
			);
			Cache::write($cacheName, $result,'1 week');
		}
		return $result;
	
	}
		

}
