<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function getByCity($id = null) {
		$region_id = $this->data['Contact']['birth_region_id'];
		$cities = $this->City->find('list', 
				array('conditions' => 
						array('City.region_id' => $region_id),
								'recursive'=> -1
		));
		
		$this->set('cities',$cities);
		$this->layout = 'ajax';
		
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->set('city', $this->City->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		}
		$cityRes = $this->City->CityRe->find('list', array (
								'conditions'=> array(
									'City.region_id' => 'Contact.region_id')));
		$cityBuses = $this->City->CityBus->find('list');
		$cityBirths = $this->City->CityBirth->find('list');
		$this->set(compact('cityRes', 'cityBuses', 'cityBirths'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->City->read(null, $id);
		}
		$cityRes = $this->City->CityRes->find('list', array (
								'conditions'=> array(
									'City.region_id' => 'Contact.region_id')));
		$cityBuses = $this->City->CityBus->find('list');
		$cityBirths = $this->City->CityBirth->find('list');
		$this->set(compact('cityRes', 'cityBuses', 'cityBirths'));
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function getByRegion() {
		$region_id = $this->request->data['Contact']['res_region_id'];
 
		$cities = $this->City->find('list', array(
			'conditions' => array('City.region_id' => $region_id),
			'recursive' => -1
			));
 
		$this->set('cities',$cities);
		$this->layout = 'ajax';
	}
	
}
