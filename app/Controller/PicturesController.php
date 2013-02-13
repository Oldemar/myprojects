<?php
App::uses('AppController', 'Controller');
/**
 * Pictures Controller
 *
 * @property Picture $Picture
 */
class PicturesController extends AppController {
		public $helpers = array(
			'CachedElement'
		); 
	

	function beforeFilter() {
		parent::beforeFilter();
		$this->Picture->currentUsrId = $this->Auth->user('id');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Picture->recursive = 0;
		
		/**
		 * TODO: Instead of creating the object user, it should get the one that is created on AppController::beforeFiler
		 * I didn't do it today because Pedro is still developing this feature
		 */
		$userId = $this->Auth->user('id');
		$this->loadModel('User');

		
		$this->User = $this->User->findById($userId,array(),0);
		
		$this->User->getProfileImagePath('w120');
					
		if ($this->request->is('post')) {
			//Upload the picture and insert in the table pictures with user_id of the logged user
			
			$objPicture = $this->User->uploadPictureToUser($this->request->data);
			
			//Set the picture of the profile to the picture that has just been uploaded.
			if(is_object($objPicture) && $this->User->setDefaultPicture($objPicture)){
				$this->Session->setFlash(__('The picture has been saved'));
				$this->redirect(array('controller' => 'users','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			}
		}
		
		$this->set('picturePath',Picture::getPathToUploadFolder());
		$this->set('uploadFolderName', $this->User->getUploadFolderName());
		
		
		$this->set('pictures', $this->Picture->find('all', array(
						'conditions' => array(
							'Picture.user_id' => $userId
							),
						'contains' => array(
							'User' => array(
								'Picture')
								)
							)
						)
					);
	}
 
/**
 * relatedpics method
 *
 * @return void
 */
	public function relatedpics($id) {
		
		$this->set('pictures', $this->Picture->find('all', array(
						'conditions' => array(
							'Picture.user_id' => $id
							),
						'contains' => array(
							'User' => array(
								'Picture')
								)
							)
						)
					);
		if ($this->request->is('post')) {
			$this->Picture->create();
			if ($this->Picture->save($this->request->data)) {
				$this->Session->setFlash(__('The picture has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			}
		}
		$users = $this->Picture->User->find('first', array('conditions'=>array('User.id'=>$id)));
		$this->set('users',$users);
	}
 
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Picture->id = $id;
		if (!$this->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}
		$this->set('picture', $this->Picture->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$id = $this->Auth->user('id');
		$this->set('pictures', $this->Picture->find('all', array(
						'conditions' => array(
							'Picture.user_id' => $id
							),
						'contains' => array(
							'User' => array(
								'Picture')
								)
							)
						)
					);
		$this->Picture->create();
		if ($this->Picture->save($this->request->data)) {
			$this->Session->setFlash(__('The picture has been saved'));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
 /**
  * Wallace
  * October 11 2012
  * Commented block bellow because i think it is a default block from cake bake and it is not being used
  */
	/*public function edit($id = null) {
		$this->Picture->id = $id;
		if (!$this->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Picture->updatePicture($this->request->data)) {
				$this->Session->setFlash(__('The picture has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Picture->read(null, $id);
		}
		$users = $this->Picture->User->find('list');
		$this->set(compact('users'));
	}*/

	public function editUser($id = null) {
		$objPicture = $this->Picture->findById($id);
		
		if($objPicture->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete set a picture without permission.');
		}
		if ($this->Picture->updatePicture($this->Picture->read(null, $id))) {
			$this->Session->setFlash(__('The picture has been saved to your profile'));
			$this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			$this->redirect($this->referer());
		}
	
	}
	
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			//throw new MethodNotAllowedException();
		}
		$this->Picture->id = $id;
		if (!$this->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}

		$objPicture = $this->Picture->findById($id);
		
		if($objPicture->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete a profile picture without permission.');
		}
		
		
		
		if ($objPicture->deletePicture()){
			$this->Session->setFlash(__('Picture deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Picture was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}