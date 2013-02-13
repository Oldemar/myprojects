<?php
App::uses('AppController', 'Controller');
/**
 * Institutes Controller
 *
 * @property Institute $Institute
 */
class InstitutesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Institute->recursive = 0;
		$this->set('institutes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Institute->id = $id;
		if (!$this->Institute->exists()) {
			throw new NotFoundException(__('Invalid institute'));
		}
		$this->set('institute', $this->Institute->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Institute->create();
			if ($this->Institute->save($this->request->data)) {
				$this->Session->setFlash(__('The institute has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The institute could not be saved. Please, try again.'));
			}
		}
		$users = $this->Institute->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Institute->id = $id;
		if (!$this->Institute->exists()) {
			throw new NotFoundException(__('Invalid institute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Institute->save($this->request->data)) {
				$this->Session->setFlash(__('The institute has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The institute could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Institute->read(null, $id);
		}
		$users = $this->Institute->User->find('list');
		$this->set(compact('users'));
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
		$this->Institute->id = $id;
		if (!$this->Institute->exists()) {
			throw new NotFoundException(__('Invalid institute'));
		}
		if ($this->Institute->delete()) {
			$this->Session->setFlash(__('Institute deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Institute was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
