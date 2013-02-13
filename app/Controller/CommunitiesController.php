<?php
App::uses('AppController', 'Controller');
/**
 * Communities Controller
 *
 * @property Community $Community
 */
class CommunitiesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Community->recursive = 0;
		$this->set('communities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Community->id = $id;
		if (!$this->Community->exists()) {
			throw new NotFoundException(__('Invalid community'));
		}
		$this->set('community', $this->Community->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Community->create();
			if ($this->Community->save($this->request->data)) {
				$this->Session->setFlash(__('The community has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The community could not be saved. Please, try again.'));
			}
		}
		$users = $this->Community->User->find('list');
		$users = $this->Community->User->find('list');
		$this->set(compact('users', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Community->id = $id;
		if (!$this->Community->exists()) {
			throw new NotFoundException(__('Invalid community'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Community->save($this->request->data)) {
				$this->Session->setFlash(__('The community has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The community could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Community->read(null, $id);
		}
		$users = $this->Community->User->find('list');
		$users = $this->Community->User->find('list');
		$this->set(compact('users', 'users'));
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
		$this->Community->id = $id;
		if (!$this->Community->exists()) {
			throw new NotFoundException(__('Invalid community'));
		}
		if ($this->Community->delete()) {
			$this->Session->setFlash(__('Community deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Community was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
