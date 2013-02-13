<?php
App::uses('WSFilterController', 'Controller');

class WsoauthController extends WSFilterController {

	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('call_back');
		
		//debug($this->header);
	}
	
	public function call_back($token = null, $function = null){
		
		$this->loadModel('User');
		
		$this->objUser = $objUser = $this->User->findById($this->oauth_access_code['user_id']);
				
		$this->set(array(
				'token' => $this->objUser,
				'_serialize' => array('token')
		));
	}
	

	
}
