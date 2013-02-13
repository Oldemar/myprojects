<?php
App::uses('WSFilterController', 'Controller');

class WsuserController extends WSFilterController {
	
	public $components = array('RequestHandler');
	
	private $objUser = null;
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('get_user_info');
		
		$this->loadModel('User');
		
		$this->objUser = $objUser = $this->User->findById($this->oauth_access_code['user_id']);
		
	}
	
	public function get_user_info(){
		
		$imgUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->request->webroot;
		
		$this->set(array(
				'token' => getallheaders(),
				'_serialize' => array('token')
		));
	}
	

	
}