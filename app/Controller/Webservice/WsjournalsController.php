<?php
App::uses('AppController', 'Controller');

class WsjournalsController extends AppController {

	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		
		$this->Auth->allow('list_journals');
		$this->Auth->allow('get_by_id');
	}
	
	public function list_journals($landingPageId,$limit=10,$offset=0) {
		$this->loadModel('Journal');
		$imgUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->request->webroot;
		
		$arrayResult = $this->Journal->listJournalsGlobalJournalsToLandingPage($landingPageId,$limit,$offset);
		
		$maxChars = 130;
		
		$arrReturn = array(
				'count'=> @$arrayResult['count'],
				'arrObjects' => array()
		);
		foreach(@$arrayResult['arrObjects'] as $key => $value){
			$arrReturn['arrObjects'][] = $value->getArrayRepresentation($imgUrl);
		}
		if($this->request->query['Debug'] == 2){
			debug($arrReturn);
			exit();
		}
		
		$this->set(array(
				'arrReturn' => $arrReturn,
				'_serialize' => array('arrReturn')
		));
	}
	
	public function get_by_id($journalId) {
		$this->loadModel('Journal');
		$imgUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->request->webroot;
	
		$objJournal = $this->Journal->findById($journalId);
		
		$maxChars = 130;
		
		$arrReturn = $objJournal->getArrayRepresentation($imgUrl);
		
		if($this->request->query['Debug'] == 2){
			debug($arrReturn);
			exit();
		}
	
		$this->set(array(
				'journal' => $arrReturn,
				'_serialize' => array('journal')
		));
	}
		
}
