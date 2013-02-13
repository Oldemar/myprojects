<?php
App::uses('AppModel', 'Model');
/**
 * Invitation Model
 *
 * @property User $User
 * @property Tablename $Tablename
 */
class Invitation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */


	public $validate = array(
 	   'invited' => array(
 	       'rule'    => array('email'),
 	       'message' => 'Must be a valid email!'
 	   )
	);
		
		


	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public function beforeSave(){

	}
	
	/**
	 * The saveInvitation method saves the sent email.
	 * 
	 * @param String sent email address
	 * @param Obj the User object
	 * @return Boolean true: the data has been saved
	 * 
	 */
	public function saveInvitation($invited = null, $objUser = null){
		
		if(isset($invited)){
			
			$invitation = array('Invitation' => array('id'=> null, 'user_id' => $objUser->getAttr('id'), 'tablename_id' => 3, 'id_value'=>  $objUser->getAttr('id'), 'sent'=>1));
			
			$invitation['Invitation']['invited'] = $invited;

			if(!$this->save($invitation)){
					//@TODO: write in the Logs
			}
		}
	}
}
