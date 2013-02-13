<?php
App::uses('AppController', 'Controller');

class WsjournalssearchController extends AppController {

	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		$this->Auth->allow('search','search_for_landingpage');
	}
	
	public function search($search){
		$this->loadModel('Search');
		$imgUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->request->webroot;
		
		//$this->Search->setLoggedUser($this->objLoggedUser);  ##IMPLEMENT THIS
		$arrTmpJournals = $this->Search->findJournals($search);

		//$arrMyJournals		= $arrTmpJournals['arrMyJournals'];
		$arrGlobalJournals	= @$arrTmpJournals['arrGlobalJournals'];
		
		$arrReturn = array();
		if(is_array($arrGlobalJournals)){
			foreach($arrGlobalJournals as $key => $value){
				$arrReturn[] = $value->getArrayRepresentation($imgUrl);
			}
		}
		if(isset($this->request->query['Debug']) && $this->request->query['Debug'] == 2){
			debug($arrReturn);
			exit();
		}
		
		
		$this->set(array(
				'journals' => $arrReturn,
				'_serialize' => array('journals')
		));
	}

	public function search_for_landingpage($landingPageId="",$search=''){
		$this->loadModel('Search');
		$this->loadModel('WebserviceLandingPage');
		
		$imgUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->request->webroot;
		
		//$this->Search->setLoggedUser($this->objLoggedUser);  ##IMPLEMENT THIS
		
		$arrAreaId = $this->WebserviceLandingPage->getAreaIdByLandingPage($landingPageId);
		if(!is_array($arrAreaId) || count($arrAreaId) == 0){
			exit('Invalid AreaId');
		}
		
		$this->Search->addAreaFilter($arrAreaId);
		$arrTmpJournals = $this->Search->findJournals($search);

		//$arrMyJournals		= $arrTmpJournals['arrMyJournals'];
		$arrGlobalJournals	= @$arrTmpJournals['arrGlobalJournals'];
		
		$arrReturn = array();
		if(is_array($arrGlobalJournals)){
			foreach($arrGlobalJournals as $key => $value){
				$arrReturn[] = $value->getArrayRepresentation($imgUrl);
			}
		}	
		if(isset($this->request->query['Debug']) && $this->request->query['Debug'] == 2){
			debug($arrReturn);
			exit();
		}
		
		
		$this->set(array(
				'journals' => $arrReturn,
				'_serialize' => array('journals')
		));
	}
}
