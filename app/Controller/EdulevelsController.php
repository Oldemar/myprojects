<?php
App::uses('AppController', 'Controller');
/**
 * Edulevels Controller
 *
 * @property Edulevel $Edulevel
 */
class EdulevelsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Edulevel->recursive = 0;
		$this->set('edulevels', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Edulevel->id = $id;
		if (!$this->Edulevel->exists()) {
			throw new NotFoundException(__('Invalid edulevel'));
		}
		$this->set('edulevel', $this->Edulevel->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Edulevel->create();
			if ($this->Edulevel->save($this->request->data)) {
				$this->Session->setFlash(__('The edulevel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The edulevel could not be saved. Please, try again.'));
			}
		}
		$users = $this->Edulevel->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Edulevel->id = $id;
		if (!$this->Edulevel->exists()) {
			throw new NotFoundException(__('Invalid edulevel'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Edulevel->save($this->request->data)) {
				$this->Session->setFlash(__('The edulevel has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The edulevel could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Edulevel->read(null, $id);
		}
		$users = $this->Edulevel->User->find('list');
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
		$this->Edulevel->id = $id;
		if (!$this->Edulevel->exists()) {
			throw new NotFoundException(__('Invalid edulevel'));
		}
		if ($this->Edulevel->delete()) {
			$this->Session->setFlash(__('Edulevel deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Edulevel was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
