<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Table $Table
 * @property ParentProfile $ParentProfile
 * @property Picture $Picture
 */
class Share extends AppModel {

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

/**
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' =>'email',
				'message' => 'You must provide a valid email address.',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'user_id' => array(
						'rule'     => 'numeric',
						'required' => true,
						'message'  => 'The user must be selected.',
						'allowEmpty' => false
				),
			
		
		
	);
	
	function beforeSave() {
//		die("<pre>".print_r($this->data,true)."</pre>");
	}
	
	function afterSave() {
//		die("<pre>".print_r($this->data,true)."</pre>");
	}
	
	
	/**
	 * The add methods save the Share record
	 * 
	 * @param array $dataShare array('user_id','journal_id','email')
	 * 
	 * @TODO: create the exceptions
	 * 
	 */
	public function add($dataShare = null){
		
		if(is_array($dataShare) && count($dataShare) > 0){
			
			$data['Share'] = $dataShare;
			
			$this->create();
			
			$this->set($data);
			
				
			if(!$this->save()){
					
				//@TODO: throw the exception
				
				return false;
			}
			
		}
		
		return true;
	}
	
}
