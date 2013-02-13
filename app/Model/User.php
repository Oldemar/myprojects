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

	//The captcha virtual field will be validated through the Validate process in the Model
	//This would take value in the UserController->add method
	public $virtualFields = array('captcha' => 0);
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'username' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'You must specify a Username.',
							'allowEmpty' => false,
							'required' => true,
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
							'message' => 'You must provide your first name.',
							'allowEmpty' => false,
							'required' => true,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					)
			),
			'lastname' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'You must provide your last name.',
							'allowEmpty' => false,
							'required' => true,
							//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	)
	),

	'email' => array(
	'email' => array(
	'rule' =>'email',
	'message' => 'You must provide a valid email address.',
	'allowEmpty' => false,
	'required' => true
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	)
	),
	'captcha' => array(
	'notempty' => array(
	'rule' => array('notempty'),
	'message' => 'You must provide the correct answer (It is for Captcha).',
	'allowEmpty' => false,
	'required' => true,
	),
	'comparison' => array(
	'rule' => array('comparison', '>', 0),
	'message' => 'Wrong answer.',
	'on'         => 'create'
	)

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
	'message' => 'The password doesn\'t match!.'

	)
	),

	'agreement' => array(
	'rule' => array('comparison', 'equal to', 'Y'),
	'required' => true,
	'message' => 'You must agree with our Terms and Conditions and Privacy Policy.'
	)

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasOne associations
	 *
	 * @var array
	 */
	public $hasOne = array(

			'Contact' =>	array(
					'className'	 => 'Contact',
					'foreignKey' => 'user_id',
					'dependant'	 => 'true'
			),
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
			),
			'Participation' => array(
			'className' => 'Participation',
			'foreignKey' => 'user_id',
			'dependent' => true,
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
					),
					'Tutor' => array(
							'className' => 'User',
							'foreignKey' => 'tutor_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
					)
			);
			
			/**
			 * 
			 * 0 - No Friend (DB: there is not record)
			 * 1 - Pending Friend (DB: the approved field is NULL)
			 * 2 - Friend (DB: the approved field is 1)
			 * 3 - Denied Friend (DB: the approved field is 0)
			 * 
			 */
			public $userStatus = NULL;


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
				return TRUE;
			}


			public function afterSave($created){
				if ($created){
					$this->data['Contact']['user_id'] = $this->data['User']['id'];
					$this->Contact->save($this->data);

				}

				return;

			}

			/**
			 * Creates and return an User Object with its basic informations BY THE ID
			 * @param User.id $id
			 * @return boolean|User
			 */
			public function getUserById($id){
				if(!$id){
					return false;
				}

				$result = $this->find('first',array('recursive'=>'0','conditions'=>array('User.id'=>$id)));

				if($result){
					$objUser = $this->loadModel('User');
					$objUser->data = $result;
					$objUser->id = $result['User']['id'];
					return $objUser;
				}
				return false;
			}

			/**
			 * Creates and return an User Object with its basic informations BY THE E-mail
			 * @param User.email $email
			 * @return boolean|User
			 */
			public function getUserByEmail($email){
				$result = $this->find('first',array('recursive'=>'0','conditions'=>array('User.email'=>$email)));

				if($result){
					$this->data = $result;
					$this->id = $result['User']['id'];
					return $this;
				}
				return false;
			}

			/**
			 * Creates and return an User Object with its basic informations BY THE Username
			 * @param User.username $username
			 * @return boolean|User
			 */
			public function getUserByUsername($username){
				$result = $this->find('first',array('recursive'=>'0','conditions'=>array('User.username'=>$username)));

				return $this->buildObject($result,1);
			}

			/**
			 * Send the email in which the user can change his password in case he has forgoten
			 * @param none
			 * @return boolean
			 */
			public function sendForgotPasswordEmail(){
				$email = $this->data['User']['email'];



				if(!$email){
					return false;
				}

				$objEmail = new CakeEmail('smtp');
				$objEmail->template('forgot_password', 'default')
				->emailFormat('html')
				->to($email);

				$objEmail->subject('Reset your password');

				$hash['user_id'] 			= $this->data['User']['id'];
				$hash['date_generated'] 	= date('YmdHi');

				$objEmail->viewVars(array('hash' => $this->myUrlEncode($this->myEncode($hash)), 'image'=> $this::urlToWebrootImg().'Email_Banner.png',
						'objUser'=>$this));

				if($objEmail->send()){
					return true;
				}
				return false;

			}

			/**
			 * Send an e-mail with a list of usernames associated with the email on the instance of the object
			 * @param none
			 * @return bool if the e-mail has been sent
			 */
			public function sendForgotUsernameEmail(){
				$result	=	$this->find('all',array(
						'recursive'=>-1,
						'conditions'=> array(
								'email'=>$this->getAttr('email')
						)
				)
				);

				$arrUser = $this->buildObjectList($result,0);

				$arrUsername = array();
				foreach($arrUser as $key => $value){
					$arrUsername[] = $value->getAttr('username');
				}

				$objEmail = new CakeEmail('smtp');

				$objEmail->template('forgot_username', 'default')
				->emailFormat('html')
				->to($this->getAttr('email'));

				$objEmail->subject('Username recovery');

				$objEmail->viewVars(array('arrUsername' => $arrUsername, 'image'=> $this::urlToWebrootImg().'Email_Banner.png', 'objUser'=>$this));

				if($objEmail->send()){
					return true;
				}
				return false;

			}


			/**
			 * Send an e-mail to the user notifying him that his password has been changed
			 * @param none
			 * @return boolean
			 */
			public function notifyPasswordChange($fbUser = false){
				$objEmail = new CakeEmail('smtp');
				
				if($fbUser){
					
					$template = 'password_facebook_notification';
				}
				else{
					
					$template = 'password_change_notification';
				}

				$objEmail->template($template, 'default')
				->emailFormat('html')
				->to($this->data['User']['email']);

				$objEmail->subject(__('Your password has been changed'));

				$hash['user_id'] 			= $this->data['User']['id'];
				$hash['date_generated'] 	= date('YmdHi');
				$hash['delay']				= 1440;

				$objEmail->viewVars(array('obj' => $this, 'hash' => $this->myUrlEncode($this->myEncode($hash)), 'image'=> $this::urlToWebrootImg().'Email_Banner.png'));

				if($objEmail->send()){
					return true;
				}
				return false;
			}

			/**
			 * Update the User's password
			 * @param $newPassword
			 * @return boolean
			 */
			public function setNewPassword($newPassword){
				$this->data['User']['password'] = $newPassword;
				if(!$this->validates()){
					return false;
				}

				//$this->hashPasswords('');

				$tmp = $this->data['User'];
				if($this->save()){
					$this->data['User'] = $tmp;
		  	$this->notifyPasswordChange();
		  	return true;
				}

				return false;
			}

			/**
			 * Check if the password in the parameter is the UserObject's password
			 * @param $password Password to check
			 * @return boolean
			 */
			public function checkPasswordForUser($password){
				if(!$this->data['User']['password'] || !$password){
					return false;
				}


				if(Security::hash($password, NULL, TRUE) == $this->data['User']['password']){
					return true;
				}
				return false;
			}

			/**
			 * Update an e-mail to the User with a Token that he needs to change his password
			 * @param none
			 * @return boolean
			 */
			public function sendEmailWithToken(){
				$objEmail = new CakeEmail('smtp');


				$objEmail->template('password_change_token', 'default')
				->emailFormat('html')
				->to($this->data['User']['email']);

				$objEmail->subject('Password change Token');

				$token = ClassRegistry::init('Token');
				$t = $token->getSixDigitToken($this->data['User']['id']);

				$objEmail->viewVars(array('token' => $t, 'obj'=> $this, 'image'=> $this::urlToWebrootImg().'Email_Banner.png'));

				if($objEmail->send()){
					return true;
				}
				return false;
			}

			public function sendActivationEmail(){
				$objEmail = new CakeEmail('smtp');
				$objEmail->template('activation', 'default')
				->emailFormat('html')
				->to($this->getAttr('email'))
				->subject('Living Alpha Account Activation');

				/**
				 * @TODO: Refactor this
				 */
				$hash = $this->myUrlEncode($this->myEncode(array('user_id'=>$this->getAttr('id'))));

				$objEmail->viewVars(array(
						'hash' =>  $hash,
						'image'=> $this::urlToWebrootImg().'Email_Banner.png',
						'objUser' => $this
				));

				if($objEmail->send()){
					return true;
				}else{
					return false;
				}
			}
			

			/**
			 * The getShortName return the fistname + frist character of the last name.
			 * The max length is 16 characters.
			 *
			 * @return String Fistname and Initial Lastname
			 */
			public function getShortName(){

				return substr($this->getAttr('firstname')." ".substr($this->getAttr('lastname'), 0, 1), 0, 16);
			}
			/**
			 * Upload profile picture for user. It doesn't make the picture the default for the user profile. To do that use another method.
			 */
			public function uploadPictureToUser($params){
				return $this->Picture->uploadPictureForUser($this,$params);
			}

			/**
			 * Basicaly it updates the user setting the picture_id to the id on the object picture.
			 */
			public function setDefaultPicture($objPicture){
				if($objPicture->getPrimaryId()){
					$oldData = $this->data;
					if($d = $this->saveField('picture_id',$objPicture->getPrimaryId())){
						$oldData['User']['picture_id'] = $objPicture->getPrimaryId();
						$this->data = $oldData;
						
						$this->data['User']['picture_id'] = $objPicture->getPrimaryId();
						return true;
					}
				}
				return false;
			}

			/**
			 * Activate the user changing his status to 1
			 */
			public function activate(){
				if($this->getID()){
					$this->data['User']['active']='1';
					if($this->saveField('active','1')){
						return $this->saveField('activate',date('Y-m-d'));
					}
				}

				return false;

			}

			/**
			 * Returns true if the user is active
			 * Returns false if not
			 */
	  public function checkIsActive(){
	  	if($this->getAttr('active') == '1'){
	  		return true;
	  	}else{
	  		return false;
	  	}
	  }

	  /**

	  * Returns the name of the folder that is used to put all uploads related to the user
	  * To get the complete path concatenate Picture::getPathToUploadFolder().getUploadFolderName
	  */
	  public function getUploadFolderName($userId = ''){
	  	if(!$userId){
	  		if(!($userId = $this->getID())){
	  			if(!($userId = $this->getAttr('id'))){
	  				return false;
	  			}
	  		}
	  	}
	  	 
	  	if(is_numeric($userId) && $userId){

	  		if(isset($this) && isset($this->uploadFolderName) && $this->uploadFolderName){
	  			return $this->uploadFolderName;
	  		}else{
	  				
	  			$uploadFolderName =  md5(md5($userId).'alpha').'/';
	  				
	  			if(isset($this)){
	  				$this->uploadFolderName = $uploadFolderName;
	  			}
	  				
	  			return $uploadFolderName;
	  		}

	  	}else{
	  		return false;
	  	}

	  }


	  /**
	   *
	   **/
	  public function getProfileImagePath($sizeName,$userId=''){
	  	if(!$userId){
	  		if(!($userId = $this->getID())){
	  			if(!($userId = $this->getAttr('id'))){
	  			}
	  		}
	  	}
	  	 
	  	if(!$this->data && $userId){
	  		$objUser = $this->findById($userId,array(),0);

	  	}else{
	  		$objUser = $this;
	  	}
	  	 
	  	if(!is_object($objUser)){
	  		return false;
	  	}
	  	 
	  	if(!is_object($objUser->Picture) || (isset($objUser->Picture) && !$objUser->Picture->data)){
	  		$this->loadModel('Picture');
	  		if($objUser->getAttr('picture_id')){
	  			$objUser->Picture = $this->Picture->findById($objUser->getAttr('picture_id'));
	  		}
	  	}
	  	 
	  	 
	  	$objPicture = $objUser->Picture;
	  	 
	  	if(is_object($objPicture)){
		  	$tmpPath = Picture::getPathToUploadFolder().$objPicture->getAttr('url');
		  	$picturePath = $tmpPath.$objPicture->getAttr($sizeName);
		}
	  	 
	  	if(!@$objPicture->data){
	  		if($objUser->getAttr('gender') == 1){
	  			$objPicture = $this->loadModel('Picture');
	  			$objPicture = $objPicture->findById(1);
				//$sizeName='name';
	  		}elseif($objUser->getAttr('gender') == 2){
	  			$objPicture = $this->loadModel('Picture');
	  			$objPicture = $objPicture->findById(2);
				//$sizeName='name';
	  		}else{
	  			$objPicture = false;
	  		}
	  		$tmpPath = '';
	  	}
	  	
	  	 
	  	if($objPicture == false || (is_object($objPicture) && count($objPicture->getAttr($sizeName)) == 0)){
	  		return Configure::read('IMG_URL','/img/').'nopicavble.jpg';
	  	}else{
	  		if($objPicture->getAttr($sizeName)){
	  			$picturePath = $objPicture->getAttr('url').$objPicture->getAttr($sizeName);
			}else{
				$picturePath = $objPicture->getAttr('url').$objPicture->getAttr('name');
			}
	  	}
	  	 
	  	 
	  	
		return $picturePath;
	  	
	  	 
	  	 
	  }

	/**
	  * Returns the Full name according to the permition
	  * 
	  * @param int perm: 0: private; 1: friend; 2:global
	  *
	  * @return String fullname
	  */
	  public function getFullname($perm = 2){

	  	$fullname[] = ($this->getAttr('pfirstname') >= $perm )	?$this->getAttr('firstname'):'';
	  	$fullname[] = ($this->getAttr('plastname') 	>= $perm )	?$this->getAttr('lastname'):'';
	  	
	  	return implode(" ", $fullname);
	  	
	  }
	  

	  /**
	   * The urlToWebrootImg static method fixe the bug of the Cakephp 2.1. The Helpers can not reached in the CakeEmail template
	   * This is the email template image
	   * 
	   * @TODO: update cakephp to 2.2.4
	   *
	   * @return String URL to webroot.img
	   *
	   */
	  static function urlToWebrootImg(){
	  	 
	  	return 'http://'.$_SERVER['SERVER_NAME'].'/'.Router::url('/').'/img/';
	  }

	  /**
	   * The inviteFriends method sends the email to the entered friends of the users
	   *
	   * @return Boolean true if the email was sent.
	   */
	  public function inviteFriends($bbc = array()){

	  	if(is_array($bbc) || count($bbc) > 0){
	  		$this->loadModel('Invitation');


	  		foreach ($bbc as $value) {

	  			$objEmail = new CakeEmail('smtp');
	  			$objEmail->template('invite_friends', 'default')
	  			->emailFormat('html');

	  			$objEmail->viewVars(array(
	  					'image'	=> $this::urlToWebrootImg().'Email_Banner.png',
	  					'from'	=> $this->getFullname(),
	  					'user_id_who_invited' => $this->myUrlEncode($this->myEncode($this->getID()))
	  			));

	  			$objEmail->subject($this->getAttr('firstname').' would like you to join LivingAlpha');

	  			$objEmail->to($value);

	  			if($objEmail->send()){

	  				unset($objEmail);
	  				$this->Invitation->saveInvitation($value, $this);

	  			}
	  		}
	  		return true;
	  	}

	  	return false;

	  }
	   
	  public function shareJournal($to = null, $journalId = null){

	  	if((is_array($to) && count($to) > 0) && isset($journalId)){
	  		
	  		$dataShare['user_id'] 		= $this->getAttr('id');
	  		$dataShare['journal_id']	= $journalId;
	  		
	  		$share = $this->loadModel('Share');
	  		
	  		$objJournal = $this->Journal->findById($journalId,array(),0)
	  		->loadObject('Area');
	  		
	  		/**
	  		 * Security Check
	  		 */
	  		if($objJournal->getAttr("user_id") != $this->getID()){
	  			throw new ForbiddenException('User trying to share a journal without permission.');
	  		}
	  		
	  		foreach ($to as $value) {
	  			
	  			$dataShare['email']			= $value;
	  			
		  		if($share->add($dataShare)){
		  			

			  			$objEmail = new CakeEmail('smtp');
			  			$objEmail->template('share_journal', 'default')
			  			->emailFormat('html');
			  			
			  			$objEmail->viewVars(array(
			  					'image'			=> $this::urlToWebrootImg().'Email_Banner.png',
			  					'objUser'		=> $this,
			  					'objJournal'	=> $objJournal,
			  					'shareId'		=> $share->getInsertID()
			  			));
			  			
			  			$objEmail->subject($this->getAttr('firstname').' would like you to share a Journal with you');
			  			
			  			$objEmail->to($value);
			  			
			  			if($objEmail->send()){
			  					
			  				unset($objEmail);
			  					
			  			}
			  			
			  			//@TODO: throw exception
		  			}
	  			
	  		}
	  		
	  		return true;
	  		
	  	}
	  	else{
	  		
	  		return false;
	  		//@TODO: throw the exception
	  	}
	  }
	
	/**
	 * Return an array of Group that the user is part of
	 */
	public function listGroupsUserBelongsTo(){
		$arrGroupRelation = $this->GroupsUser->find('all',array(
									'recursive'=>-1,
									'conditions'=>array('GroupsUser.user_id'=>$this->getID())
									)
							);
		if(!is_array($arrGroupRelation) || count($arrGroupRelation) == 0){
			return false;
		}					
		
		$arrGroupId = array();
		foreach($arrGroupRelation as $key => $value){
			$arrGroupId[] = $value['GroupsUser']['group_id'];
		}

		$objGroup = $this->loadModel('Group');
		return $objGroup->findObjects('all',array('conditions'=>array('Group.id'=>$arrGroupId)),0);
	}

	/**
	 * Return an array of Groups that the user have
	 */
	public function listGroupsByUser(){
		$objGroup = $this->loadModel('Group');
		return $objGroup->findObjects('all',array('conditions'=>array('Group.user_id'=>$this->getID())),0);
	}
	
	/**
	 * Return an array of Group that the ObjUser on parameter belongs to of the This(User)
	 */
	function getMyGroupsUserBelongs($objUser){
		if($this->getMyGroupsUserBelongs === null){
			$groupsOfThisUser = $this->listGroupsByUser();
			$groupsUserBelongs = $objUser->listGroupsUserBelongsTo();
			
			$arrReturn = array();
			
			foreach($groupsOfThisUser as $key => $value){
				if(is_array($groupsUserBelongs)){
					foreach($groupsUserBelongs as $k => $v){
						if($v->getID() == $value->getID()){
							$arrReturn[] = $value;
						}
					}
				}
			}
			$this->getMyGroupsUserBelongs = $arrReturn;
		}
		return $this->getMyGroupsUserBelongs;
	}
	
	public function findFriend($term = null, $perm = 2){
		
		if(isset($term)){
			
			$firstresult = $this->findObjects('all',array(
					'conditions'=> array(
							'AND'=>array(
									'User.id !='=>$this->id,
									'User.tutor_id'=>null),
							'OR'=>array(array('AND'=>array('User.pfirstname'=>$perm,'User.firstname LIKE'=>"%{$term}%")),
										array('AND'=>array('User.plastname'=>$perm,'User.lastname LIKE '=>"%{$term}%")),
										array('AND'=>array('User.pusername'=>$perm,'User.username LIKE '=>"%{$term}%")),
										array('AND'=>array('User.pemail'=>$perm,'User.email LIKE '=>"%{$term}%"))
											)),
											'order'=> array('User.username ASC')
											)
											);
			
			return $firstresult;
			
		}
		
		return null;
	}
	
	/**
	 * 
	 * @TODO: rewrite the method
	 * 
	 * @param inter $friendId
	 * 
	 * @return boolean True is the friendId is 
	 */
	public function isFriend($friendId = null){
		
		$this->findFriendStatus($friendId);
		
		return ($this->userStatus == 2);
	}
	

	public function listFriend( $arrConditions = array()){

		if(!isset($arrConditions['buildBelongs'])){
			$arrConditions['buildBelongs'] = 1;
		}
		
		$friends = $this->find('first',
				array(
						'conditions' => array('User.id' => $this->id),
						'contain' => array(
								'Relation_A' => array(
										'User_A',
										'User_B'
								),
								'Relation_B' => array(
										'User_A',
										'User_B'
								)
						)
				)
		);
		
		
		$friendlist = array();
		
		foreach ($friends['Relation_A'] as $friend) :
		if ($friend['approved']) {
			$friendlist[] = $this->findById($friend['User_B']['id'],array(),$arrConditions['buildBelongs']) ;
		}
		
		endforeach;
		foreach ($friends['Relation_B'] as $friend) :
		
		if ($friend['approved']) {
			$friendlist[] = $this->findById($friend['User_A']['id'],array(),$arrConditions['buildBelongs']) ;
		}
		
		endforeach;
		
		return $friendlist;
	}

	/*
	* Invite another User to become friend
	* @param: $objUset who you want to add as a Friend
	**/
	public function inviteFriend(User $objUser){
		if($this->isFriend($objUser->getID())){
			throw new Exception("Already friends.");
		}	
		
		if($return = $this->addFriendInvitation($objUser)){
			/**
			* @Todo: Send e-mail requesting to become friend
			**/
			return $return;
		}else{
			return false;
		}
	}
	
	/**
	* Add friend invitation to the database
	* @param: $objUset who you want to add as a Friend
	**/
	public function addFriendInvitation(User $objUser){
		return $this->Relation->insertFriendInvitationRequest($this, $objUser);
	}
	
	
	/**
	* Make two Users Friends without aproval or invitation e-mail
	* @param: $objUset who you want to add as a Friend
	*/
	public function addFriend(User $objUser){
		$objRelation = $this->loadModel('Relation');
		if($this->isFriend($objUser->getID())){
			throw new Exception("Already friends.");
		}
		return $objRelation->insertPreAprovedFriendInvitationRequest($this, $objUser);
	}
	


	public function findFriendStatus($userId){
		
		$Relation = $this->loadModel('Relation');
		
		$relation =  $Relation->find('first', array(	'conditions'=>array('AND'	=>array(
										'OR' => array('profile1_id' => $this->id, 'profile2_id' => $this->id)), 
										'OR' => array('profile1_id' => $userId, 'profile2_id' => $userId)),
										'fields' => array('Relation.approved')));
		if(!is_array($relation)){
			
			$this->userStatus = 0;
		}
		else{
			
			//@TODO: denied status is not completed. In this moment the denied and still not approved status are combined.
			if(is_null($relation['Relation']['approved']) || $relation['Relation']['approved'] == 0){
				
				$this->userStatus = 1;
			}
			else{
				
				$this->userStatus = 2;
			}
			
		}
		
		return $this->userStatus;
		
	}

	/**
	* Insert a new city to the User.
	* The new city keeps the user_id on the record.
	**/
	public function insertCity($cityName,$regionId=null){
		$objCity = $this->loadModel('City');
		$objCity->create();
		$objCity->data['City']['name'] = $cityName;
		$objCity->data['City']['country_id'] = '0';
		$objCity->data['City']['region_id'] = ($regionId == null ? 0 : $regionId);
		$objCity->data['City']['user_id'] = $this->getID();
		$objCity->data = $objCity->save();
		return $objCity;
		
	}
	
	public function listFriendsByAlphabetic($ini = null){
		
		$arrayObjFriend = $this->listFriend();
		
		$arrayObjFriendFiltered = array();
		
			
		foreach ($arrayObjFriend as $key => $value) {
		
				
			$arrayObjFriend[$key]->Contact->loadObject('ResCity');
			//$arrayObjFriend[$key]->findFriendStatus($this->objLoggedUser->getAttr('id'));
				
			if(!empty($ini)){
				if( strtolower(substr($arrayObjFriend[$key]->getAttr('username'), 0, 1)) == strtolower($ini)){
		
					$arrayObjFriendFiltered[$key] = $arrayObjFriend[$key];
				}
			}
			else{
		
				$arrayObjFriendFiltered[$key] = $arrayObjFriend[$key];
			}
		}	

		return $arrayObjFriendFiltered;
	}
	
	/**
	 * Find all users and filter the searching by permit access
	 * 
	 */
	public function findUsers($term = null){

		
		if(isset($term)){
			$perm = 1;
			$firstresult = $this->findObjects('all',array(
					'conditions'=> array(
							'AND'=>array(
									'User.id !='=>$this->id,
									'User.tutor_id'=>null),
							'OR'=>	array('User.firstname LIKE'=>"%{$term}%",'User.lastname LIKE '=>"%{$term}%",'User.username LIKE '=>"%{$term}%",'User.email LIKE '=>"%{$term}%"
									)),
							'order'=> array('User.username ASC')
							)
							);
			
			//$this->debugSQL();
					
			foreach ($firstresult as $key => $objUser) {
				
				if(		(	$this->isFriend($objUser->getAttr('id')) &&  
							(($objUser->getAttr('pfirstname') == 1 	&& strpos(strtolower($objUser->getAttr('firstname')), strtolower($term)) 	!== false) 
						||  ($objUser->getAttr('plastname') == 1 	&& strpos(strtolower($objUser->getAttr('lastname')), strtolower($term)) 	!== false)
						||  ($objUser->getAttr('pusername') == 2  	&& strpos(strtolower($objUser->getAttr('username')), strtolower($term)) 	!== false) 
						||  ($objUser->getAttr('pemail')    == 1 	&& strpos(strtolower($objUser->getAttr('email')), strtolower($term)) 		!== false) ))
						
						||
						
						(	!$this->isFriend($objUser->getAttr('id')) &&  
							(($objUser->getAttr('pfirstname') == 2 	&& strpos(strtolower($objUser->getAttr('firstname')), strtolower($term)) 	!== false) 
						||  ($objUser->getAttr('plastname') == 2 	&& strpos(strtolower($objUser->getAttr('lastname')), strtolower($term)) 	!== false)
						||  ($objUser->getAttr('pusername') == 2  	&& strpos(strtolower($objUser->getAttr('username')), strtolower($term)) 	!== false) 
						||  ($objUser->getAttr('pemail')    == 2 	&& strpos(strtolower($objUser->getAttr('email')), strtolower($term)) 		!== false) ))
							
						){
					
					$arrayFriend[] = $objUser;
				}
			}
				
			return $arrayFriend;
				
		}
		
		return null;
		
	}
	
	public function getEmail($perm = 2){
		
		return ($this->getAttr('pemail') >= $perm )	?$this->getAttr('email'):'';
	}
	
	
	public function findByFacebookId($facebook_id = null){
		
		if(isset($facebook_id)){
			
			return $this->findBy('facebook_id', $facebook_id);
		}
	}
	
	/**
	 * Returns an object array with the same email address.
	 * 
	 * @param String $email
	 * @return Ambigous <Model, AppModel, boolean, multitype:Ambigous <Model, AppModel> >
	 */
	public function listByEmail($email = null){
		
		if(isset($email)){
			
			return $this->findBy('email', $email, 'all');
		}
	}
	
	/**
	 * Returns the objUser object
	 * 
	 * @param String $email
	 */
	public function findByEmail($email = null){
		
		if(isset($email)){
			
			$arrayObjUser = $this->listByEmail($email);
			
			$countArrayObjUser = count($arrayObjUser);
			
			if($countArrayObjUser == 1) return $arrayObjUser[0];
			
			return $countArrayObjUser;
		}
	}
	
	/**
	 * Finds the user based on the email and/or username
	 * 
	 * @param String $username
	 * @param String $email
	 */
	public function findUserByEmailOrUsername($user = null){
		
		if(isset($user)){
			
			$objUser = $this->getUserByUsername($user);
			
			if(is_object($objUser) && (is_array($objUser->data['User']) && count($objUser->data['User']) > 0)) return $objUser;
		}
		
		if(isset($user)){
			
			$objUser = $this->findByEmail($user);
			
			if(is_object($objUser)) return $objUser;
			
		}
		
		return null;
	}
	
	public function sendExternalSignUpConfirmation($oAuth = null){
		
		$objEmail = new CakeEmail('smtp');
		$objEmail->template('external_signup_confirmation', 'default')
		->emailFormat('html')
		->to($this->getAttr('email'))
		->subject('Living Alpha Account Activation from '.$oAuth[0]);
	
		/**
		 * @TODO: Refactor this
		 */
		$hash = $this->myUrlEncode($this->myEncode(array('user_id'=>$this->getAttr('id'))));
	
		$objEmail->viewVars(array(
				'hash' =>  $hash,
				'image'=> $this::urlToWebrootImg().'Email_Banner.png',
				'objUser' => $this,
				'oAuth'		=> $oAuth
		));
	
		if($objEmail->send()){
			return true;
		}else{
			return false;
		}
	}
	
	public function getDob($perm = 2){
		
		return ($this->getAttr('pdob') >= $perm )	?$this->getAttr('dob'):'';
	}
	
	public function getGender($perm = 2){
		return ($this->getAttr('pgender') >= $perm )	?$this->getAttr('gender'):'';
	}
	
	public function getArrayRepresentation($imgUrl){
		
		return array(	'user_id'		=> $this->getAttr('id'),
						'username' 		=> $this->getAttr('username'),
						'fullname'		=> $this->getFullname(0),
						'email'			=> $this->getEmail(),
						'dob'			=> $this->getDob(),
						'gender'		=> $this->getGender(),
						'picture_w90'		=> $imgUrl.'img/'.$this->Picture->getAttr('w90'),
						'picture_w40'		=> $imgUrl.'img/'.$this->Picture->getAttr('w40'));
	}
	
	public function listLastNotifications($limit=0){
		$notificationUser = $this->loadModel('NotificationUser');
		return $notificationUser->listLastNotificationsForUser($this,$limit);
	}
	
	public function markNotificationsAsViewed(){
		$notificationUser = $this->loadModel('NotificationUser');
		return $notificationUser->markNotificationsAsViewed($this);
	}
	
	/**
	 * Return the treatment "his" or "her"
	 */
	public function getHisOrHers(){
		if($this->getAttr('gender') == 1){
			return 'his';
		}elseif($this->getAttr('gender') == 2){
			return 'her';
		}else{
			return 'his/her';
		}
	}
}
