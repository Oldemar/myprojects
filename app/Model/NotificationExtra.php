<?php
App::uses('AppModel', 'Model');

class NotificationExtra extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = '';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'NotificationExtraField' => array(
				'className' => 'NotificationExtraField',
				'foreignKey' => 'notification_extra_field_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
		),
		
	);
	
	public function addExtra($objNotification, $objNotificationExtraField, $value){
		$data['NotificationExtra']['notification_id'] = $objNotification->getPrimaryId();
		$data['NotificationExtra']['notification_extra_field_id'] = $objNotificationExtraField->getPrimaryId();
		$data['NotificationExtra']['value'] = $value;
		$this->create($data);
		$data = $this->save();
		$obj = clone $this;
		$obj->data = $data;
		$obj->id = $obj->getPrimaryId();
		return $obj;
	}
	
}	
?>