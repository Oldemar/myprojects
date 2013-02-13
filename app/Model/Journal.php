<?php
App::uses('AppModel', 'Model');
/**
 * Journal Model
 *
 * @property Area $Area
 * @property User $User
 * @property Album $Album
 * @property Comment $Comment
 */
class Journal extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''

		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''

		),
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'region_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''

		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''

		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CoverPhoto' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'journal_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'journal_id',
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
			'foreignKey' => 'journal_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'journal_id',
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
		'Journalperm' => array(
			'className' => 'Journalperm',
			'foreignKey' => 'journal_id',
			'dependent' => true,
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
			'foreignKey' => 'journal_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			),
		'Share' => array(
			'className' => 'Share',
			'foreignKey' => 'journal_id',
			'dependent' => true,
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
			'foreignKey' => 'journal_id',
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
	
	public $validate = array(
			
			'city_id' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'You must enter a City Name.',
					'allowEmpty' => false
			),
			'area_id' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'You must enter an Activity.',
					'allowEmpty' => false
			),
			'date_event' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'You must enter a Date.',
					'allowEmpty' => false
			),	
			'title' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'You must enter a Title.',
					'allowEmpty' => false
			),		
			'location' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'You must enter a Place/Venue.',
					'allowEmpty' => false
			)				
							
			
	);
		

	public function afterDelete() {
		
		//echo $this->id;
		$jphto=$this->Photo->find('all',array('conditions'=>array('Photo.journal_id'=>$this->id)));	
		$jcmmt=$this->Comment->find('all',array('conditions'=>array('Comment.journal_id'=>$this->id)));	
		$jvdeo=$this->Video->find('all',array('conditions'=>array('Video.journal_id'=>$this->id)));	
		foreach ($jphto as $jphoto):
			if (file_exists("img/{$jphoto['Photo']['name']}"))
				unlink("img/{$jphoto['Photo']['name']}");
		endforeach;
		$this->query("DELETE FROM `photos` WHERE `photos`.`journal_id` = ".$this->id);
		foreach ($jvdeo as $jvideo):
			if (file_exists("img/{$jvideo['Video']['name']}"))
				unlink("img/{$jvideo['Video']['name']}");
		endforeach;
		$this->query("DELETE FROM `videos` WHERE `videos`.`journal_id` = ".$this->id);
	
	}
	
	function beforeSave() {

	}
	
	function afterSave($created){
		
		# friend sharing level
		if ( (isset($this->data['fsharing'])) && ($this->data['fsharing']!=null) ) 
			$this->edtSharingFriends();
		
		# groups sharing level
		if ( (isset($this->data['gsharing'])) && ($this->data['gsharing']!=null) ) 
			$this->edtSharingGroups();
			
					# communities sharing level
/*					if ( (isset($this->data['csharing'])) && ($this->data['csharing']!=null) ) 
						$this->edtSharingCommunities(); */
							
	}

	public function edtSharingFriends() {
		$usrjrnl = $this->Journalperm->find('all',array(
									'conditions'=>array(
												'Journalperm.journal_id'=>$this->data['Journal']['id'],
												'Journalperm.tablename_id'=>3)));
		
		foreach ($this->data['fsharing'] as $id=>$checked) :
			if ($checked) {
				$isins = 1;
				$isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isins = 0;
						break;
					}
				endforeach;
			} else {
				$isins = $isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isdel = $usrjrnl1['Journalperm']['id'];
						break;
					}
				endforeach;
			}
			if (isset($isins) && $isins) {
				$this->data['Journalperm']['id'] = null;
				$this->data['Journalperm']['journal_id'] = $this->data['Journal']['id'];
				$this->data['Journalperm']['tablename_id'] = 3 ;
				$this->data['Journalperm']['id_value'] = $id;
				$this->Journalperm->save($this->data);
			} 
			if (isset($isdel) && $isdel) {
				$this->Journalperm->delete($isdel);
			}
		endforeach;
		
	}
	
	public function edtSharingGroups() {
		$usrjrnl = $this->Journalperm->find('all',array(
									'conditions'=>array(
												'Journalperm.journal_id'=>$this->data['Journal']['id'],
												'Journalperm.tablename_id'=>10)));
		
		foreach ($this->data['gsharing'] as $id=>$checked) :
			if ($checked) {
				$isins = 1;
				$isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isins = 0;
						break;
					}
				endforeach;
			} else {
				$isins = $isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isdel = $usrjrnl1['Journalperm']['id'];
						break;
					}
				endforeach;
			}
			if (isset($isins) && $isins) {
				$this->data['Journalperm']['id'] = null;
				$this->data['Journalperm']['journal_id'] = $this->data['Journal']['id'];
				$this->data['Journalperm']['tablename_id'] = 10 ;
				$this->data['Journalperm']['id_value'] = $id;
				$this->Journalperm->save($this->data);
			} 
			if (isset($isdel) && $isdel) {
				$this->Journalperm->delete($isdel);
			}
		endforeach;
		
	}
	
	public function edtSharingCommunities() {
		$usrjrnl = $this->Journalperm->find('all',array(
									'conditions'=>array(
												'Journalperm.journal_id'=>$this->data['Journal']['id'],
												'Journalperm.tablename_id'=>7)));
		
		foreach ($this->data['csharing'] as $id=>$checked) :
			if ($checked) {
				$isins = 1;
				$isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isins = 0;
						break;
					}
				endforeach;
			} else {
				$isins = $isdel = 0;
				foreach ($usrjrnl as $usrjrnl1):
					if ($usrjrnl1['Journalperm']['id_value'] == $id) {
						$isdel = $usrjrnl1['Journalperm']['id'];
						break;
					}
				endforeach;
			}
			if (isset($isins) && $isins) {
				$this->data['Journalperm']['id'] = null;
				$this->data['Journalperm']['journal_id'] = $this->data['Journal']['id'] ;
				$this->data['Journalperm']['tablename_id'] = 7 ;
				$this->data['Journalperm']['id_value'] = $id;
				$this->Journalperm->save($this->data);
			} 
			if (isset($isdel) && $isdel) {
				
				$this->Journalperm->delete($isdel);
			}
		endforeach;
		
	}
	
	public function rateSave($data) {
	
		$this->data['Journalrate']['sharing_level'] = $sharinglevel ; 
		$this->data['Journalrate']['journal_id'] = $this->data['id'];
		$this->data['Journalrate']['user_id'] = Authcomponent::user('id');
		return TRUE;

	}
	
	public function updateview($last_view,$jid) {
		$this->Comment->updateAll(array('Comment.viewed'=>1),
				array('AND'=>array(
					'Comment.created <='=>$last_view,
					'Comment.journal_id'=>$jid)));
	}

	/**
	* Uploads an photo, compress, create Thumbnails and vinculate the photo to the journal
	* @param $file is the position of the photo to be uploaded in the Global $_FILES ex: uploadAndAddPhoto($_FILES['pic'])
	* @param $shrlevel 0 or 1 or 2
	**/
	public function uploadAndAddPhoto($file,$shrlevel){
		if(!isset($this->Photo) || !is_object($this->Photo)){
			$objPhoto = $this->loadModel('Photo');
		}else{
			$objPhoto = $this->Photo;
		}
		
		try{	
			$objNewPhoto = $objPhoto->uploadPhotoToJournal($this, $file , $shrlevel);
			
			$this->setInitialCoverPhoto($objNewPhoto);
			
			
		}catch(Exception $e){
			throw $e;
		}	
	}
	
	/**
	* Returns the complete path on HD to the userUploadFolder
	**/
	public function getCompletePathToUserUploadFolder(){
		$objPicture = $this->loadModel('Picture');
		if(!isset($this->User) || !is_object($this->User)){
			throw new Exception('Invalid user');
		}
		return $objPicture->getCompletePathToUserUploadFolder($this->User);
	}

	/**
	 * Returns an Array of Users that is allowed to see the For Friends Section
	 */
	public function listUsersInForFriendsSection(){		
			$arrObjPerm = $this->listJournalPerm();
			if(count($arrObjPerm) == 0){
				return false;
			}
		
			$this->loadObject('User');

			$arrUsers = array();
			
			$objGroup = $this->loadModel('Group');
		
			foreach ($arrObjPerm as $value){
				$journalperm = $value->data['Journalperm'];
					
				if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == 0)) {
					$arrUsers = array_merge($arrUsers , $this->User->listFriend(array('buildBelongs' => 0)));
				}
				if ($journalperm['tablename_id'] == 3 && $journalperm['id_value'] > 0) {
					$arrUsers[] = $this->User->findById($journalperm['id_value'], array('recursive'=>-1), "0");
				}
				
				if (($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] == 0)){
					$arrGroups = $this->User->listGroupsByUser();
					
					if(is_array($arrGroups)){
						foreach($arrGroups as $key => $value){
							$arrUsers = array_merge($arrUsers , $value->listMembers());
						}
					}
					
				}
				if  ( ($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] != 0) ) {
					$group = $objGroup->findById($journalperm['id_value']);
					$arrUsers = array_merge($arrUsers , $group->listMembers());
				}
			}
			
			//Remove Duplicated Users
			$arrUserId = array();
			foreach($arrUsers  as $key => $value){
				if(in_array($value->getPrimaryId(),$arrUserId)){
					unset($arrUsers[$key]);
				}else{
					$arrUserId[] = $value->getPrimaryId();
				}
				
			}
			
			return $arrUsers;
	}
	
	/**
	 * Returns an array with all journalperm
	 */
	 public function listJournalPerm(){
	 	if($this->listJournalPerm === null){
		 	$journalPerm = $this->loadModel('Journalperm');
			$this->listJournalPerm = $journalPerm->findObjects('all',array('conditions'=>array('Journalperm.journal_id'=>$this->getID())));
		}
		
		return $this->listJournalPerm;
	 }
	 
	 /**
	  * Check if the user in the parameter can see the Only for my friends Section of the journal $this
	  * @param: $objUser
	  **/
	 public function checkCanSeeFriendSection(User $objUser){
		//In a Foreach gets from the "cache"
		if(isset($this->checkCanSeeFriendSection)){
			return $this->checkCanSeeFriendSection;
		}
		if(!is_object($objUser)){
			return false;
		}
		
		if(!is_object($objUser)){
			return false;
		}
		
	 	if($this->data['Journal']['user_id'] == $objUser->getID()){	
			return $this->checkCanSeeFriendSection = true;
		}

		$isFriend = 0;
		$objRelation = $this->loadModel('Relation');
		$arrRelation1 = $objRelation->find('first',array('recursive'=>0,'conditions'=>array('profile1_id'=>$this->data['Journal']['user_id'],'profile2_id'=>$objUser->getID(),'approved'=>'1')));
		
		if(!$arrRelation1 || count($arrRelation1)==0){
			$arrRelation2 = $objRelation->find('first',array('recursive'=>0,'conditions'=>array('profile1_id'=>$objUser->getID(),'profile2_id'=>$this->data['Journal']['user_id'],'approved'=>'1')));
			if($arrRelation2 && count($arrRelation2) > 0){
				$isFriend = 1;
			}
		}else{
			$isFriend = 1;
		}
		
		if(!$isFriend){
			return $this->checkCanSeeFriendSection = false;
		}
		
		$arrObjPerm = $this->listJournalPerm();
		if(count($arrObjPerm) == 0){
			return $this->checkCanSeeFriendSection = false;
		}
		
		$this->loadObject('User');
		
		$arrGroups = $this->User->getMyGroupsUserBelongs($objUser);
		

		
		$allfriend = 0 ;
		$isallowed = 0 ;
			
		foreach ($arrObjPerm as $value){
			$journalperm = $value->data['Journalperm'];
			
			if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == 0)) {
				return $this->checkCanSeeFriendSection = true;
			}
			if ($journalperm['tablename_id'] == 3 && $journalperm['id_value'] == $objUser->getID()) {
				return $this->checkCanSeeFriendSection = true;
			}
			if (($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] == 0) ) {
				if(count($arrGroups) > 0){
					return $this->checkCanSeeFriendSection = true;
				}
			}
			if  ( ($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] != 0) ) {
				if (is_array($arrGroups) && count($arrGroups) > 0) {
					foreach ($arrGroups as $v){
						if ($v->getAttr('id') == $journalperm['id_value']) {
							return $this->checkCanSeeFriendSection = true;
						}
					}
				}
			}
		}
		return $this->checkCanSeeFriendSection = false;
	 }
	 
	 /**
	  * Check if the journal is Gloabl.
	  * To check if the journal is Global or not, we have to see if there is comment for all, photos for all or videos
	  */
	 public function isJournalGlobal(){
	 	if(strlen($this->getAttr('forall_description')) > 0){
	 		return true;
	 	}
	 	$this->loadPhotos();
	 	if($this->getPhotosPerSharingLevel(2)){
	 		return true;
	 	}
	 	
	 	$this->loadVideos();
	 	if($this->getVideosPerSharingLevel(2)){
	 		return true;
	 	}
	 	return false; 
	 }
	 
	 /**
	 * Check if the journal is for Friends.
	 * To check if the journal is Friends or not, we have to see if there is comment for friendd, photos for friends or videos
	 */
	 public function isJournalForFriends(){
	 	if(strlen($this->getAttr('forgroup_description')) > 0){
	 		return true;
	 	}
	 	$this->loadPhotos();
	 	if($this->getPhotosPerSharingLevel(1)){
	 		return true;
	 	}
	 	 
	 	$this->loadVideos();
	 	if($this->getVideosPerSharingLevel(1)){
	 		return true;
	 	}
	 	return false;
	 }
	 
	 /**
	  * Check if the journal is PRIVATE.
	  * To check if the journal is private or not, we have to see if there is comment for all, comment for friends, photos for all or photos for friends.
	  * @return: boolean
	  */
	 public function isJournalPrivate(){
	 	if(!$this->exists()){
	 		throw new NotFoundException('Invalid Journal Object');
	 	}
	 	
	 	if($this->isJournalGlobal()){
	 		return false;
	 	}
	 	
	 	if($this->isJournalForFriends()){
	 		return false;
	 	}
	 	
	 	return true;
	 }
	 
	 /**
	  * Check if the jounal is private. If so, just the owner can see it. If not, check if the user can see the journal
	  * To check if the journal is private or not, we have to see if there is comment for all, comment for friends, photos for all or photos for friends.
	  * @param User $objUser (NOT MANDATORY)
	  */
	 public function checkCanSeeJournal(User $objUser=null){

	 	$boolLoggedUser = false;
	 	
	 	if($objUser != null && is_object($objUser) && $objUser->exists()){
	 		$boolLoggedUser = true;
	 	}

	 	if($boolLoggedUser){
	 		if($this->checkIfIsTheOwner($objUser)){
	 			return true;
	 		}
	 	}
	 	
 		if($this->isJournalPrivate()){
 			return false;
 		}
 		if($this->isJournalGlobal()){
 			return true;
 		}else{
 			if($boolLoggedUser){
 				if($this->checkCanSeeFriendSection($objUser)){
 					return true;
 				}
 			}
 			return false;
 		}
	 	
	 }
	 
	 /**
	  * Loads the object with the photos of the Journal
	  * After calling this method the photos will be avaliable on $objJournal->Photo as an array of objects
	  */
	 public function loadPhotos(){
	 	if(!isset($this->loadPhotos)){
	 		$this->buildHasMany('Photo');
	 		$this->loadPhotos = true;
	 	}
	 }
	 
	 /**
	  * Loads the object with the photos of the Journal
	  * After calling this method the photos will be avaliable on $objJournal->Photo as an array of objects
	  */
	 public function loadVideos(){
	 	if(!isset($this->loadVideos)){
	 		$this->buildHasMany('Video');
	 		$this->loadVideos = true;
	 	}
	 }
	 
	 /**
	  * Returns the cover 
	  * 
	  * @return Obj Photo
	  */
	 public function getCoverPhoto(){
	 	
	 	$photo_id = $this->getAttr('photo_id');
	 	
	 	if($photo_id != 0){
	 		$objPhoto = $this->loadModel('Photo');
	 		
	 		$objPhoto = $objPhoto->findById($photo_id);
	 		if($objPhoto->getID()){
	 			return $objPhoto;
	 		}else{
	 			return null;
	 		}
	 	}
	 	return null;
	 	
	 }
	
	 
	 /**
	  * Returns the cover. Check if the User on Parameter can se the cover, if not, return cover-not-available photo.
	  *
	  * @return Obj Photo
	  */
	 public function getCoverPhotoToDisplay($objLoggedUser,$size="w150"){
	 	$photo_id = $this->getAttr('photo_id');
	 	 
	 	if($photo_id != 0){
	 		$objPhoto = $this->loadModel('Photo');
	 		$objPhoto = $objPhoto->findById($photo_id);
	 		if($objPhoto->getAttr('sharing_level') == 2){
	 			return $objPhoto->getAttr('url').$objPhoto->getAttr($size);
	 		}
	 		
	 		if($objPhoto->getAttr('sharing_level') == 1 && is_object($objLoggedUser) && $objPhoto->Journal->checkCanSeeFriendSection($objLoggedUser)){
	 			return $objPhoto->getAttr('url').$objPhoto->getAttr($size);
	 		}
	 		
	 		if($objPhoto->getAttr('sharing_level') == 0 && is_object($objLoggedUser) && $objPhoto->Journal->getObject('User')->getAttr('id') == $objLoggedUser->getID()){
	 			return $objPhoto->getAttr('url').$objPhoto->getAttr($size);
	 		}
	 		
	 	}
	 	return Configure::read('IMG_URL').$this->getNoCoverPhotoImagePath();
	 	 
	 }
	 
	 /**
	  * Sets the photo id in the Journal. It's the first uploaded photo
	  * 
	  * @param integer $photo_id
	  */
	 public function setCoverPhoto($photo_id){

	 	$this->data['Journal']['photo_id'] = $photo_id;
	 	
	 	if(!$this->save($this->data, false)){
	 		//@TODO: throw exception
	 		
	 	} 
	 	return true;
	 }
	 
	 /**
	 *	Sets the initial Cover Photo. The Photo has to be Global(Sharing level 2).
	 *  This method is executed when the user is uploading a Photo. So this method verify if there is a cover for this journal and if not 
	 * it sets the default cover photo.
	 **/
	 public function setInitialCoverPhoto($objPhoto){
	 	if(!$this->getCoverPhoto() && is_object($objPhoto) && $objPhoto->getAttr('sharing_level') == 2){
	 		return $this->setCoverPhoto($objPhoto->getID());
		}
		return false;	
	 }
	 
	 /**
	  * Returns the name of the file of the NO COVER IMAGE
	  */
	 public function getNoCoverPhotoImagePath(){
	 	return 'journal_cover.png';
	 }
	 

	 public function listCommentsBySharingLevel($sharingLevel){
	 	return $this->Comment->listCommentsByJournal($this, $sharingLevel);
	 }
	 
	 public function postComment( User $objUser, $sharingLevel,$comment){
	 	return $this->Comment->postCommentForJournal($this,$sharingLevel,$comment, $objUser);
	 }


	 /**
	  * 
	  * Returns the journals to be on the home page
	  * 
	  * @param int limit; default 10
	  * 
	  */
	 public function listJournalsToHomePage($limit = 10){
	 
	 	// @todo: Change this to database when we have an admin tool
	 	$arrJournalIdToHomePage = Configure::read('ArrJournalIdHomePage');
	 	while(count($arrJournalIdToHomePage) > $limit){
	 		unset($arrJournalIdToHomePage[rand(0,count($arrJournalIdToHomePage)-1)]);
	 	}
	 	
	 	return $this->findObjects('all', array(	'conditions'	=> array('Journal.ispublishable'	=>true,
	 																	'Journal.id'=> $arrJournalIdToHomePage
	 																), 
			 										'order'			=> array('Journal.modified'			=>'DESC')),
	 								1);
	 }
	 

	 public function checkIfIsTheOwner(User $objUser){
	 	$objJournalUser = $this->getObject('User');
	 	if(is_object($objUser) && $objJournalUser->getID() == $objUser->getID()){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }

	/**
	 * Returns a formated String with the DateEvent of the Journal
	 */
	 public function getDateEventString(){
	 	 return CakeTime::format('F jS, Y ', $this->getAttr('date_event'));
	 }

	/**
	  * Returns formated string with the cost
	  * @return: String
	  */
	 public function getCost(){
	 	if ($this->getAttr('cost') != 0){
			return h( $this->getAttr('cost') . "  " . $this->Currency->getAttr('code')); 
		}	
	 }


	 public function getVideosPerSharingLevel($shrlvl){
	 	$vsl = 0;
	 	if(is_array($this->Video)) {
		 	foreach($this->Video as $video) {
		 		if(is_object($video)) {
		 			if ( $video->getAttr('sharing_level') == $shrlvl ) {
		 				$vsl++;
		 			}
		 		}
		 	}
		 }
		return $vsl;		
	 }
	 public function getPhotosPerSharingLevel($shrlvl){
	 	$psl = 0;
	 	if(is_array($this->Photo)) {
	 		foreach($this->Photo as $photo) {
	 			if(is_object($photo)) {
	 				if ( $photo->getAttr('sharing_level') == $shrlvl ) {
	 					$psl++;
	 				}
	 			}
	 		}
	 	}
	 	return $psl;
	 }
	 	 
	 /**
	  * Return how many Photos the User can still upload
	  * @param: SharingLevel
	  * @return: int
	  */
	 public function getCountAllowedPhotosUpload($sharingLevel){
	 	$this->loadPhotos();
	 	return 25 - $this->getPhotosPerSharingLevel($sharingLevel);
	 }
	 
	 public function getCountAllowedVideosUpload($sharingLevel){
	 	$this->loadPhotos();
	 	return 2 - $this->getVideosPerSharingLevel($sharingLevel);
	 }
	 
	 /**
	  * Returns a string with the description of the journal based on the $varName on parameter.
	  * The varName is the name of the field in the database that you want the description
	  */
	 public function getDescriptionToShow($varName){
	 	return $this->getAttr($varName);
	 }
	 
	 
	 /**
	  * Returns an array with the HTML of the sums related to the average rate of the user of the journal
	  * @return: Array
	  */
	 public function getSelfAverageRatingSunsToDisplay(){
	 	if($this->getID() && $this->getAttr('user_id')){
			$row = $this->query("select avg(rate) avrate from journalrates where journal_id = ".$this->getID()." and user_id = ".$this->getAttr('user_id')." group by journal_id");
			if(isset($row[0]['0']['avrate'])){
				$rate = $row[0]['0']['avrate'];
			}else{
				$rate = 0;
			}	
		}	
		$request = Router::getRequest(true);
		$arrReturn = array();
		if ($rate) {
			$rate = round($rate);
			for ($x=1;$x<6;$x++) {
				if ($x <= $rate) {
					$arrReturn[] = "<img src=\"https://".$_SERVER['SERVER_NAME'].$request->webroot."img/rating_icon.gif\" alt=\"\" />";
				} else {
					$arrReturn[] = "<img src=\"https://".$_SERVER['SERVER_NAME'].$request->webroot."img/rating_icon_gry.gif\" alt=\"\" />";
				}
			}	
		} else { 
			for ($x=1;$x<6;$x++) {
				$arrReturn[] = "<img src=\"https://".$_SERVER['SERVER_NAME'].$request->webroot."img/rating_icon_gry.gif\" alt=\"\" />";
			}		
		} 
		return $arrReturn;
	 }
	 
	 /**
	  * Returns the string version of the Area of the Journal. This includes the parent area too
	  */
	 public function getAreaString(){
	 	$this->loadObject('Area');
		$this->Area->loadObject('ParentArea');
		if(is_object($this->Area)){
			if(is_object($this->Area->ParentArea)){
				return $this->Area->ParentArea->getAttr('name').' - '.$this->Area->getAttr('name');
			}
			return $this->Area->getAttr('name');
		}
		return 'NO AREA AVAILABLE'; 
	 }
	 
	 /**
	  * Returns an array with the comment's count grouped by Viewed
	  * This method is useful to know the total of comments and how many haven't been viewed
	  * @return $arrReturn['notviewed']
	  * 		$arrReturn['viewed']
	  */
	 public function getCountCommentsGroupByViewed(){
	 	$objComment = $this->loadModel('comment');
		$arr = $objComment->find('all',array('recursive'=>-1,'conditions'=>array('comment.journal_id'=>$this->getID()),'group'=>'comment.viewed','fields'=>array('count(1) total','viewed')));
		
		$arrReturn = array('viewed'=>0,'notviewed'=>0);
		if(is_array($arr)){
			foreach($arr as $key => $value){
				if($value['comment']['viewed'] == 1){
					$arrReturn['viewed'] = $value[0]['total'];
				}else{
					$arrReturn['notviewed'] = $value[0]['total'];
				}
			}
		}
		return $arrReturn;
	 }

	/**
	* Returns a string with a short description of the journal based on the $varName on parameter.
	* 
	* THIS RETURNS A SHORT DESCRIPTION TO BE EXHIBITED ON THE LIST OF JOURNALS
	* @param: The varName is the name of the field in the database that you want the description.
	* @param: $countChars is the number of characteres to be exhibited
	*/
	public function getShortDescription($varName,$countChars=100){
		$str = str_replace(array('<br>','<br />'),'',$this->getAttr($varName));
		
		if(strlen($str) > $countChars){
			$str = substr($str, 0,$countChars).'...';
		}
		return $str;
	}
	
	/**
	 * Returns an array with all journals for the user and how many photos in each Journal
	 */
	public function listJournalsCountPhotos($objUser){
		if(!is_object($objUser)){
			throw new Exception("Invalid User");
		}
		
		$sql = "SELECT 
					Journal.id,
					Journal.title,
					Journal.date_event, 
					count(Photo.id) count 
				FROM
					journals Journal 
				left join photos Photo 
					on Photo.journal_id = Journal.id 
				WHERE 
					Journal.user_id = ".$objUser->getID()."
				GROUP BY 
					Journal.id
				ORDER BY
					Journal.date_event 
						DESC";
		$arr = $this->query($sql);
		return $arr;
		
	}

	public function listJournalsGlobalJournalsToLandingPage($landingPageId,$limit=10,$offset=0){
		$ws = $this->loadModel('WebserviceLandingPage');
		
		$arrAreaId = $ws->getAreaIdByLandingPage($landingPageId);
		
		if(!is_array($arrAreaId) || count($arrAreaId) == 0){
			return array(
					'arrObjects' => array(),
					'count' => 0
			);
		}
		$options['joins'] = array(
				array('table' => 'global_journals',
						'alias' => 'GlobalJournals',
						'type' => 'INNER',
						'conditions' => array(
								'GlobalJournals.journal_id = Journal.id',
						)
				)
		);
		$options['fields'] = "Journal.id , SQL_CALC_FOUND_ROWS `{$this->alias}`.*, `Journal.id";
		/*$options['conditions'] = array(
				'Journal.area_id' => $arrAreaId
		);*/
		
		//return $this->findObjects('all',$options);
		
		$query = "
			SELECT 
				SQL_CALC_FOUND_ROWS *
			FROM 
				`journals` AS `Journal`
			INNER JOIN `global_journals` AS `GlobalJournals` ON (`GlobalJournals`.`journal_id` = `Journal`.`id`) 
			LEFT JOIN `users` AS `User` ON (`Journal`.`user_id` = `User`.`id`)
			LEFT JOIN `areas` AS `Area` ON (`Journal`.`area_id` = `Area`.`id`)
			LEFT JOIN `countries` AS `Country` ON (`Journal`.`country_id` = `Country`.`id`)
			LEFT JOIN `regions` AS `Region` ON (`Journal`.`region_id` = `Region`.`id`)
			LEFT JOIN `cities` AS `City` ON (`Journal`.`city_id` = `City`.`id`)
			LEFT JOIN `currencies` AS `Currency` ON (`Journal`.`currency_id` = `Currency`.`id`)
			LEFT JOIN `photos` AS `CoverPhoto` ON (`Journal`.`photo_id` = `CoverPhoto`.`id`)
			WHERE
				Area.id in(".implode(',',$arrAreaId).")
			ORDER BY 
				Journal.id DESC
			LIMIT 
				".$offset.", ".$limit."
		";
		
		$data = $this->query($query);
		$count = $this->query('SELECT FOUND_ROWS()');
		$count = $count[0][0]['FOUND_ROWS()'];
		
		return array(
				'arrObjects' => $this->buildObjectList($data, 1),
				'count' => $count
		);
	}
	
	/**
	 * Returns an array representation of the Object
	 * This is used on the Webservices
	 */
	public function getArrayRepresentation($imgUrl){
		$coverPhoto = $this->getCoverPhoto();
			
		$this->loadPhotos();
		$arrPhotos2 = array();
		$arrPhotos1 = array();
		$arrPhotos0 = array();
		foreach($this->Photo as $k => $v){
			$tmpArr = array(
					'id'=>$v->getID(),
					'photo'=>$imgUrl.$v->getUrl(),
					'photo_w50'=>$imgUrl.$v->getUrl('w50'),
					'photo_w150'=>$imgUrl.$v->getUrl('w150'),
					'photo_w240'=>$imgUrl.$v->getUrl('w240'),
					'photo_w520'=>$imgUrl.$v->getUrl('w520')
			);
			if($v->getAttr('sharing_level') == 2){
				$arrPhotos2[] = $tmpArr;
			}
			if($v->getAttr('sharing_level') == 1){
				//if($v->checkIfUserCanSeePhoto()){
					
				//}
				$arrPhotos1[] = $tmpArr;
			}
			if($v->getAttr('sharing_level') == 0){
				$arrPhotos0[] = $tmpArr;
			}
		
		}
			
		if(!is_object($coverPhoto)){
			$coverPhoto = Photo::getNoCoverPhotoObject();
		}
		
		$this->User->Picture = $this->User->getObject('Picture');
		
		$tmpJournalComments = $this->listCommentsBySharingLevel(2);
		$arrJournalComments2 = array();
		foreach($tmpJournalComments as $key => $value){
			$value->User->Picture = $value->User->getObject('Picture');
			$arrJournalComments2[] = array(
										'username' => $value->User->getAttr('username'),
										'profile_picture_w40' => ($value->User->Picture->getAttr('url') == '/img/'? $imgUrl.$value->User->Picture->getAttr('url') : $value->User->Picture->getAttr('url')).$value->User->Picture->getAttr('w40'),
										'profile_picture_w90' => ($value->User->Picture->getAttr('url') == '/img/'? $imgUrl.$value->User->Picture->getAttr('url') : $value->User->Picture->getAttr('url')).$value->User->Picture->getAttr('w90'),
										'comment' => $value->getAttr('comment')
									);
		}
		
		
		
		return array(
				'Journal'=> array(
						'id'=> $this->getAttr('id'),
						'title'=> $this->getAttr('title'),
						'date_event'=> $this->getAttr('date_event'),
						'date_event_string'=> $this->getDateEventString(),
						'location'=> $this->getAttr('location'),
						'forall_description'=> $this->getAttr('forall_description'),
						'forall_description_short'=> $this->getShortDescription('forall_description',100),
						'cover_photo' => ($coverPhoto->getAttr('url') == '/img/'? $imgUrl.$coverPhoto->getAttr('url') : $coverPhoto->getAttr('url')).$coverPhoto->getUrl(),
						'cover_photo_w50' => ($coverPhoto->getAttr('url') == '/img/'? $imgUrl.$coverPhoto->getAttr('url') : $coverPhoto->getAttr('url')).$coverPhoto->getAttr('w50'),
						'cover_photo_w150' => ($coverPhoto->getAttr('url') == '/img/'? $imgUrl.$coverPhoto->getAttr('url') : $coverPhoto->getAttr('url')).$coverPhoto->getAttr('w150'),
						'cover_photo_w240' => ($coverPhoto->getAttr('url') == '/img/'? $imgUrl.$coverPhoto->getAttr('url') : $coverPhoto->getAttr('url')).$coverPhoto->getAttr('w240'),
						'cover_photo_w520' => ($coverPhoto->getAttr('url') == '/img/'? $imgUrl.$coverPhoto->getAttr('url') : $coverPhoto->getAttr('url')).$coverPhoto->getAttr('w520'),
						'rating_images' => implode('',$this->getSelfAverageRatingSunsToDisplay())
				),
				'JournalComments2' => $arrJournalComments2,
				'User' => array(
						'id' => $this->User->getAttr('id'),
						'username' => $this->User->getAttr('username'),
						'profile_picture_w40' => ($this->User->Picture->getAttr('url') == '/img/'? $imgUrl.$this->User->Picture->getAttr('url') : $this->User->Picture->getAttr('url')).$this->User->Picture->getAttr('w40'),
						'profile_picture_w90' => ($this->User->Picture->getAttr('url') == '/img/'? $imgUrl.$this->User->Picture->getAttr('url') : $this->User->Picture->getAttr('url')).$this->User->Picture->getAttr('w90')
				),
				'Area' => array(
						'name_to_exhibit' => $this->Area->getNameToExhibit()
				),
				'City' => array(
						'name_to_exhibit' => $this->City->getNameToExhibit()
				),
				'Photo'=> array(
						'sharingLevel2' => $arrPhotos2,
						'sharingLevel1' => $arrPhotos1,
						'sharingLevel0'	=> $arrPhotos0
				)
					
		);
	}
	
	public function notifyCreation(){
		$this->Notification = $this->loadModel('Notification');
		
		$this->Notification->notifyJournalCreationByEmail($this);
		
		$this->Notification->notifyJournalCreationByAlert($this);
		
		return;
	}
}

