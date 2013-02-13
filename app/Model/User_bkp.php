<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Table $Table
 * @property ParentProfile $ParentProfile
 * @property Picture $Picture
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	var $name = "User";
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must specify a user name.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule'=>'isUnique',
				'message' => 'This username has been taken.'
			)
		),
		'firstname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'password' => array(
				'rule' => array('minLength', 6),
				'message' => 'The Password must be at least 6 characters.'
				
			)
		),
		'password_confirm' => array(
			'password_confirm' => array(
				'rule' => 'matchPasswords',
				'message' => 'Passwords do not match.'

			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
						'Contact' =>	array('className' => 'Contact',		'foreignKey' => 'user_id',		'dependant' => 'true'),
						'Relation' =>	array('className' => 'Relation',	'foreignKey' => 'profile1_id'),
						'Relation' =>	array('className' => 'Relation',	'foreignKey' => 'profile2_id')
					);


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'user_id',
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
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
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
		'Community' => array(
			'className' => 'Community',
			'foreignKey' => 'user_id',
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
		'Education' => array(
			'className' => 'Education',
			'foreignKey' => 'user_id',
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'user_id',
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
		'Invitation' => array(
			'className' => 'Invitation',
			'foreignKey' => 'user_id',
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
			'foreignKey' => 'user_id',
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
		'Journalrate' => array(
			'className' => 'Journalrate',
			'foreignKey' => 'user_id',
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
		'Picture' => array(
			'className' => 'Picture',
			'foreignKey' => 'user_id',
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
		'Specialty' => array(
			'className' => 'Specialty',
			'foreignKey' => 'user_id',
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
		'Work' => array(
			'className' => 'Work',
			'foreignKey' => 'user_id',
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
		'Relation_A' => array(
			'className' => 'Relation',
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
		'Relation_B' => array(
			'className' => 'Relation',
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
		'GroupsUser' => array(
			'className' => 'GroupsUser',
			'foreignKey' => 'user_id',
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
		'Albumcomment' => array(
			'className' => 'Albumcomment',
			'foreignKey' => 'user_id',
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

	public $belongsTo = array(
		'Picture' => array(
			'className' => 'Picture',
			'foreignKey' => 'picture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

	function matchPasswords($data) {
		if ($this->data['User']['password'] == $this->data['User']['password_confirm']){
			return TRUE;
		}
		return FALSE;
		
	}

	function hashPasswords($data) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);
			return $data;

		}
		return $data;
	}


	function beforeSave() {
		$this->hashPasswords(NULL);
		if ($this->data['User']['picture_id'] == null)
			$this->data['User']['picture_id'] = $this->data['User']['gender'];
		return TRUE;
	}

	public function updateAll($data){
		$this->create($data);
		return $this->saveAll($this->data);

	}

	public function search() {
//		$term = $_POST['data']['User']['q'];
//		$this->set('results', $this->find('name like '.$this->data['Post']['q']));
//		print('<pre>data:'.print_r($this->data,true).' results:'.print_r($this->results, true).' params:'.print_r($this->params,true).' request:'.print_r($this->request,true).' post:'.print_r($_POST,true).'</pre>');
//		print("<pre>term: {$term}</pre>");
//		$result = $this->find('all', array('conditions'=>"firstname like '%{$term}%' OR lastname like '%{$term}%'"));
//		print('Result: '.($result ? '<pre>'.print_r($result,true).'</pre>' : 'none found'));
//		$this->set('results', $this->find('all', array('conditions'=>"firstname like '%{$term}%' OR lastname like '%{$term}%'")));
//		$this->set('results', $result);
	}


}
