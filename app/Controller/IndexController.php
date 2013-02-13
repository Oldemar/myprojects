<?php

class IndexController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Index';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html', 'Session', 'Recaptcha.Recaptcha', 'Form');
	public $components = array('Recaptcha.Recaptcha');

	public $uses = array('Journals');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('objController',$this);
		$this->Auth->allow(array('privacy','terms','help','about_us','index','journalview','termsAjax','privacyAjax'));
		
		
		
	}

	public function privacy(){
		$this->loadAditionalCss('users');
		
		$this->loadAditionalCss('bootstrap.base.typography.css');
	}
	
	public function terms(){
		
		$this->loadAditionalCss('bootstrap.base.typography.css');
		
	}
	
	public function termsAjax(){
		echo $this->element('Policy/terms');
		exit();
	}
	
	public function privacyAjax(){
		echo $this->element('Policy/privacy');
		exit();
	}
	
	public function help(){
		
	}
	
	public function about_us(){
		
	}
	
	public function index() {
        $this->loadAditionalJs('jwplayer/jwplayer');
        $this->loadModel('Journal');
        
        $arrayObjJournal = $this->Journal->listJournalsToHomePage();

        foreach($arrayObjJournal as $key => $value){
        	if(!$value->checkCanSeeJournal($this->objLoggedUser)){
        		unset($arrayObjJournal[$key]);
        	}else{
        		$arrayObjJournal[$key]->buildHasMany('Journalrate');
        	}	
        }
        
        //Fix the keys because of the unset
        $arrayObjJournal = array_merge($arrayObjJournal);
        
		$this->set(compact('page', 'title_for_layout', 'arrayObjJournal'));
		
		$this->loadAditionalCss('users');
				
	}

	public function journalview($id = null) {

		$this->loadModel('Journal');

		$objJournal = $this->Journal->findById($id);
		
		if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
		
		if(!$objJournal->checkCanSeeJournal($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a journal withour permission.');
		}
		

		$objJournal->User->loadObject('Picture');
		$objJournal->Area->loadObject('ParentArea');

		$objJournal->buildHasMany('Photo');
		$objJournal->buildHasMany('Video');
		$objJournal->buildHasMany('Journalrate');

//		debug($objJournal->Photo);

		$this->set('objJournal',$objJournal);

		

	}

}
