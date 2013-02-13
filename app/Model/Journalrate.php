<?php
App::uses('AppModel', 'Model');
/**
 * Journalrate Model
 *
 * @property Journal $Journal
 * @property User $User
 */
class Journalrate extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function rateSave($data) {
		
		die("<pre>Save Rating <br>".print_r($this->data,true)."</pre>") ;
		return TRUE;

	}

}
