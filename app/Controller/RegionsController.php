<?php
App::uses('AppController', 'Controller');
/**
 * Regions Controller
 *
 * @property Region $Region
 */
class RegionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function getByRegion() {
		$country_id = $this->data['Contact']['birth_country_id'];
		$regions = $this->Region->find('list', 
				array(	'fields'=> array('id','region'),
						'conditions' => 
						array('Region.country_id' => $country_id),
								'recursive'=> -1
		));
		
		$this->set('regions',$regions);
		$this->layout = 'ajax';
		
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Region->recursive = 0;
		$this->set('regions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		$this->set('region', $this->Region->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Region->create();
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'));
			}
		}
		$regionRes = $this->Region->RegionRe->find('list');
		$regionBuses = $this->Region->RegionBus->find('list');
		$regionBirths = $this->Region->RegionBirth->find('list');
		$this->set(compact('regionRes', 'regionBuses', 'regionBirths'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Region->read(null, $id);
		}
		$regionRes = $this->Region->RegionRe->find('list');
		$regionBuses = $this->Region->RegionBus->find('list');
		$regionBirths = $this->Region->RegionBirth->find('list');
		$this->set(compact('regionRes', 'regionBuses', 'regionBirths'));
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
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		if ($this->Region->delete()) {
			$this->Session->setFlash(__('Region deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Region was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
