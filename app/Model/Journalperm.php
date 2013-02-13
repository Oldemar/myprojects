<?php
App::uses('AppModel', 'Model');
/**
 * Journalperm Model
 *
 */
class Journalperm extends AppModel {
	
	public $belongsTo = array(
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}