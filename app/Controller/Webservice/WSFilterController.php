<?php
App::uses('AppController', 'Controller');

class WSFilterController extends AppController {

	public $validate 	= false;
	
	protected $oauth;
	
	/*
	 * header['OAUTH-ACCESS-CODE']
	 * header['OAUTH-KEY']
	 */
	public $header				= null;
	
	public $oauth_access_code	= null;
	
	public $grant_access		= false;
	
	public $auth_param			= false;
	
	/**
	 * Validate the token and key.
	 * @see AppController::beforeFilter()
	 */
	public function beforeFilter(){
		
		$this->header = getallheaders();
		
 		$param = array(	'client_id' 	=> $this->header['OAUTH-KEY'],
				'response_type' => 'code',
				'redirect_uri'	=> $this->header['OAUTH-URI']);
		

		//$this->auth_param = $this->OAuth->getAuthorizeParams($param);
		
 		//debug($this->header);
		
 		$this->oauth_access_code = $this->OAuth->getAuthCode($this->header['OAUTH-ACCESS-CODE']);
 		
 		if(!$this->isAccessCodeExpired() || $this->isKeyValid()){
			
			$this->grant_access = true;
		}  
		
	}
	
	private function isAccessCodeExpired(){
	
		if (time() >= strtotime($this->oauth_access_code['expires'])) {
		
			//@TODO: Delete the access code expired.
			$this->loadModel("AuthCode");
			
			$this->AuthCode->delete($this->oauth_access_code); 
			
			return true;
		}
	
		return false;
	}
	
	private function isKeyValid(){

/* 		if($this->auth_param['uri'] == $this->header['uri']){
			
			return true;
		}

		return false; */
		
		return true;
	}
	
	public function deleteCode(){
		
	}
	
			
}
