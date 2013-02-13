<?php
App::uses('AppModel', 'Model');

class WebserviceLandingPage extends AppModel {

	public $useTable = false;
	private $arrClients;
	private $serviceNames = array(
								'wslandingpage' => 'wslandingpage'
							);
	
	private function getServiceName($clientName){
		return $this->serviceNames[$clientName];
	}
	
	public function getClient($clientName){
		
		if(!isset($this->arrClients[$clientName])){
			$this->arrClients[$clientName] = $this->loadModel('RestClient');
			$this->arrClients[$clientName]->webserviceUrl = Configure::read('WebService.landingpage.url').$this->getServiceName($clientName);
		}
		
		return $this->arrClients[$clientName];
	}
	
	public function getAreaIdByLandingPage($landingPageId){
		$client = $this->getClient('wslandingpage');
		$tmp = $client->getAction('get_area_id',$landingPageId);
		
		if(isset($tmp['response']->area_id)){
			return $tmp['response']->area_id;
		}else{
			return array();
		}
	}

	
}
