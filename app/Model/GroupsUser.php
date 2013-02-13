<?php
App::uses('AppModel', 'Model');
/**
 * GroupsUser Model
 *
 * @property Group $Group
 * @property User $User
 */
class GroupsUser extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
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
	
	/**
	 * @TODO: The message must be used the i18n
	 * @var unknown_type
	 */
	public $validate = array(

			'user_id' => array(
					'rule'     => 'numeric',
					'required' => true,
					'message'  => 'The user must be selected.',
					'allowEmpty' => false
			),
			'group_id' => array(
					'rule'     => 'numeric',
					'required' => true,
					'message'  => 'The user must be selected.',
					'allowEmpty' => false
			),
				
	
	);
}
