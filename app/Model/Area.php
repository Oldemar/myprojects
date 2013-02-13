<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 * @property User $User
 * @property Area $ParentArea
 * @property Area $ChildArea
 * @property Journal $Journal
 * @property User $User
 */
class Area extends AppModel {
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
		'ParentArea' => array(
			'className' => 'Area',
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
		'ChildArea' => array(
			'className' => 'Area',
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
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'area_id',
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
		'Interest' => array(
			'className' => 'Interest',
			'foreignKey' => 'area_id',
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'areas_users',
			'foreignKey' => 'area_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	public function getNameToExhibit(){
		if(isset($this->ParentArea->data['Area']['name']) && strlen($this->ParentArea->data['Area']['name']) > 0){
			return $this->ParentArea->data['Area']['name'].' - '.$this->getAttr('name');
		}else{
			return $this->getAttr('name');
		}
	}
	
	public function searchAreasWithParentName($searchTerm,$userId){
	 	$query = "SELECT 
	 				Area.id as id, 
	 				IF(ap.name != '',concat(ap.name, ' - ',Area.name),Area.name) as name 
	 			FROM 
	 				areas Area 
	 			LEFT JOIN  
	 				areas ap on ap.id = Area.parent_id
	 			WHERE 
	 				Area.user_id in (0,".$userId.")
	 			HAVING 
	 				name like '%".$searchTerm."%'
	 			ORDER BY 
	 				name	
	 			";
	 	
	 	$arrReturn = array();
	 	foreach($this->query($query) as $key => $value){
	 		$arrReturn[]['Area'] = array('id'=>$value['Area']['id'],'name'=>$value[0]['name']);
	 	}
	 	return $arrReturn;
	 }
	 
	 /**
	 * Transform and Database Array into an array formated for autocomplete helper
	 * @param array $result
	 * @return array
	 */
	function prepareResultsForAutocomplete($result){
		$return = array();
		foreach($result as $key => $value){
			$return[] = array('label'=>utf8_encode($value['Area']['name']),'id'=>$value['Area']['id']);
		}
		return $return;
	}
	
	public function getArrayRepresentation(){
		$arrReturn = array();
		$arrReturn = $this->data;
		return $arrReturn;
	}
}
