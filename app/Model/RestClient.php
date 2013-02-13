<?php
App::uses('AppModel', 'Model');
class RestClient extends Model {
	
	public $webserviceUrl;
	private $headers;
	private $handle;
	private $type;
	
	public function __construct($params=array()){
		if(!isset($params['type'])){
			$params['type'] = 'json';
		}
		$this->type = $params['type'];
		
		if($params['type'] == 'json'){
			$this->headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			);
		}
	}
	
	private function init(){
		if($this->webserviceUrl == null){
			throw new Exception('RestClient->webserviceUrl needs to be set in the beforeFilter');
		}
		
		$this->getParams = '';
		
		$handle = curl_init();
		
		curl_setopt($handle, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		$this->handle = $handle;
	}
	
	private function close(){
		$this->handle = null;
	}
	
	private function exec(){
		curl_setopt($this->handle, CURLOPT_URL, $this->webserviceUrl.'/'.$this->getParams .'.'.$this->type);
		$this->lastExecuted = $this->webserviceUrl.'/'.$this->getParams .'.'.$this->type;
		
		$response = curl_exec($this->handle);
		$code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
		
		$this->parseResponse($response);
		$this->close();
		return array('response'=>$response,'code'=>$code);
	}
	
	private function parseResponse(&$response){
		if($this->type == 'json'){
			$response = json_decode($response);
		}	
	}
	
	public function getAction($action,$params=array()){
		$this->webserviceUrl = $this->webserviceUrl.'/'.$action; 
		return $this->get($params);
	}
	
	public function get($params = array()) {
		$method = 'GET';
		
		$data = json_encode($params);
		
		$handle = $this->init();
		
		if(is_array($params)){
			$this->getParams = implode('/',$params);
		}else{
			$this->getParams = $params;
		}	
		
		switch($method)
		{
		
			case 'GET':
				break;
		
			case 'POST':
				curl_setopt($this->handle, CURLOPT_POST, true);
				curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
				break;
		
			case 'PUT':
				curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
				break;
		
			case 'DELETE':
				curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
		}
		
		
		return $this->exec();
	}
	
}
?>