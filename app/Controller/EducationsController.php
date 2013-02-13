<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Educations Controller
 *
 * @property Education $Education
 */
class EducationsController extends AppController {

	public $uses = 'Education';

	public $paginate = array('Education' => array('limit' => 25,'order' => array('Education.created' => 'desc')));

	/**
	 * The addEditAjax method: 
	 * Add new record when the Education.id is null
	 * Edit the record in the Education.id 
	 * 
	 * This method can be access from Ajax
	 * 
	 */
	public function addEditAjax(){

		$this->autoRender=false;
			
		if($this->request->is('ajax')){
			Configure::write('debug', 0);
		}


		
		if(!empty($this->data)){

			//if the education exist then it is udpated
			if(is_null($this->data['Education']['id'])){
			
				$this->Education->create();
			}
			

			$this->Education->set($this->request->data);

			
			if ($this->Education->save($this->request->data)) {

				$this->Session->setFlash(__('The education has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {

				$this->Session->setFlash(__('The education could not be saved. Please, try again.'));
			}


		}
		else{
			 
			echo 'Error while adding record';
		}
			
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
				
		$this->Education->id = $this->data['Education']['id'];
		
		if(!$this->Education->exists()){
		
			echo __('Invalid education');
		}
		else{
		
			if ($this->Education->delete()) {
					
				echo __('The Education item has been deleted.');
			}
			else{
			
				echo 'this is not delete '.$this->Education->id;
			}
		}
		
	}
	
	/**
	 * The educationListAjaxRender method render the education list
	 */
	public function educationListAjaxRender(){
		
		$this->autoLayout = false; 
		
		$educations = $this->Education->getEducation($id);
		
		$this->set(compact('educations'));
		
		$this->render('education_list');
	}
	

	
	/**
	 * The employmentListAjaxRender method render the education list
	 */
	public function employmentListAjaxRender(){
		
		$this->autoLayout = false; 
		
		$educations = $this->Education->getEducation($id);
		
		$this->set(compact('educations'));
		
		$this->render('education_list');
	}
	
	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Education->recursive = 0;

		$this->set('educations', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Education->id = $id;
		if (!$this->Education->exists()) {
			throw new NotFoundException(__('Invalid education'));
		}
		$this->set('education', $this->Education->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Education->create();
			if ($this->Education->save($this->request->data)) {
				$this->Session->setFlash(__('The education has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The education could not be saved. Please, try again.'));
			}
		}
		$users = $this->Education->User->find('list');
		$edulevels = $this->Education->Edulevel->find('list');
		$institutes = $this->Education->Institute->find('list');
		$this->set(compact('users', 'edulevels', 'institutes'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Education->id = $id;
		if (!$this->Education->exists()) {
			throw new NotFoundException(__('Invalid education'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Education->save($this->request->data)) {
				$this->Session->setFlash(__('The education has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The education could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Education->read(null, $id);
		}
		$users = $this->Education->User->find('list');
		$edulevels = $this->Education->Edulevel->find('list');
		$institutes = $this->Education->Institute->find('list');
		$this->set(compact('users', 'edulevels', 'institutes'));
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
		$this->Education->id = $id;
		if (!$this->Education->exists()) {
			throw new NotFoundException(__('Invalid education'));
		}
		if ($this->Education->delete()) {
			$this->Session->setFlash(__('Education deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Education was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	/**
	 * The educationList method renders the List of Ecuation base on the User id
	 * 
	 * @param unknown_type $id
	 */
	public function educationList($id = null){
	
		$this->layout = 'ajax';
		$this->loadAditionalCss(array('users'));
	
		$arrObjEducation = $this->Education->listEducationByUserId($id);
	
		$this->set('arrObjEducation',$arrObjEducation);
		
		$this->renderJsonContent();
	
	}
	
	/**
	 * The educationRow method rendes the education row regarding to the id
	 * 
	 * @param inter $id
	 */
	public function educationRow($id = null){
	
		$this->layout = 'ajax';
	
		$this->loadAditionalCss(array('users'));
	
		$objEducation = $this->Education->findById($id);
		
		$this->set('objEducation',$objEducation);
		
		$this->renderJsonContent();
	
	}
	
	/**
	 * The educationRow method rendes the education row regarding to the id
	 *
	 * @param inter $id
	 */
	public function educationProfile($id = null){
	
		$this->layout = 'ajax';
	
		$this->loadAditionalCss(array('users'));
		
		$objEducation = $this->Education->findById($id, array('conditions'=>array('perm'=>2)));
	
		$this->set('objEducation',$objEducation);
	
		$this->renderJsonContent();
	
	}
	
	
	

	/**
	 * The educationEdit method renders the edit form.
	 * 
	 * @param inter $id
	 */
	public function educationEdit($id = null){
	
		$this->layout = 'ajax';
		
		$strErrors = null;
		
		$objEducation = $this->Education->getEducationById($id);
		
		if($this->request->is('PUT') || $this->request->is('POST')){
			
			$this->request->data['Education']['user_id'] = $this->objLoggedUser->getAttr('id');
			
			$this->Education->set($this->request->data);
			
			$this->Education->setFields();
			
			if($this->Education->save()){
				
					//Edit redirect to render a single row
					if($id > 0){
						
						$this->redirect('educationRow/'.$this->Education->id);
					}else{
						//Add redirect to render a the whole list
						$this->redirect('educationList/'.$this->objLoggedUser->getAttr('id'));
					}
					
					exit();

			}else{
				
				$auxErrors = array();
				foreach($this->Education->validationErrors as $key => $value){
					foreach($value as $k => $v){
						$auxErrors[] = $v;
					}
				}
				
				$workData = $this->Education->data;
				
				$strErrors = implode('<br>', $auxErrors);
			
			}


		}		
		else{
			if(is_object($objEducation)){
				$workData = $objEducation->data;
			}
		}
		
			
			
		$this->set('educationId', $id);
		
		$this->helpers[] = 'CachedElement';
		
		$this->loadAditionalCss(array('users'));
		
		if(isset($workData)){
			$this->request->data = $workData;
		}
			
		$this->set('obj', $objEducation);
		
		$this->renderJsonContent(array('boolError' => (count($this->Education->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
		
		
	}
		
}
