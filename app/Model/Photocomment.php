<?php

App::import('Sanitize');
App::uses('AppModel', 'Model');
/**
 * PhotoComment Model
 *
 * @property Journal $Journal
 * @property User $User
 */
class PhotoComment extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'photocomments';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
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
	
	public $validate = array(
				'user_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Invalid User.',
							'allowEmpty' => false,
							'required' => true,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					)
				),
				'photo_id' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Invalid Photo.',
							'allowEmpty' => false,
							'required' => true,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					)
				)
			);
	
	public function getDateCreatedToExhibit(){
		if (CakeTime::isToday($this->getAttr('created'))) {
			return CakeTime::timeAgoInWords($this->getAttr('created'));
		} else {
			if (CakeTime::wasYesterday($this->getAttr('created'))) {
				return 'Yesterday';
			} else {
				return CakeTime::format('h:i | F d, Y', $this->getAttr('created')) ;
			}
		}
	}
	
	public function insertPhotoComment($objPhoto, $objUser, $strComment){
		$data = array();
		$data['PhotoComment']['photo_id'] = $objPhoto->getID();
		$data['PhotoComment']['user_id'] = $objUser->getID();
		$data['PhotoComment']['comment'] = $strComment;
		$this->create($data);
		
		if(!$this->save()){
			$e = new Exception("ValidationError", 1);
			$e->validationErrors = $this->validationErrors;
			
			throw $e;
			
		}else{
			return true;
		}
	}
	
	public function getUsersCommentedOnPhoto($objPhoto){
		$arr = $this->find('all',array('recursive'=>'-1','conditions'=>array('Photocomment.photo_id'=>$objPhoto->getPrimaryId()),'group'=>'Photocomment.user_id'));
			
		$userModel = $this->loadModel('User');
			
		$arrUsers = array();
			
		if(is_array($arr)){
			foreach($arr as $key => $value){
				$arrUsers[] = $userModel->findById($value['Photocomment']['user_id'],array(),0);
			}
		}
			
		return $arrUsers;
	}
}
