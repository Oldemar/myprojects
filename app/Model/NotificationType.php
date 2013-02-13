<?php
App::uses('AppModel', 'Model');

class NotificationType extends AppModel {

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
	public $hasMany = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function getNotificationTypeEmailCreation(){
		return $this->findById(1);
	}
	
	public function getNotificationTypeAlertCreation(){
		return $this->findById(2);
	}
	
	public function getNotificationTypeAlertJournalComment(){
		return $this->findById(3);
	}
	
	public function getNotificationTypeAlertFriendshipAproval(){
		return $this->findById(4);
	}
	
	public function getNotificationTypeAlertPhotoComment(){
		return $this->findById(5);
	}
	
	
	
}	
?>