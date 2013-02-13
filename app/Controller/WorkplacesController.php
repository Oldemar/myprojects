<?php
App::uses('AppController', 'Controller');
/**
 * Workplaces Controller
 *
 * @property Workplace $Workplace
 */
class WorkplacesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Workplace->recursive = 0;
		$this->set('workplaces', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Workplace->id = $id;
		if (!$this->Workplace->exists()) {
			throw new NotFoundException(__('Invalid workplace'));
		}
		$this->set('workplace', $this->Workplace->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Workplace->create();
			if ($this->Workplace->save($this->request->data)) {
				$this->Session->setFlash(__('The workplace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The workplace could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Workplace->id = $id;
		if (!$this->Workplace->exists()) {
			throw new NotFoundException(__('Invalid workplace'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Workplace->save($this->request->data)) {
				$this->Session->setFlash(__('The workplace has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The workplace could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Workplace->read(null, $id);
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
			throw new MethodNotAllowedException();
		}
		$this->Workplace->id = $id;
		if (!$this->Workplace->exists()) {
			throw new NotFoundException(__('Invalid workplace'));
		}
		if ($this->Workplace->delete()) {
			$this->Session->setFlash(__('Workplace deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Workplace was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
