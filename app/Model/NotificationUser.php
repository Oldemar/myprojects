<?php
App::uses('AppModel', 'Model');

class NotificationUser extends AppModel {

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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Notification' => array(
				'className' => 'Notification',
				'foreignKey' => 'notification_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		),
		
	);
	
	public function insert($objNotification, $objUser){
		$arrSave['NotificationUser']['user_id'] = $objUser->getID();
		$arrSave['NotificationUser']['viewed'] = '0';
		$arrSave['NotificationUser']['notification_id'] = $objNotification->getPrimaryId();
		$this->create($arrSave);
		$arrData = $this->save();
		$objNotificationUser = $this->loadModel('NotificationUser');
		$objNotificationUser->data = $arrData;
		$objNotificationUser->id = $objNotificationUser->getPrimaryId();
		$objNotificationUser->User = $objUser;
		$objNotificationUser->Notification = $objNotification;
		
		return $objNotification;
	}
	
	public function toArray($objLoggedUser){
		$this->Notification->loadExtraObjects();
		
		$arrReturn['text']  = $this->Notification->getText($objLoggedUser);
		$arrReturn['image'] = $this->Notification->getImage($objLoggedUser);
		$arrReturn['image2'] = $this->Notification->getImage2($objLoggedUser);
		$arrReturn['url_link'] = $this->Notification->getUrlLink($objLoggedUser);
		$arrReturn['viewed'] = $this->getAttr('viewed');
		$arrReturn['date'] = $this->Notification->getDateCreatedToExhibit();
		
		return $arrReturn;
	}
	
	/**
	 * STATIC
	 */
	public function listLastNotificationsForUser($objUser,$limit){
		return $this->findObjects('all',array('conditions'=>array('user_id'=>$objUser->getID(),"NOT" => array('Notification.notification_type_id' => array(1))),'order'=>'Notification.id desc','limit'=>$limit));
	}
	
	/**
	 * STATIC
	 */
	public function markNotificationsAsViewed($objUser){
		if(!$objUser->getID()){
			return false;
		}
		$sql = "
			UPDATE 
				notification_users
			SET
				viewed = '1'
			WHERE 
				user_id = ".$objUser->getID()." and
				viewed = '0'
		";
		return $this->query($sql);
	}
	
}	
?>