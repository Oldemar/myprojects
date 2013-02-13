<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Works Controller
 *
 * @property Work $Work
 */
class WorksController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		
		
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Work->id = $id;
		if (!$this->Work->exists()) {
			throw new NotFoundException(__('Invalid work'));
		}
		$this->set('work', $this->Work->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Work->create();
			if ($this->Work->save($this->request->data)) {
				$this->Session->setFlash(__('The work has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.'));
			}
		}
		$users = $this->Work->User->find('list');
		$specialties = $this->Work->Specialty->find('list');
		$workplaces = $this->Work->Workplace->find('list');
		$this->set(compact('users', 'specialties', 'workplaces'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Work->id = $id;
		if (!$this->Work->exists()) {
			throw new NotFoundException(__('Invalid work'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Work->save($this->request->data)) {
				$this->Session->setFlash(__('The work has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Work->read(null, $id);
		}
		$users = $this->Work->User->find('list');
		$specialties = $this->Work->Specialty->find('list');
		$workplaces = $this->Work->Workplace->find('list');
		$this->set(compact('users', 'specialties', 'workplaces'));
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
		$this->Work->id = $id;
		if (!$this->Work->exists()) {
			throw new NotFoundException(__('Invalid work'));
		}
		if ($this->Work->delete()) {
			$this->Session->setFlash(__('Work deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Work was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	public function addEditAjax($id = null) {

		$this->Work->id = $id;
		if (!$this->Work->exists()) {
			$this->Work->create();
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Work->save($this->request->data)) {
				$this->Session->setFlash(__('The work has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				
				$this->Session->setFlash(__('The work could not be saved. Please, try again.'));
				$this->Session->setFlash(__('The work could not be saved. Please, try again.'));
			}
			
		} else {
			
			$this->request->data = $this->Work->read(null, $id);
		}
		
		//Employment //
		$works = $this->Work->getWork($this->Work->user_id);
		
		$work_id = $this->Work->user_id;
		
		$this->autoRender=false;
		
		$this->set(compact(	'works', 'work_id' ));
		
		$this->layout = 'ajax';
		
	}
	
	/**
	 * The workListAjaxRender method render the education list
	 */
	public function educationListAjaxRender(){
		
		$this->autoLayout = false; 
		
		$educations = $this->Education->getEducation($id);
		
		$this->set(compact('educations'));
		
		$this->render('education_list');
	}
	
	/**
	 * 
	 * The deleteAjax method delete a Education item form the Ajax
	 */
	public function deleteAjax(){
		
		$this->autoRender=false;
			
		if($this->request->is('ajax')){
			Configure::write('debug', 0);
		}
				
		$this->Work->id = $this->data['Work']['id'];
		
		if(!$this->Work->exists()){
		
			echo __('Invalid employment');
		}
		else{
		
			if ($this->Work->delete()) {
					
				echo __('The Employment item has been deleted.');
			}
			else{
			
				echo 'this is not delete '.$this->Employment->id;
			}
		}
		
	}
	
	
	public function workList($id = null){
		
		$this->loadAditionalCss(array('users'));
		
		$arrObjWork = $this->Work->listWorkByUserId($id);
		
		$this->set('arrObjWork',$arrObjWork);
		
		$this->renderJsonContent();
		
	}
	
	public function workRow($id = null){
		
		$this->layout = 'ajax';
		
		$this->loadAditionalCss(array('users'));
		
		$objWork = $this->Work->findById($id);
		
		$this->set('objWork',$objWork);

		$this->renderJsonContent();

	}
	
	public function workProfile($id = null){
	
		$this->layout = 'ajax';
	
		$this->loadAditionalCss(array('users'));
	
		$objWork = $this->Work->findById($id);
	
		$this->set('objWork',$objWork);
	
		$this->renderJsonContent();
	
	}
	

	public function workEdit($id = null){
		
		$this->layout = 'ajax';
		
		$strErrors = null;
		
		$objWork = $this->Work->getWorkById($id);
		
		if($this->request->is('PUT') || $this->request->is('POST')){
				
			$this->request->data['Work']['user_id'] = $this->objLoggedUser->getAttr('id');
			
			$this->Work->set($this->request->data);
			
			$this->Work->setFields();
			
			if($this->Work->save()){
				
					//Edit redirect to render a single row
					
					if( $id > 0){
						$this->redirect('workRow/'.$this->Work->id);
					}else{
						//Add redirect to render a the whole list
						$this->redirect('workList/'.$this->objLoggedUser->getAttr('id'));	
					}
					
					exit();
				
			}else{
				
				$auxErrors = array();
				foreach($this->Work->validationErrors as $key => $value){
					foreach($value as $k => $v){
						$auxErrors[] = $v;
					}
				}
		
				$workData = $this->Work->data;
				
				$strErrors = implode('<br>', $auxErrors);
				
				
			}

		}
		else{
			
			$workData = $objWork->data;
		}
				
		$this->set('workId', $id);
				
		$this->helpers[] = 'CachedElement';
		$this->helpers[] = 'WorkplaceCachedElement';
		$this->helpers[] = 'SpecialtyCachedElement';
				
		$this->loadAditionalCss(array('users'));
		
		//debug($workData);
				
		$this->request->data  = $workData;
				
		$this->set('obj', $objWork);

		$this->renderJsonContent(array('boolError' => (count($this->Work->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
				
	}
	
}
