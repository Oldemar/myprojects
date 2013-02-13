<?php
App::uses('AppModel', 'Model');

class NotificationExtraField extends AppModel {

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
	public $hasMany = array(
		'NotificationExtra' => array(
			'className' => 'NotificationExtra',
			'foreignKey' => 'notification_extra_field_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function getJournalId(){
		return $this->findById(1,array(),0);
	}
	
	public function getUserId(){
		return $this->findById(2,array(),0);
	}
	
	public function getPhotoId(){
		return $this->findById(3,array(),0);
	}
	
	
}	
?>