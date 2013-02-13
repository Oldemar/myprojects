<?php
App::uses('AppController', 'Controller');

class CacheController extends AppController {

	public $components = array(
			/*'AlphaCache' */
	);
	
	public function beforeFilter(){
		
		$this->Auth->allow('searchCity');
	}
	
	public function searchCity() {
		$this->City	= ClassRegistry::init('City');
		$search		= $this->request->query['term'];
		if($search == ""){
			exit();
		}
		
		$return = array();
		if($this->Auth->user('id')){
			$arrUserCities = $this->City->searchCitiesForUser($search,$this->Auth->user('id'));
			
			if(is_array($arrUserCities)){
				foreach($arrUserCities as $key => $value){
					$return[] = $value->data;
				}
			}
		}	
		
		$result = $this->City->searchCities($search);
		if(is_array($result)){
			$return = array_merge($return,$result);
		}
		
		$return = $this->City->prepareResultsForAutocomplete($return);
		echo json_encode($return);
		exit();
	}
	
	
	
	public function searchWorkplace() {
		$this->Workplace	= ClassRegistry::init('Workplace');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
		
		$result = $this->Workplace->searchWorkplace($search);
		
		$return = $this->Workplace->prepareResultsForAutocomplete($result);
		echo json_encode($return);
		exit();
	}
	
	
	public function searchSpecialty() {
		$this->Specialty	= ClassRegistry::init('Specialty');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
	
		$result = $this->Specialty->searchSpecialty($search);
	
		$return = $this->Specialty->prepareResultsForAutocomplete($result);
		echo json_encode($return);
		exit();
	}
	
	public function searchInstitute() {
		$this->Institute	= ClassRegistry::init('Institute');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
	
		$result = $this->Institute->searchInstitute($search);
	
		$return = $this->Institute->prepareResultsForAutocomplete($result);
		echo json_encode($return);
		exit();
	}	
	
	public function searchEdulevel() {
		$this->Edulevel	= ClassRegistry::init('Edulevel');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
	
		$result = $this->Edulevel->searchEdulevel($search);
	
		$return = $this->Edulevel->prepareResultsForAutocomplete($result);
		echo json_encode($return);
		exit();
	}
	
	public function searchActivity(){
		$this->Area	= ClassRegistry::init('Area');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
	
		$result = $this->Area->searchAreasWithParentName($this->request->query['term'],$this->Auth->user('id'));
	
		$return = $this->Area->prepareResultsForAutocomplete($result);
		
		echo json_encode($return);
		exit();
	}
	
	public function searchGroup(){
		
		$this->Group	= ClassRegistry::init('Group');
		$search		= utf8_decode(@$this->request->query['term']);
		if($search == ""){
			exit();
		}
	
		$return = $this->Group->prepareResultsForAutocomplete($this->request->query['term'],$this->Auth->user('id'));
		
		echo json_encode($return);
		exit();
	}	
	
}
