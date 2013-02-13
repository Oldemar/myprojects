<?php

class Search extends AppModel {
	
	var $name = 'Search';
	
	var $useTable = 'searches';
	
	var $primaryKey = 'id';
	
	var $useDbConfig = 'default';
	
	var $areaIdFilter = array();
	
	
	
	public function findSomething($word = null){
		//TODO: sanitize the word
		
		$word = $this->filter($word);
		
		if(empty($word)) return null;
		
		$theOR = array('OR' => array(	array('Search.jtitle LIKE' => "%".$word."%"),
										array('Search.jdate_event LIKE' => "%".$word."%"),
										array('Search.jforall_description LIKE' => "%".$word."%"),
										array('Search.jforgroup_description LIKE' => "%".$word."%"),
										array('Search.jforme_description LIKE' => "%".$word."%"),
										array('Search.jlocation LIKE' => "%".$word."%"),
										array('Search.jcost LIKE' => "%".$word."%"),
										array('Search.jclimatic_conditions LIKE' => "%".$word."%"),
										array('Search.uusername LIKE' => "%".$word."%"),
										array('Search.ufirstname LIKE' => "%".$word."%"),
										array('Search.ulastname LIKE' => "%".$word."%"),
										array('Search.uemail LIKE' => "%".$word."%"),
										array('Search.udob LIKE' => "%".$word."%"),
										array('Search.uabout_me LIKE' => "%".$word."%"),
										array('Search.aname LIKE' => "%".$word."%"),
										array('Search.pname LIKE' => "%".$word."%"),
										array('Search.pdescription LIKE' => "%".$word."%"),
										array('Search.cname LIKE' => "%".$word."%"),
										array('Search.cfips104 LIKE' => "%".$word."%"),
										array('Search.ciso2 LIKE' => "%".$word."%"),
										array('Search.ciso3 LIKE' => "%".$word."%"),
										array('Search.ccapital LIKE' => "%".$word."%"),
										array('Search.cnationalitysingular LIKE' => "%".$word."%"),
										array('Search.cnationalityplural LIKE' => "%".$word."%"),
										array('Search.ccurrency LIKE' => "%".$word."%"),
										array('Search.ccurrencycode LIKE' => "%".$word."%"),
										array('Search.rregion LIKE' => "%".$word."%"),
										array('Search.rcode LIKE' => "%".$word."%"),
										array('Search.radm1code LIKE' => "%".$word."%"),
										array('Search.iname LIKE' => "%".$word."%"),
										array('Search.ecode LIKE' => "%".$word."%"),
										array('Search.ename LIKE' => "%".$word."%"),
				
				));
		
		if(isset($this->areaIdFilter) && is_array($this->areaIdFilter) && count($this->areaIdFilter) > 0){
			$theOR[] = array('Search.aid'=>$this->areaIdFilter);
		}
		
		return $this->find('list', array('conditions' => $theOR, 'fields' => array('Search.id')));
	}
	
	public function findJournals($word){
		$result = $this->findSomething($word);
			
		if(count($result) == 0){
			return false;
		}
			
		$this->Journal = $this->loadModel('Journal');
			
		$arrObjJournal = $this->Journal->findObjects('all', array(
				'order'=> array('Journal.date_event'=>'DESC'),
				'conditions'=>array('Journal.ispublishable'=>true, 'Journal.id' =>$result)));
			
		$arrMyJournals = array();
		$arrGlobalJournals = array();
			
		foreach($arrObjJournal as $key => $value){
			if($value->checkIfIsTheOwner($this->objLoggedUser)){
				$arrMyJournals[] = $value;
			}else{
				if(!$value->getAttr('forall_description')){
					if(!$value->checkCanSeeFriendSection($this->objLoggedUser)){
						continue;
					}
				}
				$arrGlobalJournals[] = $value;
			}
		}
		
		return array(
			'arrMyJournals' => $arrMyJournals,
			'arrGlobalJournals' => $arrGlobalJournals
		);
	}
	
	private function filter($word){
		App::uses('Sanitize', 'Utility');
		$word = Sanitize::paranoid($word, array(' ', '@', '_', '-', '.','/'));
		
		return trim($word);
	}
	
	/**
	 * Sets who is performing the search
	 * This object will be used in the other methods to validate if the user has access to the journal
	 * @param User $objUser
	 */
	public function setLoggedUser($objUser){
		$this->objLoggedUser = $objUser;
	}
	
	
	public function addAreaFilter($areaIdFilter){
		if(is_array($areaIdFilter)){
			$this->areaIdFilter = array_merge($areaIdFilter,$this->areaIdFilter);
		}else{
			$this->areaIdFilter[] = $areaIdFilter;
		}	
	}
}

