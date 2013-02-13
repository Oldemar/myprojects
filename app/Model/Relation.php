<?php
App::uses('AppModel', 'Model');
/**
 * Relation  Model
 *
 */

class Relation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	var $name = "Relation";
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User_A' => array(
			'className' => 'User',
			'foreignKey' => 'profile1_id',
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
		'User_B' => array(
			'className' => 'User',
			'foreignKey' => 'profile2_id',
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
		'Relationship_A' => array(
			'className' => 'Relationship',
			'foreignKey' => 'relationship1_id',
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
		'Relationship_B' => array(
			'className' => 'Relationship',
			'foreignKey' => 'relationship2_id',
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

	
	public function insertFriendInvitationRequest(User $objUserInviting, User $objUserInvited, $relationship1Id=1, $relationship2Id=1, $approved=0){
		$this->create();
		$this->data['Relation']['profile1_id'] = $objUserInviting->getID();
		$this->data['Relation']['profile2_id'] = $objUserInvited->getID();
		$this->data['Relation']['relationship1_id'] = $relationship1Id; 
		$this->data['Relation']['relationship2_id'] = $relationship2Id;
		$this->data['Relation']['approved'] = $approved;
		
		$this->data = $this->save();
		return $this;
	}
	
	public function insertPreAprovedFriendInvitationRequest(User $objUserInviting, User $objUserInvited, $relationship1Id=1, $relationship2Id=1){
		if(!isset($objUserInviting) || !is_object($objUserInviting) || !isset($objUserInvited) || !is_object($objUserInvited)){
			throw new Exception("Bad parameters", 1);
			
		}
		return $this->insertFriendInvitationRequest( $objUserInviting,  $objUserInvited, $relationship1Id, $relationship2Id , 1);
	}
}
