<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Invitations Controller
 *
 * @property Invitation $Invitation
 */
class InvitationsController extends AppController {

	public $components = array('Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Invitation->recursive = 0;
		$this->set('invitations', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Invitation->id = $id;
		if (!$this->Invitation->exists()) {
			throw new NotFoundException(__('Invalid invitation'));
		}
		$this->set('invitation', $this->Invitation->read(null, $id));
	}

/**
 * saveInvitation method
 *
 * @return void
 */
	public function saveInvitation() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Invitation->create();
				if($this->Invitation->save($this->request->data)){
					$email = new CakeEmail();
					$email->from(array('info@livingalpha.com' => 'LivingAlpha.com Invitation'));
					$email->to($this->data['Invitation']['invited']);
					$email->subject('Invitation From LivingAlpha.com');
					$email->send($this->data['Invitation']['invitation']. 'Join us at http://dev.livingalpha.com/users/add');
					$this->Session->setFlash('Invitation was successfully sent!');
				} else {
					$this->Session->setFlash('Invitation was not sent, please try again!');
				}

		}
			$this->redirect($this->referer());
	}
	
/**
 * shareJournal method
 *
 * @return void
 */
	public function shareJournal() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Invitation->create();
				if($this->Invitation->save($this->request->data)){
					$email = new CakeEmail();
					$email->from(array('info@livingalpha.com' => 'LivingAlpha - Sharing a Journal'));
					$email->to($this->data['Invitation']['invited']);
					$email->subject('Sharing a Journal in LivingAlpha.com');
					$email->send("{$this->data['Invitation']['invitation']}" . ' Join us at http://dev.livingalpha.com/users/add');
					$this->Session->setFlash('Share was successfully sent!');
				} else {
					$this->Session->setFlash('Share was not sent, please try again!');
				}

		}
			die("<pre>".print_r($this->data,true)."</pre>");
			$this->redirect($this->referer());
	}
	
/**
 * sendEmail method
 *
 * @param string $id
 * @return void
 */
	public function sendEmail() {
		$this->redirect($this->referer());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Invitation->create();
			if ($this->Invitation->save($this->request->data)) {
				$this->Session->setFlash(__('The invitation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invitation could not be saved. Please, try again.'));
			}
		}
		$users = $this->Invitation->User->find('list');
		$tablenames = $this->Invitation->Tablename->find('list');
		$this->set(compact('users', 'tablenames'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Invitation->id = $id;
		if (!$this->Invitation->exists()) {
			throw new NotFoundException(__('Invalid invitation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Invitation->save($this->request->data)) {
				$this->Session->setFlash(__('The invitation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invitation could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Invitation->read(null, $id);
		}
		$users = $this->Invitation->User->find('list');
		$tablenames = $this->Invitation->Tablename->find('list');
		$this->set(compact('users', 'tablenames'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Invitation->id = $id;
		if (!$this->Invitation->exists()) {
			throw new NotFoundException(__('Invalid invitation'));
		}
		if ($this->Invitation->delete()) {
			$this->Session->setFlash(__('Invitation deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Invitation was not deleted'));
		$this->redirect($this->referer());
	}
}
