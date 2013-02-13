<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 * @property User $User
 */
class Group extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $compressionRate = 35;


/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'groups_users',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'dependent' => true,
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'GroupsUser' => array(
			'className' => 'GroupsUser',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $validate = array(
			'name' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'You must specify a Group name.',
							'allowEmpty' => false,
							'required' => true,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					)
			),
				
			'user_id' => array(
					'rule'     => 'numeric',
					'required' => true,
					'message'  => 'The user must be selected.',
					'allowEmpty' => false
			)
	);
		
	public function beforeSave(){
	
//	echo "<pre>".print_r($this->data,true)."</pre>";
		$this->create($this->data);
		//if	( (isset($this->data['Group']['imagefile']))  &&  ($this->data['Group']['imagefile'] != null) ) {
			//$this->uploadFile();
			return $this->data;
		//} else return false ;
	}

	protected function uploadFile() {
		$file = $this->data['Group']['imagefile'];
		if ($file['error'] === UPLOAD_ERR_OK) {
			// Resize image
			$tmp = split('\.', $file['name']);
			// Target filename is the time, to the second, with the original file extension.
			$resizeTarget = "grp".date('YmdHis').'.'.$tmp[count($tmp)-1];
			// Perform compression
			$this->compress_image($file['tmp_name'], $resizeTarget, $this->compressionRate);
			// Save image ... was saving as file['name'] ... reworked to use unique identifier
			if (rename($resizeTarget, 'img/'.$resizeTarget)) {
				$this->data['Group']['image'] = $resizeTarget;
//	die("<pre>".print_r($this->data,true)."</pre>");
				return true;
			}
		}

		$this->invalidate('file', 'Failed to upload file');

		return false;
	}
	
	
	function compress_image($source_url, $destination_url, $quality) {
	        $info = getimagesize($source_url);

	        if ($info['mime'] == 'image/jpeg')
	                $image = imagecreatefromjpeg($source_url);
	        elseif ($info['mime'] == 'image/gif')
	                $image = imagecreatefromgif($source_url);
	        elseif ($info['mime'] == 'image/png')
	                $image = imagecreatefrompng($source_url);

	        // save it
	        imagejpeg($image, $destination_url, $quality);

	        // return destination file url
	        return $destination_url;
	}
	
	public function afterSave($created){
		

		$usrgrp = $this->GroupsUser->find('all',array(
									'conditions'=>array('GroupsUser.group_id'=>$this->data['Group']['id']),
									'contain'=>array(
										'User')));
		if ($created) {
			foreach ( $this->data['Group']['userlist'] as $id ) :
				if ($id) {
					$this->data['GroupsUser']['id'] = null;
					$this->data['GroupsUser']['group_id'] = $this->data['Group']['id'];
					$this->data['GroupsUser']['user_id'] = $id ;
					$this->GroupsUser->save($this->data);
				}
			endforeach;
		} else {
			foreach ( $this->data['userlist'] as $id=>$checked ) :
				if ($checked) {
					$isins = 1;
					$isdel= 0;
					foreach ($usrgrp as $usrs):
						if ($usrs['GroupsUser']['user_id'] == $id) {
							$isins = 0;
							break;
						}
					endforeach;
				} else {
					$isins = $isdel = 0;
					foreach ($usrgrp as $usrs):
						if ($usrs['GroupsUser']['user_id'] == $id) {
							$isdel = $usrs['GroupsUser']['id'];
							break;
						}
					endforeach;
				}
				if ($isins) {
					$this->data['GroupsUser']['id'] = null;
					$this->data['GroupsUser']['group_id'] = $this->data['Group']['id'];
					$this->data['GroupsUser']['user_id'] = $id ;
					$this->GroupsUser->save($this->data);
				}
				if ($isdel) {
					$this->GroupsUser->delete($isdel);
				}
			endforeach;

		}
		
	}
	
	public function findGroupById($userId = null){
		
		if(isset($userId)){
			return  $this->findByUserId($userId);
		}
	}
	
	
	public function isInGroup($userId = null){
		
		if(isset($userId)){
			
			
			$isInGroup = $this->GroupsUser->find('list', array('conditions' => array('GroupsUser.user_id' => $userId, 'GroupsUser.group_id' => $this->getAttr('id'))));
			
			return (is_array($isInGroup) && count($isInGroup) > 0);
			
		}
	}
	
	
	public function searchByName($groupName = null, $userId = null){
		
		if(isset($groupName)){
			
			return $this->find('list', array('conditions'=>array('name LIKE '=>'%'.$groupName.'%', 'user_id' => $userId)));
		}
	}
	
	/**
	 * Transform and Database Array into an array formated for autocomplete helper
	 * @param array $result
	 * @return array
	 */
	public function prepareResultsForAutocomplete($groupName = null, $userId = null){
		
		$result = $this->searchByName($groupName, $userId);
		
		$return = array();
		
		foreach($result as $key => $value){
			$return[] = array('label'=>utf8_encode($value),'id'=>$key);
		}
		return $return;
	}

	
	public function listMembers(){
		
		$arrayObjectGroup = $this->GroupsUser->findObjects('all', array( 'conditions' => array('group_id' => $this->getAttr('id')),'order'=>array('User.username')));
		
		if(is_array($arrayObjectGroup) && count($arrayObjectGroup) > 0){
			
			$arrayObjFriend = array();
				
			foreach ($arrayObjectGroup as $key => $objGroup) {
			
				$arrayObjFriend[$key] = $objGroup->User;
			
				$arrayObjFriend[$key]->Contact->loadObject('ResCity');
				$arrayObjFriend[$key]->userStatus = 2;
			
			}			
		}

		return $arrayObjFriend;
	}
	
	public function getGroupIdByName($groupName = null, $userId = null){
		
		if(isset($groupName) && isset($userId)){
			
			return  $this->find('first', array('fields'=>array('Group.id'), 'conditions'=>array('name LIKE '=>'%'.$groupName.'%', 'user_id' => $userId)));
		}
	}
	
	public function getGroupObjById($groupId = null){
		
		if(isset($groupId)){
			
			return  $this->findObjects('all',array('conditions'=>array('Group.id'=>$groupId)),0);
		}
	}
	
	public function findGroupByNameOrId($groupId = null, $groupName = null, $objUser = null){
		
		if(!empty($groupId)){
		
			return $this->findById($groupId);
				
		}
		elseif(isset($groupName) && isset($objUser)){
			
			return $this->findBy('name', $groupName);
			
		}		
		
	}
	
	
	public function editName($name = null){
		
		if (isset($name)){
			
			
			if($this->isUniqueName($name)){
				
				$this->set('name', $name);
				
				return $this->data =  $this->save();
			}
			else{
				
				$this->validationErrors = array( 0 => 'The group name must be unique.');
				
				return false;
			}
			
		}
		
	}
	
	public function isUniqueName($name = null){
		
		if(isset( $name)){
			
			return count($this->find('count', array('conditions'=>array('Group.user_id' => $this->getAttr('user_id'), 'Group.name' => $name, 'Group.id !=' => $this->getAttr('id')))) == 0);
		}
	}
	

	
}

