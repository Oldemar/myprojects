<?php
App::uses('OAuthAppModel', 'OAuth.Model');
/**
 * AuthCode Model
 *
 * @property Client $Client
 * @property User $User
 */
class AuthCode extends OAuthAppModel {
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'code';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
			),
		),
		'client_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'redirect_uri' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'expires' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'OAuth.Client',
			'foreignKey' => 'client_id',
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
 * beforeSave method to hash codes before saving
 * 
 * @return boolean 
 */
	public function beforeSave($options = array()) {
		$this->data['AuthCode']['code'] = OAuthComponent::hash($this->data['AuthCode']['code']);
		return true;
	}
	
	public function beforeDelete($options = array()) {
		$this->data['AuthCode']['code'] = OAuthComponent::hash($this->data['AuthCode']['code']);
		return true;
	}
	
	public function delete($data = array()){
		
		if(count($data) > 0){
			
			$this->deleteAll(array('AuthCode.code'=> OAuthComponent::hash($data['auth_code'])));
		}
	}
	
	public function findCodeByUserIdAndUrl($param = array()){
		
		$authcode = $this->find('first', array('conditions'=>array('AuthCode.user_id'=>$param['Client']['user_id'], 'AuthCode.redirect_uri'=> $param['Client']['redirect_uri'])));
		
		if(time() >= $authcode['AuthCode']['expires'] ){

			return null;
		}
		
		return $authcode;
	}
}