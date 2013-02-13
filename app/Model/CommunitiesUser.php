<?php
App::uses('AppModel', 'Model');
/**
 * CommunitiesUser Model
 *
 * @property Community $Community
 * @property User $User
 */
class CommunitiesUser extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Community' => array(
			'className' => 'Community',
			'foreignKey' => 'community_id',
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
