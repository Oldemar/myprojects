<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		$journals = $this->Comment->Journal->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('journals', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Comment->read(null, $id);
		}
		$journals = $this->Comment->Journal->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('journals', 'users'));
	}


	public function listCommentAjax($photoId){
		$this->loadModel('Photo');
		
		$objPhoto = $this->Photo->findById($photoId);
		
		$arrReturn['id'] = $photoId;
		$arrReturn['comments_html'] = $this->element('Photos/list_comments',array('objPhoto'=> $objPhoto, 'objLoggedUser'=> $this->objLoggedUser));;
		$arrReturn['boolSuccess'] = true;
			
			
		echo json_encode($arrReturn);
		exit();
	}

	public function postCommentAjax(){
		$this->loadModel('Photocomment');
		$this->loadModel('Photo');
		
		$photoId = $this->request->data['photo_id'];
		$comment = $this->request->data['comment'];
		
		$objPhoto = $this->Photo->findById($photoId);
		
		try{
			$objPhoto->postComment($this->objLoggedUser, $comment);
			$arrReturn['id'] = $photoId;
			$arrReturn['comments_html'] = $this->element('Photos/list_comments',array('objPhoto'=> $objPhoto, 'objLoggedUser'=> $this->objLoggedUser));;
			$arrReturn['boolSuccess'] = true;
		}catch(exception $e){
			$this->reportException($e);
			$arrReturn['boolSuccess'] = false;
			$arrReturn['alertMessage'] = $e->getMessage();
		}	
			
		$this->loadModel('Notification');
		$this->Notification->notifyPhotoCommentByAlert($this->objLoggedUser, $objPhoto);
		
		echo json_encode($arrReturn);
		exit();
	}
	

	public function listVideoCommentAjax($videoId){
		$this->loadModel('Video');
		
		$objVideo = $this->Video->findById($videoId);
		
		$arrReturn['id'] = $videoId;
		$arrReturn['comments_html'] = $this->element('Videos/list_comments',array('objVideo'=> $objVideo, 'objLoggedUser'=> $this->objLoggedUser));;
		$arrReturn['boolSuccess'] = true;
			
			
		echo json_encode($arrReturn);
		exit();
	}

	public function postVideoCommentAjax(){
		$this->loadModel('Videocomment');
		$this->loadModel('Video');
		
		$videoId = $this->request->data['video_id'];
		$comment = $this->request->data['comment'];
		
		$objVideo = $this->Video->findById($videoId);
		
		try{
			$objVideo->postVideoComment($this->objLoggedUser, $comment);
			$arrReturn['id'] = $videoId;
			$arrReturn['comments_html'] = $this->element('Videos/list_comments',array('objVideo'=> $objVideo, 'objLoggedUser'=> $this->objLoggedUser));;
			$arrReturn['boolSuccess'] = true;
		}catch(exception $e){
			$this->reportException($e);
			$arrReturn['boolSuccess'] = false;
			$arrReturn['alertMessage'] = $e->getMessage();
		}	
			
		echo json_encode($arrReturn);
		exit();
	}
	
	public function deleteVideoCommentAjax($commentId){
		$this->loadModel('Videocomment');
		$objVideoComment = $this->Videocomment->findById($commentId);
		if($objVideoComment->delete()){
			$arrReturn['boolSuccess'] = true;
		}else{
			$arrReturn['boolSuccess'] = false;
		}
		
		echo json_encode($arrReturn);
		exit();
	}
	
	public function postJournalCommentAjax(){
		$this->loadModel('Comment');
		$this->loadModel('Journal');
		
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
		
		$this->loadModel('Notification');
		$this->Notification->notifyJournalCommentByAlert($this->objLoggedUser, $objJournal, $sharingLevel);
			
		echo json_encode($arrReturn);
		exit();
	}
	
	public function deleteCommentAjax($commentId){
		$this->loadModel('Photocomment');
		$objPhotoComment = $this->Photocomment->findById($commentId);
		if($objPhotoComment->delete()){
			$arrReturn['boolSuccess'] = true;
		}else{
			$arrReturn['boolSuccess'] = false;
		}
		
		echo json_encode($arrReturn);
		exit();
	}
	
	public function deleteJournalCommentAjax($commentId){
		$this->loadModel('Comment');
		$objComment = $this->Comment->findById($commentId);
		if($objComment->delete()){
			$arrReturn['boolSuccess'] = true;
		}else{
			$arrReturn['boolSuccess'] = false;
		}
		
		echo json_encode($arrReturn);
		exit();
	}
	
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null,$journalid = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('Comment deleted'));
		} else {
			$this->Session->setFlash(__('Comment was not deleted'));
		}
		$this->redirect($this->referer());
	}
}
