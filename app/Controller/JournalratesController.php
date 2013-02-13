<?php
App::uses('AppController', 'Controller');
/**
 * Journalrates Controller
 *
 * @property Journalrate $Journalrate
 */
class JournalratesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Journalrate->recursive = 0;
		$this->set('Journalrates', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Journalrate->id = $id;
		if (!$this->Journalrate->exists()) {
			throw new NotFoundException(__('Invalid Journalrate'));
		}
		$this->set('Journalrate', $this->Journalrate->read(null, $id));
	}

/**
 * saveRating method
 *
 * @return void
 */
 
	public function saverate($rate) {
		
		$this->Journal->Journalrate->set('user_id',$this->Auth->user('id'));	
		$this->Journalrate->save();
	
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Journalrate->create();
			if ($this->Journalrate->save($this->request->data)) {
				$this->Session->setFlash(__('The Journalrate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Journalrate could not be saved. Please, try again.'));
			}
		}
		$journals = $this->Journalrate->Journal->find('list');
		$users = $this->Journalrate->User->find('list');
		$this->set(compact('journals', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Journalrate->id = $id;
		if (!$this->Journalrate->exists()) {
			throw new NotFoundException(__('Invalid Journalrate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Journalrate->save($this->request->data)) {
				$this->Session->setFlash(__('The Journalrate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Journalrate could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Journalrate->read(null, $id);
		}
		$journals = $this->Journalrate->Journal->find('list');
		$users = $this->Journalrate->User->find('list');
		$this->set(compact('journals', 'users'));
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
		$this->Journalrate->id = $id;
		if (!$this->Journalrate->exists()) {
			throw new NotFoundException(__('Invalid Journalrate'));
		}
		if ($this->Journalrate->delete()) {
			$this->Session->setFlash(__('Journalrate deleted'));
			$this->redirect(array('controller' => 'journals', 'action' => 'view',$journalid));
		}
		$this->Session->setFlash(__('Journalrate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
