<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Table $Table
 * @property ParentProfile $ParentProfile
 * @property Picture $Picture
 */
class Participation extends AppModel {

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
}
