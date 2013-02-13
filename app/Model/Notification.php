<?php
App::uses('AppModel', 'Model');

class Notification extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'NotificationType' => array(
			'className' => 'NotificationType',
			'foreignKey' => 'notification_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
			'NotificationExtra' => array(
					'className' => 'NotificationExtra',
					'foreignKey' => 'notification_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	
	private function checkHasNotified($notificationType, $objJournal){
		$arr = $this->query('
			SELECT
				1 
			FROM 
				notifications Notification
			INNER JOIN
				notification_extras NotificationExtra
				ON
				NotificationExtra.notification_id = Notification.id AND
				NotificationExtra.notification_extra_field_id = 1 AND
				NotificationExtra.value = '.$objJournal->getPrimaryId().'
			WHERE
				Notification.notification_type_id = '.$notificationType->getPrimaryId().'
		');
		
		if(count($arr) > 0){
			return true;
		}else{
			false;
		}
	}
	
	public function getDateCreatedToExhibit(){
		if (CakeTime::isToday($this->getAttr('date'))) {
			return CakeTime::timeAgoInWords($this->getAttr('date'));
		} else {
			if (CakeTime::wasYesterday($this->getAttr('date'))) {
				return 'Yesterday';
			} else {
				return CakeTime::format('h:i | F d, Y', $this->getAttr('date')) ;
			}
		}
	}
	
	public function loadExtraObjects(){
		$this->loadObject('NotificationType');
		
		switch($this->NotificationType->getAttr('id')){
			case 1:
				$journalId = $this->getJournalId();
				$objJournal = $this->loadModel('Journal');
				$this->Journal = $objJournal->findById($journalId);
			break;
			
			case 2:
				$journalId = $this->getJournalId();
				$objJournal = $this->loadModel('Journal');
				$this->Journal = $objJournal->findById($journalId);
			break;
		
			case 3:
				$userId = $this->getUserId();
				$objUser = $this->loadModel('User');
				$this->User = $objUser->findById($userId);
		
				$journalId = $this->getJournalId();
				$objJournal = $this->loadModel('Journal');
				$this->Journal = $objJournal->findById($journalId);
			break;
			
			case 4:
				$userId = $this->getUserId();
				$objUser = $this->loadModel('User');
				$this->User = $objUser->findById($userId);
			
			break;
			
			case 5:
				$userId = $this->getUserId();
				$objUser = $this->loadModel('User');
				$this->User = $objUser->findById($userId);
				
				$photoId = $this->getPhotoId();
				$objPhoto = $this->loadModel('Photo');
				$this->Photo = $objPhoto->findById($photoId);
				
				$journalId = $this->Photo->getAttr('journal_id');
				$objJournal = $this->loadModel('Journal');
				$this->Journal = $objJournal->findById($journalId);
				
			break;
					
					
		}
	}
	
	public function getText($objLoggedUser){
		$this->loadObject('NotificationType');
		
		switch($this->NotificationType->getAttr('id')){
			case 2:
				return ucfirst($this->Journal->User->getAttr('username')).' has published a new journal "'.substr($this->Journal->getAttr('title'), 0,40).(strlen($this->Journal->getAttr('title')) > 40 ? ' ...' :'').'"';
			case 3:
				$this->Journal->loadObject('User');
				
				if($this->Journal->User->getID() == $objLoggedUser->getPrimaryId()){
					return ucfirst($this->User->getAttr('username')).' has posted a comment on your journal "'.substr($this->Journal->getAttr('title'), 0,40).(strlen($this->Journal->getAttr('title')) > 40 ? ' ...' :'').'"';
				}elseif($this->User->getID() == $this->Journal->User->getID()){
					return ucfirst($this->User->getAttr('username')).' also posted a comment on '.$this->Journal->User->getHisOrHers().' journal "'.substr($this->Journal->getAttr('title'), 0,40).(strlen($this->Journal->getAttr('title')) > 40 ? ' ...' :'').'"';
					
				}else{	
					return ucfirst($this->User->getAttr('username')).' also posted a comment on '.$this->Journal->User->getAttr('username').'\'s journal "'.substr($this->Journal->getAttr('title'), 0,40).(strlen($this->Journal->getAttr('title')) > 40 ? ' ...' :'').'"';
				}
								
			case 4:
				return ucfirst($this->User->getAttr('username')).' has accepted your friendship request.';
			case 5:
				$this->Journal->loadObject('User');
				
				if($this->Journal->User->getID() == $objLoggedUser->getPrimaryId()){
					return ucfirst($this->User->getAttr('username')).' has posted a bit on your photo';
				}elseif($this->User->getID() == $this->Journal->User->getID()){
					return ucfirst($this->User->getAttr('username')).' also posted a bit on '.$this->Journal->User->getHisOrHers().' photo';
						
				}else{
					return ucfirst($this->User->getAttr('username')).' also posted a comment on '.$this->Journal->User->getAttr('username').'\'s photo';
				}
						
						
		}	
	}
	
	public function getImage($objLoggedUser){
		$this->loadObject('NotificationType');
		
		switch($this->NotificationType->getAttr('id')){
			case 2:
				$this->Journal->loadObject('User');
				return $this->Journal->User->getProfileImagePath('w40');
			case 3:
				return $this->User->getProfileImagePath('w40');				
			case 4:
				return $this->User->getProfileImagePath('w40');
			case 5:
				return $this->User->getProfileImagePath('w40');
						
		}
	}
	
	public function getImage2($objLoggedUser){
		$this->loadObject('NotificationType');
	
		switch($this->NotificationType->getAttr('id')){
			case 2:
				return $this->Journal->getCoverPhotoToDisplay($objLoggedUser,"w50");
			case 3:
				return $this->Journal->getCoverPhotoToDisplay($objLoggedUser,"w50");
			case 4:
				return null;
			case 5:
				return $this->Photo->getAttr('url').$this->Photo->getAttr('w50');
		}
	}
	
	public function getUrlLink($objLoggedUser){
		$this->loadObject('NotificationType');
		
		switch($this->NotificationType->getAttr('id')){
			case 2:
				return Router::url('/').'journals/view/'.$this->Journal->getPrimaryId();
			case 3:
				return Router::url('/').'journals/view/'.$this->Journal->getPrimaryId();				
			case 4:
				return Router::url('/').'users/profile/'.$this->User->getPrimaryId();
			case 5:
				return Router::url('/').'photos/display/'.$this->Photo->getPrimaryId().'/'.$this->Journal->getPrimaryId();
						
		}
	}
	
	private function _getExtraFieldValue($objNotificationExtraField){
		if(isset($this->NotificationExtra) || !is_array($this->NotificationExtra)){
			$this->buildHasMany('NotificationExtra');
		}
		
		if(isset($this->NotificationExtra) && is_array($this->NotificationExtra) && $this->NotificationExtra != null){
			foreach($this->NotificationExtra as $key => $value){
				if($value->getAttr('notification_extra_field_id') == $objNotificationExtraField->getPrimaryId()){
					return $value->getAttr('value');
				}
			}
		}
	}
	
	private function _addExtraFieldValue($objNotificationExtraField, $value){
		$notificationExtra 		= $this->loadModel('NotificationExtra');
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		
		if(!is_array($this->NotificationExtra)){
			$this->NotificationExtra = array();
		}
		$this->NotificationExtra[] = $notificationExtra->addExtra($this, $objNotificationExtraField, $value);
	}
	
	public function getJournalId(){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getJournalId();
		return $this->_getExtraFieldValue($objNotificationExtraField);
	}
	
	public function addExtraJournalId($journalId){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getJournalId();
		$this->_addExtraFieldValue($objNotificationExtraField,$journalId);
	}
	
	public function getUserId(){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getUserId();
		return $this->_getExtraFieldValue($objNotificationExtraField);
	}
	
	public function addExtraUserId($userId){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getUserId();
		$this->_addExtraFieldValue($objNotificationExtraField,$userId);
	}
	
	public function getPhotoId(){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getPhotoId();
		return $this->_getExtraFieldValue($objNotificationExtraField);
	}
	
	public function addExtraPhotoId($photoId){
		$notificationExtraField = $this->loadModel('NotificationExtraField');
		$objNotificationExtraField = $notificationExtraField->getPhotoId();
		$this->_addExtraFieldValue($objNotificationExtraField,$photoId);
	}
	
	public function insert($objNotificationType){
		
		if(!$objNotificationType->getPrimaryId()){
			throw new Exception('Invalid NotificationType');
		}
		
		$arrSave['Notification']['notification_type_id'] = $objNotificationType->getPrimaryId();
		$arrSave['Notification']['date'] = date('Y-m-d H:i:m');
		$this->create($arrSave);
		$arrData = $this->save();
		$objNotification = $this->loadModel('Notification');
		$objNotification->data = $arrData;
		$objNotification->id = $objNotification->getPrimaryId();
		
		return $objNotification;
	}
	
	public function notifyAllFriendsOnThisJournal(){
		$objJournal = $this->loadModel('Journal');
		$objJournal = $objJournal->findById($this->getJournalId());
		
		if($objJournal->isJournalGlobal()){
			$objUser = $objJournal->getObject('User');
			
			$arrFriends = $objUser->listFriend();
			
			if(is_array($arrFriends)){
				$objNotificationUser = $this->loadModel('NotificationUser');
				foreach($arrFriends as $key => $value){
					$objNotificationUser->insert($this,$value);
				}
			}
			return $arrFriends;
		}
		
		if($objJournal->isJournalForFriends()){
			$arrFriends = $objJournal->listUsersInForFriendsSection();
			if(is_array($arrFriends)){
				$objNotificationUser = $this->loadModel('NotificationUser');
				foreach($arrFriends as $key => $value){
					$objNotificationUser->insert($this,$value);
				}
			}
			return $arrFriends;
		}
	}
	
	public function notifyJournalCommentsParticipants($sharingLevel){
		$objJournal = $this->loadModel('Journal');
		$objJournal = $objJournal->findById($this->getJournalId());
		
		$objUser = $this->loadModel('User');
		$objUser = $objUser->findById($this->getUserId());
		

		$objNotificationUser = $this->loadModel('NotificationUser');
		
		if($objUser->getPrimaryId() != $objJournal->User->getPrimaryId()){
			//Notify The Owner
			$objNotificationUser->insert($this,$objJournal->User);
		}
		
		$modelComment = $this->loadModel('Comment');
		$arrUsers = $modelComment->getUsersCommentedOnJournal($objJournal,$sharingLevel);
		
		if(is_array($arrUsers)){
			foreach($arrUsers as $key => $value){
				//Do not notify the journal nor the user who has just posted a comment
				if($value->getID() != $objJournal->User->getID() && $value->getID() != $objUser->getPrimaryId()){
					$this->notifyUser($value);
				}
			}
		}
	}
	
	public function notifyPhotoCommentsParticipants(){
		$objPhoto = $this->loadModel('Photo');
		$objPhoto = $objPhoto->findById($this->getPhotoId());
		
		$objUser = $this->loadModel('User');
		$objUser = $objUser->findById($this->getUserId());
		

		$objNotificationUser = $this->loadModel('NotificationUser');
		
		$objPhoto->loadObject('Journal');
		$objPhoto->Journal->loadObject('User');
		
		if($objUser->getPrimaryId() != $objPhoto->Journal->User->getPrimaryId()){
			//Notify The Owner
			$objNotificationUser->insert($this,$objPhoto->Journal->User);
		}
		
		$modelPhotocomment = $this->loadModel('Photocomment');
		$arrUsers = $modelPhotocomment->getUsersCommentedOnPhoto($objPhoto);
		
		if(is_array($arrUsers)){
			foreach($arrUsers as $key => $value){
				//Do not notify the journal nor the user who has just posted a comment
				if($value->getID() != $objPhoto->Journal->User->getID() && $value->getID() != $objUser->getPrimaryId()){
					$this->notifyUser($value);
				}
			}
		}
	}
	
	public function notifyUser($objUser){
		$objNotificationUser = $this->loadModel('NotificationUser');
		$objNotificationUser->insert($this,$objUser);
	}
	
	/**
	 * STATIC
	 */
	public function checkHasNotifiedCreationByAlert($objJournal){
		if(!is_object($objJournal)){
			throw new Exception('Invalid Journal');
		}
	
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeAlertCreation();
	
		return $this->checkHasNotified($notificationType, $objJournal);
	}
	
	/**
	 * STATIC
	 */
	public function notifyJournalCreationByAlert($objJournal){
		if($this->checkHasNotifiedCreationByAlert($objJournal)){
			return;
		}
	
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeAlertCreation();
		
		$objNotification = $this->insert($notificationType);
		
		$objNotification->addExtraJournalId($objJournal->getPrimaryId());
	
		$arrFriendsToNotify = $objNotification->notifyAllFriendsOnThisJournal();
	}
	
	/**
	 * STATIC
	 */
	public function checkHasNotifiedCreationByEmail($objJournal){
		if(!is_object($objJournal)){
			throw new Exception('Invalid Journal');
		}
		
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeEmailCreation();
		
		return $this->checkHasNotified($notificationType, $objJournal);
	} 
	
	/**
	 * STATIC
	 */
	public function notifyJournalCreationByEmail($objJournal){
		if($this->checkHasNotifiedCreationByEmail($objJournal)){
			return;
		}
		
		App::uses('CakeEmail', 'Network/Email');
		
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeEmailCreation();
		
		$objNotification = $this->insert($notificationType);
		$objNotification->addExtraJournalId($objJournal->getPrimaryId());
		
		$arrFriendsToNotify = $objNotification->notifyAllFriendsOnThisJournal();
		
	}
	
	
	/**
	 * STATIC
	 * @param: $objUser - Who commented on the Journal
	 * @param: $objJournal
	 */
	public function notifyJournalCommentByAlert($objUser, $objJournal, $sharingLevel=2){
		
		//If it is the owner of the journal that is posting the comment. Don't alert.
		$objJournal->loadObject('User');
	
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeAlertJournalComment();
	
		$objNotification = $this->insert($notificationType);
		
		$objNotification->addExtraUserId($objUser->getPrimaryId());
		$objNotification->addExtraJournalId($objJournal->getPrimaryId());
	
		$objNotification->notifyJournalCommentsParticipants($sharingLevel);
	}
	
/**
	 * STATIC
	 * @param: $objUser - Who commented on the Photo
	 * @param: $objPhoto
	 */
	public function notifyPhotoCommentByAlert($objUser, $objPhoto){
		
		//If it is the owner of the photo that is posting the comment. Don't alert.
		$objPhoto->loadObject('Journal');
		$objPhoto->Journal->loadObject('User');
	
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeAlertPhotoComment();
	
		$objNotification = $this->insert($notificationType);
		
		$objNotification->addExtraUserId($objUser->getPrimaryId());
		$objNotification->addExtraPhotoId($objPhoto->getPrimaryId());
	
		
		$objNotification->notifyPhotoCommentsParticipants();
	}
	
	/**
	 * STATIC
	 * @param: $objUser - Who commented accepted the friendship request
	 * @param: $objUser2 - Who request the friendship and needs to be notified
	 */
	public function notifyFriendshipAprovalByAlert($objUser, $objUser2){
	
		$this->NotificationType = $this->loadModel('NotificationType');
		$notificationType = $this->NotificationType->getNotificationTypeAlertFriendshipAproval();
	
		$objNotification = $this->insert($notificationType);
	
		$objNotification->addExtraUserId($objUser->getPrimaryId());
	
		$objNotification->notifyUser($objUser2);
	}
}	
?>