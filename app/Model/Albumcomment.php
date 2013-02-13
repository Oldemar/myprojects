<?php
App::uses('AppModel', 'Model');
/**
 * AlbumComment Model
 *
 * @property Journal $Journal
 * @property User $User
 */
class AlbumComment extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'albumcomments';

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
	

}
