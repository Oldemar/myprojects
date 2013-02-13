<?php

App::uses('Sanitize', 'Utility');

class SearchesController extends AppController {

	public $name = 'Searches';
	
	private $user_id;

	public function beforeFilter(){
		
		parent::beforeFilter();
	
		$this->Auth->allow('add');
	
		if ($this->action == 'edit' || $this->action == 'add') {
			$this->Auth->authenticate = $this->User;
		}
		
		$user_id = $this->Auth->user('id');
		
		//THIS MUST BE MOVED TO THE APPCONTROLLER
		$this->loadModel('User');
		
		$user = $this->User->find('first', array(
                                     'conditions'=>array('User.id'=>$this->Auth->user('id')),
                                          'contain'=>array(
	                                            'Picture')));
		
		$this->set('users', $user);
		
	}
	

	/**
	 * 
	 * The index method render the resolve of the searching.
	 * If the 'word' is empty or the found journals is not global them the it renders the Searching form
	 * 
	 */
	public function index(){
		$user_id = Authcomponent::user('id');
		
		$word = $this->request->data['Search']['word'];
		$this->set('word', $word);
		
		$this->loadAditionalCss('bootstrap.components.alert');
		
		if(!empty($this->data)){
			//Who is performing the search
			$this->Search->setLoggedUser($this->objLoggedUser);
			$arrTmpJournals = $this->Search->findJournals($word);
			
			if(count($arrTmpJournals) == 0){
				$this->render('search_form');
				return false;
			}
	
			$arrMyJournals		= $arrTmpJournals['arrMyJournals'];
			$arrGlobalJournals	= $arrTmpJournals['arrGlobalJournals'];
			
			$this->set('arrMyJournals',$arrMyJournals);
			$this->set('arrGlobalJournals',$arrGlobalJournals);
			
			

			$this->render('index');
				
		}
		else{
		
			$this->set('word', '');
			$this->render('search_form');
		}
		
		//$this->loadAditionalCss('users');
		
		
	}	
	
	
}
