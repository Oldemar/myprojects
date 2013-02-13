<?php
App::uses('WSFilterController', 'Controller');

class WSCommentsController extends WSFilterController {
	
	public $components = array('RequestHandler');
	
	private $objUser = null;
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('post_journal_comment');
		
		$this->loadModel('User');
		
		$this->objUser = $objUser = $this->User->findById($this->oauth_access_code['user_id']);
		
	}
	
	public function post_journal_comment($comments = "", $jorurnalId = ""){
		$this->loadModel('Comment');
		
		$journalId		= $this->request->data['journalId'];
		$sharingLevel	= $this->request->data['sharingLevel'];
		$comment		= $this->request->data['comment'];
		
		$objJournal		= $this->Journal->findById($journalId,array(),0);
		
		try{
			$objJournal->postComment($this->objLoggedUser,$sharingLevel, $comment);
			$arrReturn['id']				= $journalId;
			$arrReturn['comments_html']		= $this->element('journals/comment',array('journalId'=> $journalId, 'objLoggedUser'=> $this->objLoggedUser,'sharingLevel'=>$sharingLevel));;
			$arrReturn['boolSuccess']		= true;
		}catch(exception $e){
			$this->reportException($e);
			$arrReturn['boolSuccess']	= false;
			$arrReturn['alertMessage']	= $e->getMessage();
		}	
			
		echo json_encode($arrReturn);
		exit();
	}
}