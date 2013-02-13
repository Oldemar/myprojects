<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');


/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $helpers = array('Js');

	//public $components = array('MathCapt'=> array('timer' => 3));


	function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->allow('add','forgot_password','new_password','forgot_username','activate','msgActivate','facebookSingUp', 'externalLogin', 'externalRegistration','createOAuthClient');

		if ($this->action == 'edit' || $this->action == 'add') {
			$this->Auth->authenticate = $this->User;
		}
		
	}

	public function index() {
		
		
		$this->helpers[] = 'CachedElement';
		$this->User->recursive = 0;

		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');


		$this->loadAditionalJs('users/index');
		$this->loadAditionalJs('jquery-ui-1.9.1.autocomplete');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');
		
		$objUser = $this->objLoggedUser;

		$this->set('objUser', $objUser);

		$this->populateVariables();
	}

	/**
	 * populateVariable methods
	 *
	 */
	private function populateVariables(){


		$this->User->id = $this->Auth->user('id');

		$user = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $this->User->id),
						'contain' => array (
								'Contact'=> array(
										'BirthCountry',
										'BirthRegion',
										'BirthCity',
										'BusCountry',
										'BusRegion',
										'BusCity',
										'ResCountry',
										'ResRegion',
										'ResCity'),
								'Picture',
								'Area'
						)
				)
		);

		$this->set('contact', $user['Contact']);
		$this->set('user', $user);
		$this->set('users', $user);


		$this->request->data = $user;

		$birthCountries = $this->User->Contact->BirthCountry->find('list',array('order'=>'BirthCountry.name asc'));
		
		$birthRegions = $this->User->Contact->BirthRegion->find('list', array(
				'conditions'=> array('BirthRegion.country_id'=> $this->data['Contact']['birth_country_id']),
				'fields'=> array('id','region'),
				'order'=>'BirthRegion.region asc'));
		
		$birthCities = $this->User->Contact->BirthCity->find('list', array(
				'conditions'=> array('BirthCity.region_id'=>$this->data['Contact']['birth_region_id']),
				'order'=>'BirthCity.name asc'));

		$resCountries = $this->User->Contact->ResCountry->find('list',array('order'=>'ResCountry.name asc'));
		
		$resRegions = $this->User->Contact->ResRegion->find('list', array(
				'conditions'=> array('ResRegion.country_id'=> $this->data['Contact']['res_country_id']),
				'fields'=> array('id','region'),
				'order'=>'ResRegion.region asc'));
		
		$resCities = $this->User->Contact->ResCity->find('list', array(
				'conditions'=> array('ResCity.region_id'=>$this->data['Contact']['res_region_id']),
				'order'=>'ResCity.name asc'));

		/*$busCountries = $this->User->Contact->BusCountry->find('list');
		$busRegions = $this->User->Contact->BusRegion->find('list', array(
				'conditions'=> array('BusRegion.country_id'=> $this->data['Contact']['bus_country_id']),
				'fields'=> array('id','region')));
		$busCities = $this->User->Contact->BusCity->find('list', array(
				'conditions'=> array('BusCity.region_id'=>$this->data['Contact']['bus_region_id'])));*/


		//Education //
		$this->loadModel('Education');

		$arrObjEducation = $this->Education->listEducationByUserId($this->User->id);

		$education_id = $this->User->id;


		//Employment //
		$this->loadModel('Work');

		$arrObjWork = $this->Work->listWorkByUserId($this->User->id);

		$work_id = $this->User->id;

		$this->set(compact(	'birthCountries','birthRegions','birthCities',
				'resCountries','resRegions','resCities',
				'busCountries','busRegions','busCities',
				'education_id',
				'arrObjEducation',
				'arrObjWork', 'work_id'
		));


	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!is_null($id)) {
			$this->User->id = $id;
		} else {
			$this->User->id = $this->Auth->user('id');
		}
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('users', $this->User->read(null, $id));
		$this->set('countries', $this->Countries->find('list'));
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function profile($id = null) {
		
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		
		

		if (!is_null($id) && $this->User->id !== $this->Auth->user('id')) {
			$this->User->id = $id;
		} else {
			$this->User->id = $this->Auth->user('id');
		}
		$users = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $id),
						'contain' => array(
								'Contact' => array(
										'ResCountry',
										'ResRegion',
										'ResCity',
										'BusCountry',
										'BusRegion',
										'BusCity',
										'BirthCountry',
										'BirthRegion',
										'BirthCity'
								),
								'Picture',
								'Tutor'
						)
				)
		);
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$friends = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $this->Auth->user('id')),
						'contain' => array(
								'Relation_A' => array(
										'User_A',
										'User_B'),
								'Relation_B' => array(
										'User_A',
										'User_B')
						)
				)
		);
		$friendlist = array();
		foreach ($friends['Relation_A'] as $friend) :
		if ($friend['approved']) {
			$friendlist[]['User'] = $friend['User_B'];
		}

		endforeach;
		foreach ($friends['Relation_B'] as $friend) :

		if ($friend['approved']) {
			$friendlist[]['User'] = $friend['User_A'];
		}

		endforeach;
		$isallowed = 0 ;
		foreach ($friendlist as $friend) :

		if ($friend['User']['id'] == $id) {
			$isallowed = 1 ;
			break;
		}

		endforeach;

		$this->set('isallowed', $isallowed);
		$this->set('users', $users);

		$isrelated = 0;
		if ($users['User']['tutor_id'] == $this->Auth->user('id')) $isrelated = 1;
		$this->set('isrelated', $isrelated);
		
		//Education //
		$this->loadModel('Education');
		
		$is_friend =  $this->objLoggedUser->isFriend($id);
		
		$arrObjEducation = $this->Education->listGlobalFriendEducationByUserId($id, $is_friend);
		
		$education_id = $this->User->id;
		
		
		//Employment //
		$this->loadModel('Work');
		
		$arrObjWork = $this->Work->listGlobalFriendWorkByUserId($id, $is_friend);
		
		$this->set(compact(	
				'education_id',
				'arrObjEducation',
				'arrObjWork', 'work_id'
		));
		
		$this->set('objUser', $this->objLoggedUser);
	}


	/**
	 * getByRegion method
	 *
	 * @return void
	 */
	public function getByBirthRegion() {
		$country_id = $this->data['Contact']['birth_country_id'];
		
		$array['0'] = 'Select one';
		
		$regions = $this->User->Contact->BirthRegion->find('list',
				array(	'fields'=> array('id','region'),
						'conditions' =>array('BirthRegion.country_id' => $country_id),
						'order' => array('BirthRegion.region ASC'),
						'recursive'=> -1
				));
		
		foreach ($regions as $key => $value) {
			$array[$key] = $value;
		}

		$this->set('birthRegions', $array);
		$this->layout = 'ajax';

	}

	/**
	 * Pedro Garcia
	 * the getEducationList method render the education list for the AJAX request
	 *
	 * @param unknown_type $id
	 */
	public function getProfileView($id = null){
		$this->User->id = $this->Auth->user('id');

		$this->populateVariables();

		$this->layout = 'ajax';
	}


	/**
	 * Pedro Garcia
	 * the getEducationList method render the education list for the AJAX request
	 *
	 * @param unknown_type $id
	 */
	public function getEducationList($id = null){
		$this->User->id = $this->Auth->user('id');

		$this->loadModel('Education');

		$educations = $this->Education->getEducation($this->User->id);

		$this->set('educations',$educations);
		$this->layout = 'ajax';
	}


	/**
	 * Pedro Garcia
	 * the getEducationListView method render the education list for the AJAX request without Edit/Delete options
	 *
	 * @param unknown_type $id
	 */
	public function getEducationView($id = null){
		$this->User->id = $this->Auth->user('id');

		$this->loadModel('Education');

		$educations = $this->Education->getEducation($this->User->id);

		$this->set('educations',$educations);
		$this->layout = 'ajax';
	}

	/**
	 * Pedro Garcia
	 * the getEmploymentList method render the education list for the AJAX request
	 *
	 * @param unknown_type $id
	 */
	public function getEmploymentList($id = null){
		$this->User->id = $this->Auth->user('id');

		$this->loadModel('Work');

		$works = $this->Work->getWork($this->User->id);

		$this->set('works',$works);
		$this->layout = 'ajax';
	}

	/**
	 * Pedro Garcia
	 * the getEmploymentList method render the education list for the AJAX request
	 *
	 * @param unknown_type $id
	 */
	public function getEmploymentView($id = null){
		$this->User->id = $this->Auth->user('id');

		$this->loadModel('Work');

		$works = $this->Work->getWork($this->User->id);

		$this->set('works',$works);
		$this->layout = 'ajax';
	}


	/**
	 * getByCity method
	 *
	 * @return void
	 * @TODO: create a cache element
	 */

	public function getByBirthCity($id = null) {
		
		$region_id = $this->data['Contact']['birth_region_id'];
		
		$array['0'] = 'Select one';
		$arrUserId = array(0,$this->objLoggedUser->getID());
		
		$cities = $this->User->Contact->BirthCity->find('list',
				array('conditions' =>array('BirthCity.region_id' => $region_id, 'BirthCity.region_id <>' => 0, 'BirthCity.user_id'=>$arrUserId),
						'order' => array('BirthCity.name ASC'),
						'recursive'=> -1
				));
				

		if(count($cities) > 0){
			foreach ($cities as $key => $value) {
				$array[$key] = $value;
			}
		}else{
			$array['0'] = 'Not Cities';
		}
		
		$this->set('birthCities',$array);
		$this->layout = 'ajax';

	}

	/**
	 * getByRegion method
	 *
	 * @return void
	 */
	public function getByBusRegion() {
		$country_id = $this->data['Contact']['bus_country_id'];
		$regions = $this->User->Contact->BusRegion->find('list',
				array(	'fields'=> array('id','region'),
						'conditions' =>
						array('BusRegion.country_id' => $country_id),
						'recursive'=> -1
				));

		$this->set('busRegions',$regions);
		$this->layout = 'ajax';

	}

	/**
	 * getByCity method
	 *
	 * @return void
	 */

	public function getByBusCity($id = null) {
		$region_id = $this->data['Contact']['bus_region_id'];
		$cities = $this->User->Contact->BusCity->find('list',
				array('conditions' =>
						array('BusCity.region_id' => $region_id),
						'recursive'=> -1
				));

		$this->set('busCities',$cities);
		$this->layout = 'ajax';

	}

	/**
	 * getByRegion method
	 *
	 * @return void
	 */
	public function getByResRegion() {
		$country_id = $this->data['Contact']['res_country_id'];
		
		$array['0'] = 'Select one';
		
		$regions = $this->User->Contact->ResRegion->find('list',
				array(	'fields'=> array('id','region'),
						'conditions' =>array('ResRegion.country_id' => $country_id),
						'order' => array('ResRegion.region ASC'),
						'recursive'=> -1
				));

		
		foreach ($regions as $key => $value) {
			$array[$key] = $value;
		}

		$this->set('resRegions',$array);
		$this->layout = 'ajax';

	}

	/**
	 * getByCity method
	 *
	 * @return void
	 */

	public function getByResCity($id = null) {
		$region_id = $this->data['Contact']['res_region_id'];
		
		$array['0'] = 'Select one';
		
		$arrUserId = array(0,$this->objLoggedUser->getID());
		
		$cities = $this->User->Contact->ResCity->find('list',
				array('conditions' =>array('ResCity.region_id' => $region_id, 'ResCity.region_id <>' => 0, 'ResCity.user_id' => $arrUserId),
						'order' => array('ResCity.name ASC'),
						'recursive'=> -1
				));
		
		if(count($cities) > 0){
			foreach ($cities as $key => $value) {
				$array[$key] = $value;
			}
		}else{
			
			$array['0'] = 'Not Cities';
			
		}

		$this->set('resCities',$array);
		$this->layout = 'ajax';

	}

	/**
	 *  savegroupid method
	 *
	 * @return void
	 */
	public function savegroupid($userid) {

		$this->User->GroupsUser->set('user_id', $userid);
		$this->User->GroupsUser->set('group_id', $this->data['GroupsUser']['group_id'.$userid]);
		$this->User->GroupsUser->save();
			
		$grouplist = $this->User->Group->find('list',array('conditions'=>array('Group.user_id'=>$userid)));
		$this->set(compact('grouplist'));

		$friend = $this->User->find('first', array('conditions'=>array('User.id'=>$userid),
				'contain' => array(
						'GroupsUser'=>array(
								'Group'=>array(
										'conditions'=>array(
												'Group.user_id'=>$this->Auth->user('id')
										))))));

		$this->set('friend', $friend);

		$this->layout = 'ajax';
	}
	
	public function addFriendToGroup($userid) {

		$this->layout = 'ajax';
		
		$strErrors = null;
		
		
		if($this->request->is('PUT') || $this->request->is('POST')){
				
			$this->Group->set($this->request->data);
				
			if ($this->GroupsUser->validates(array('fieldList' => array('email','password')))) {
		
				if($this->GroupsUser->save($this->request->data, array('validate' => false))){
		
				}
		
			}else{
				$auxErrors = array();
				foreach($this->GroupsUser->validationErrors as $key => $value){
					foreach($value as $k => $v){
						$auxErrors[] = $v;
					}
				}
				$strErrors = implode('<br>', $auxErrors);
		
			}
		}
		
		
		$this->set('userId', $this->Auth->user('id'));
		
		$this->renderJsonContent(array('boolError' => (count($this->User->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
		
		$this->User->GroupsUser->set('user_id', $userid);
		$this->User->GroupsUser->set('group_id', $this->data['GroupsUser']['group_id'.$userid]);
		$this->User->GroupsUser->save();
			
		/*
		$grouplist = $this->User->Group->find('list',array('conditions'=>array('Group.user_id'=>$userid)));
		$this->set(compact('grouplist'));
	
		$friend = $this->User->find('first', array('conditions'=>array('User.id'=>$userid),
				'contain' => array(
						'GroupsUser'=>array(
								'Group'=>array(
										'conditions'=>array(
												'Group.user_id'=>$this->Auth->user('id')
										))))));
	
		$this->set('friend', $friend);
		*/
	
		$this->layout = 'ajax';
	}
	

	/**
	 * add method
	 *
	 * @return void
	 */


	/**
	 * The add method registers a new user in the data base
	 * All fields are required, the Captcha validation must be return > 0
	 *
	 * @author: Pedro Garcia
	 * @version: 1.0
	 * @return: avoid
	 *
	 */
	public function add(){
		$this->helpers[] = 'Modal';

		if($this->request->is('post')){

			$captcharesult = $this->MathCapt->validate($this->request->data['User']['captcha']);

			$this->request->data['User']['captcha'] = $captcharesult;

			$this->User->set($this->request->data);

			if ($this->User->validates()) {
					
				$this->User->create();

				if ($this->User->save($this->filterWord($this->request->data))) {
					$objUser = $this->User->findById($this->User->getID());
					
					/**
					* If someone invited him to join living alpha, automatically make them friends
					*/
					if(isset($this->request->query['uiwi'])){
						$userIdWhoInvited = $this->myDecode($this->User->myUrlDecode($this->request->query['uiwi']));
						if(is_numeric($userIdWhoInvited) && $userIdWhoInvited >0){
							$objUserWhoInvited = $this->User->findById($userIdWhoInvited);
							try{
								$objUserWhoInvited->addFriend($objUser);
								
								$this->loadModel('Notification');
								$this->Notification->notifyFriendshipAprovalByAlert($objUser, $objUserWhoInvited);
							}catch(Exception $e){
								$this->reportException($e);
							}
						}
					}
					
					
					if(!file_exists($objUser->Picture->getCompletePathToUserUploadFolder($objUser))){
						mkdir($objUser->Picture->getCompletePathToUserUploadFolder($objUser),0777,true);
					}
					
					
					$objUser->setDefaultPicture($objUser->Picture->findById($objUser->getAttr('gender')));
					
					if($objUser->sendActivationEmail()){
						$this->Session->setFlash(__('Your registration has been successful.  You will receive an email with the instructions to activate your account in just a few moments.'));
					}else{
						$this->Session->setFlash(__('Your registration has been done.'));
					}	
						
					$this->redirect(array('controller' => 'users', 'action' => 'index'));
				}
				else{

					//TODO: Launch an exception when the User can't be saved.
					// Launch an administrator warning.
					$this->Session->setFlash(__('Your registration could not be saved. Please, try again.'));
					$this->redirect(array('controller' => 'users', 'action' => 'add'));

				}
			}
			else{

				$this->request->data['User']['captcha'] = '';
			}
		}
		
		$this->loadAditionalJs('bootstrap.javascript.modal');
		$this->loadAditionalCss('bootstrap.javascript.modal');
		$this->loadAditionalCss('bootstrap.miscellaneous.close_icon');
		$this->loadAditionalCss('users');
		

		$this->set('captcha', $this->MathCapt->getCaptcha());
		$this->set('captcha_result', $this->MathCapt->getResult());

	}

	/**
	 * The addEditAjax method:
	 * Add new record when the User.id is null
	 * Edit the record in the User.id
	 *
	 * This method can be access from Ajax
	 *
	 * @deprecated
	 *
	 */
	public function getEditAjax(){


		if(!empty($this->data)){

			//if the education exist then it is udpated
			if(is_null($this->data['User']['id'])){
					
				$this->User->create();
			}


			$this->User->set($this->request->data);


			if ($this->User->saveAll($this->request->data)) {

				$this->Session->setFlash(__('The education has been saved'));
				//$this->redirect(array('action' => 'index'));
			} else {

				$this->Session->setFlash(__('The education could not be saved. Please, try again.'));
			}


		}
		else{

			echo 'Error while adding record';
		}

		$user = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $this->User->id),
						'contain' => array (
								'Contact',
								'Picture',
								'Area'
						)
				)
		);
		$this->set('contact', $user['Contact']);
		$this->set('user', $user);
		$this->set('users', $this->User->find('first', array(
				'conditions' => array('User.id' => $this->Auth->user('id')),
				'contain' => array(
						'Contact'=> array(
								'BirthCountry',
								'BirthRegion',
								'BirthCity'),
						'Picture'
				)
		)
		)
		);

		$birthCountries = $this->User->Contact->BirthCountry->find('list');
		$birthRegions = $this->User->Contact->BirthRegion->find('list', array(
				'conditions'=> array('BirthRegion.country_id'=> $this->data['Contact']['birth_country_id']),
				'fields'=> array('id','region')));
		$birthCities = $this->User->Contact->BirthCity->find('list', array(
				'conditions'=> array('BirthCity.region_id'=>$this->data['Contact']['birth_region_id'])));

		$resCountries = $this->User->Contact->ResCountry->find('list');
		$resRegions = $this->User->Contact->ResRegion->find('list', array(
				'conditions'=> array('ResRegion.country_id'=> $this->data['Contact']['res_country_id']),
				'fields'=> array('id','region')));
		$resCities = $this->User->Contact->ResCity->find('list', array(
				'conditions'=> array('ResCity.region_id'=>$this->data['Contact']['res_region_id'])));

		$busCountries = $this->User->Contact->BusCountry->find('list');
		$busRegions = $this->User->Contact->BusRegion->find('list', array(
				'conditions'=> array('BusRegion.country_id'=> $this->data['Contact']['bus_country_id']),
				'fields'=> array('id','region')));
		$busCities = $this->User->Contact->BusCity->find('list', array(
				'conditions'=> array('BusCity.region_id'=>$this->data['Contact']['bus_region_id'])));


		$this->set(compact(	'birthCountries','birthRegions','birthCities',
				'resCountries','resRegions','resCities',
				'busCountries','busRegions','busCities'
		));
			


		$this->layout = 'ajax';
			
	}


	/**
	 * The addEditAjax method:
	 * Add new record when the User.id is null
	 * Edit the record in the User.id
	 *
	 * This method can be access from Ajax
	 *
	 */
	public function editAjax(){


		$this->autoRender=false;
			
		if($this->request->is('ajax')){

			//TODO: Log process to notify any errors to save the record in the database

			$this->autoRender=false;

			if(!empty($this->data)){

				$this->User->set($this->request->data);
					
				if(!$this->User->validates(array('fieldList' => array('email')))){

					$errors =  $this->User->validationErrors;

					return implode(',',__($errors['email']));
				}
				else{

					if (!$this->User->saveAll($this->request->data, array('validate' => false))) {

						return __('Error while modifying record');
							
					}
				}

			}
			else{

				return __('Error while modifying record');
			}

			return null;
		}

	}



	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 *
	 */
	/**
	 * addrelated method
	 *
	 * @return void
	 */
	public function addrelated() {
		if ($this->request->is('post')) {
			if ($this->Recaptcha->verify()) {
				$this->User->create();
			}


			$this->User->set($this->request->data);


			if ($this->User->saveAll($this->request->data)) {

				$this->Session->setFlash(__('The education has been saved'));
				//$this->redirect(array('action' => 'index'));
			} else {

				$this->Session->setFlash(__('The education could not be saved. Please, try again.'));
			}


		}
		else{

			echo 'Error while adding record';
		}
			
	}


	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 *
	 */
	public function edit($id = null) {
		$relatedusers = $this->User->find('all', array(
				'conditions'=>array('User.tutor_id'=>$this->Auth->user('id'))));
		$this->User->id = '';
		foreach ($relatedusers as $relateduser):
		if ($relateduser['User']['id'] == $id) {
			$this->User->id = $id;
			break;
		}
		endforeach;
		if ($this->User->id == '') $this->User->id = $this->Auth->user('id');

		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}

		$user = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $this->User->id),
						'contain' => array (
								'Contact',
								'Picture',
								'Area'
						)
				)
		);
		$this->set('contact', $user['Contact']);
		$this->set('user', $user);
		$this->set('users', $this->User->find('first', array(
				'conditions' => array('User.id' => $this->Auth->user('id')),
				'contain' => array(
						'Contact'=> array(
								'BirthCountry',
								'BirthRegion',
								'BirthCity'),
						'Picture'
				)
		)
		)
		);

		$birthCountries = $this->User->Contact->BirthCountry->find('list');
		$birthRegions = $this->User->Contact->BirthRegion->find('list', array(
				'conditions'=> array('BirthRegion.country_id'=> $this->data['Contact']['birth_country_id']),
				'fields'=> array('id','region')));
		$birthCities = $this->User->Contact->BirthCity->find('list', array(
				'conditions'=> array('BirthCity.region_id'=>$this->data['Contact']['birth_region_id'])));

		$resCountries = $this->User->Contact->ResCountry->find('list');
		$resRegions = $this->User->Contact->ResRegion->find('list', array(
				'conditions'=> array('ResRegion.country_id'=> $this->data['Contact']['res_country_id']),
				'fields'=> array('id','region')));
		$resCities = $this->User->Contact->ResCity->find('list', array(
				'conditions'=> array('ResCity.region_id'=>$this->data['Contact']['res_region_id'])));

		$busCountries = $this->User->Contact->BusCountry->find('list');
		$busRegions = $this->User->Contact->BusRegion->find('list', array(
				'conditions'=> array('BusRegion.country_id'=> $this->data['Contact']['bus_country_id']),
				'fields'=> array('id','region')));
		$busCities = $this->User->Contact->BusCity->find('list', array(
				'conditions'=> array('BusCity.region_id'=>$this->data['Contact']['bus_region_id'])));

		//Education //
		$this->loadModel('Education');
		$edulevels = $this->Education->Edulevel->find('list', array('order'=>'name'));

		$institutes = $this->Education->Institute->find('list', array('order'=>'name'));

		$educations = $this->Education->getEducation($this->User->id);

		$education_id = $this->User->id;


		//Employment //
		$this->loadModel('Work');
		$workplaces = $this->Work->Workplace->find('list', array('order'=>'name'));

		$specialities = $this->Work->Specialty->find('list', array('order'=>'name'));

		$works = $this->Work->getWork($this->User->id);

		$work_id = $this->User->id;

		$cities = array();
		$this->loadModel('City');

		$result = $this->City->find('all',array('contain'=> array('Region','Country')));

		foreach ($result as $city) :
		$cities[$city['City']['id']] = $city['City']['name'].', '.$city['Region']['region'].', '.$city['Country']['name'];
		endforeach;
		$this->set('cities', $cities);

		$this->set(compact(
				'birthCountries','birthRegions','birthCities',
				'resCountries','resRegions','resCities',
				'busCountries','busRegions','busCities',
				'edulevels','institutes','educations', 'education_id',
				'workplaces', 'specialities', 'works', 'work_id'
		));

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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function relatedusers() {
		$this->set('users', $this->User->find('first', array(
				'conditions' => array('User.id' => $this->Auth->user('id')),
				'contain' => array(
						'Contact' => array(
								'ResCountry',
								'ResRegion',
								'ResCity'),
						'Picture',
						'Relation_A'=>array('Relationship_A'),
						'Relation_B'=>array('Relationship_B')
				)
		)
		)
		);

	}
	public function login() {
		$this->helpers[] = "Modal";
		$this->loadAditionalCss('bootstrap.basecss.buttons'); 
		$this->loadAditionalCss('bootstrap.components.alert');
		$this->loadAditionalJs('bootstrap.components.alert');
		
		if ($this->Auth->login()) {
			$this->User->id = $this->Auth->user('id');
			$this->User->savefield('online',1);
			$this->User->savefield('last_login',date('Y-m-d H:i:s'));
			$this->redirect($this->Auth->redirect());
		} 
		
		else {

				$fbObjUser = null;
				
				if ($this->request->is('post')) {
					
					$fbObjUser = $this->User->findByEmail($this->request->data['User']['username']);
					
					if(is_int($fbObjUser) && $fbObjUser == 0){
					
						$this->Session->setFlash(__( 'Your email is not associated with any livingalpha account.'));
					}
					elseif(is_object($fbObjUser)){
						
						
						$this->request->data['User']['username'] = $fbObjUser->getAttr('username');
						
						
						if($this->Auth->login()){
							
							if($this->Auth->user('id')){
								$this->User->id = $this->Auth->user('id');
								$this->User->savefield('online',1);
								$this->User->savefield('last_login',date('Y-m-d H:i:s'));
								
								$this->redirect($this->Auth->redirect());
							}
						}
						
						if($fbObjUser->notifyPasswordChange(true)){
								
							$this->Session->setFlash(__( 'Your email is associated with your Facebook account. An email has been sent to create a new password for living alpha.'));
						}
						
					}
					else{
						$this->Session->setFlash(__('Invalid username or password, try again'));
					}				
					
				}
		}
	}

	public function logout() {
		$this->User->id = $this->Auth->user('id');
		$this->User->savefield('online',0);
		$this->Auth->logout();
		$this->Session->destroy();
		
		Cache::clear();
		$this->redirect(array('controller'=>'/', 'action' => 'index'));
	}


	function beforeFacebookSave() {
		
		
		/*$this->Connect->authUser['User']['email'] = $this->Connect->user('email');
		$this->Connect->authUser['User']['username'] = $this->Connect->user('username');
		$this->Connect->authUser['User']['firstname'] = $this->Connect->user('first_name');
		$this->Connect->authUser['User']['lastname'] = $this->Connect->user('last_name');
		$this->Connect->authUser['User']['gender'] = $this->Connect->user('gender');
		$this->Connect->authUser['User']['dob'] = $this->Connect->user('birthday');
		$this->Connect->authUser['User']['about_me'] = $this->Connect->user('quotes');
		$this->LoadModel('Contact');*/
		return true;

	}

	 function facebookSingUp(){
	 	
	 	if(!empty($this->Connect->uid)){
	 		
	 		$first_name = $last_name = 'Not Specified';
	 		
	 		if(!is_null( $this->Connect->user('first_name'))){
	 			$first_name = $this->Connect->user('first_name');
	 		}
	 		
	 		if(!is_null( $this->Connect->user('last_name'))){
	 			$last_name = $this->Connect->user('last_name');
	 		}
	 		
	 		
	 		//sign up
	 		$fb_user['User']['facebook_id'] 	= $this->Connect->uid;
	 		$fb_user['User']['username'] 		= $this->Connect->user('username');
	 		$fb_user['User']['firstname'] 		= $first_name;
	 		$fb_user['User']['lastname'] 		= $last_name;
	 		$fb_user['User']['email'] 			= $this->Connect->user('email');
	 		$fb_user['User']['active'] 			= 1;
	 		$fb_user['User']['agreement'] 		= 'Y';
	 			 		
		 	$objUser = $this->User->findByFacebookId($this->Connect->uid);
		 	
		 	if(!isset($objUser->data['User']['id']) && !empty($this->Connect->uid)){
		 		
		 		if(!$this->User->save($fb_user, array('validate'=>false))){
		 			
		 			debug($this->User->validationErrors);
		 		}
		 		
		 		$fb_user['User']['id']  = $this->User->getID();
		 		
		 		$this->Auth->authenticate = array(
		 				'Form' => array(
		 						'fields' => array('username' => 'facebook_id')
		 				)
		 		);

		 	}
		 	else{
		 		
		 		$fb_user['User']['id']  = $objUser->getAttr('id');
		 		
		 	}
		 	
			 	
		 	if($this->Auth->login($fb_user['User'])){
		 		
		 		
		 		//If OAuth Living Server has been set, redirect to the landing page.
		 		$OAuthParams = $this->Session->read('OAuth.params');
		 			
		 		if(!empty($OAuthParams)){
		 			
			 		$code = $this->getAuthResult(true, $OAuthParams);
			 		
			 		$this->set('isLogged', true);
			 		$this->set('redirectURL', $code[0].'?code='.$code[1]['query']['code']);
			 		
			 		$this->render('external_login');
		 		}
		 		else{
		 			
		 			$this->objLoggedUser = $objUser;
		 			 
		 			$this->redirect(array('controller' => 'users', 'action' => 'index'));		 			
		 		}

		 	}
		 	else{
		 		
		 		debug($fb_user['User']);
		 		exit;
		 	}
	 	}
	 	else{
	 		
	 		//@TODO:The FB component doesn't return the uid. This would be handle.
	 		echo 'error';
	 		debug($this->Connect);
	 		exit;
	 	}
	 	
	}
	 
	

	/*
	 * @TODO: move it to the Model
	 * 
	 */
	public function friends($ini = null) {
		
		$this->set('users', array('User'=>array('id'=> $this->objLoggedUser->getID())));
		
		$arrayObjFriend = $this->objLoggedUser->listFriend();
		
		$arrayObjFriendFiltered = array();
		
			
		foreach ($arrayObjFriend as $key => $value) {
				
			
			$arrayObjFriend[$key]->Contact->loadObject('ResCity');
			//$arrayObjFriend[$key]->findFriendStatus($this->objLoggedUser->getAttr('id'));
			
			if(!empty($ini)){
				if( strtolower(substr($arrayObjFriend[$key]->getAttr('username'), 0, 1)) == strtolower($ini)){
				
					$arrayObjFriendFiltered[$key] = $arrayObjFriend[$key];
				}
			}
			else{
				
				$arrayObjFriendFiltered[$key] = $arrayObjFriend[$key];
			}
		}
			
		$this->set('arrayObjFriend', $arrayObjFriendFiltered);
		$this->set('objUser', $this->objLoggedUser);

	}


	public function findFriends($ini = null) {

		$this->set('users', array('User'=>array('id'=> $this->objLoggedUser->getAttr('id'))));
		
		$this->loadAditionalCss('users');
			
	}

	public function findFriend() {
		
		$this->loadAditionalCss('users');
		
		$result = array();
		
		if (isset($_POST['data']['q']) && $_POST['data']['q']!=null) {
			
			$arrayObjFriend = $this->objLoggedUser->findUsers($_POST['data']['q']);
			
			
			foreach ($arrayObjFriend as $key => $value) {
			
				$arrayObjFriend[$key]->Contact->loadObject('ResCity');
				$arrayObjFriend[$key]->findFriendStatus($this->objLoggedUser->getAttr('id'));
			
			}
			
			$this->set('arrayObjFriend', $arrayObjFriend);
			$this->set('objUser', $this->objLoggedUser);

		}
		
		$this->set('results', $result);
		
		$this->layout = 'ajax' ;
			
	}

	//This needs to be reimplemeted was originaly designed by Drew.

	public function checkFriend($id) {
		$me = intval($this->Auth->user('id'));
		$sql = "SELECT id FROM relations ".
				"WHERE (profile1_id={$me} AND profile2_id=".intval($id).") ".
				"OR (profile1_id=".intval($id)." AND profile2_id={$me})";
		$result = $this->User->query($sql);
		if (count($result)) return true;
		else return false;
	}

	/**
	 * Add friend
	 * @TODO: this method must be rewritten again.
	 * 
	 * @param unknown_type $id
	 */
	public function addFriend($id) {
		if ($this->checkFriend($id)) {
			$this->Session->setFlash(__("You already have a pending friendship with this user."));
			$this->redirect(array('controller' => 'users', 'action' => 'friends'));
			return;
		}
		$me = $this->Auth->user('id');
		$sql = "INSERT INTO relations (profile1_id, profile2_id, relationship1_id, relationship2_id) VALUES ({$me}, ".intval($id).", 1, 1)";
		$this->User->query($sql);
		
		//Show the friend name
		
		$friend = $this->User->getUserById($id);
		$friendname = '';
		
		if(is_object($friend)){
			
			$friendname = $friend->getAttr('firstname')." ".substr($friend->getAttr('lastname'), 0, 1).'.';
		}
		
		$this->Session->setFlash(__("You have added {$friendname} as a friend"));
		

		$this->redirect(array('controller' => 'users', 'action' => 'friends'));
	}
	
	public function addFriendAjax(){
		
		$this->loadModel('Relation');
		$this->layout = 'ajax';
		$this->render(false);
		
		$strErrors = null;
		
		
		if($this->request->is('PUT') || $this->request->is('POST')){
			
			if($this->objLoggedUser->findFriendStatus($this->request->data['friendId']) == 0){
		
				$this->Relation->set('profile1_id'		, $this->objLoggedUser->getAttr('id'));
				$this->Relation->set('profile2_id'		, $this->request->data['friendId']);
				$this->Relation->set('relationship1_id'	, 1);
				$this->Relation->set('relationship2_id'	, 1);
			
				if ($this->Relation->validates()) {
			
					if($this->Relation->save($this->request->data, array('validate' => false))){
			
					}
			
				}else{
					$auxErrors = array();
					foreach($this->Relation->validationErrors as $key => $value){
						foreach($value as $k => $v){
							$auxErrors[] = $v;
						}
					}
					$strErrors = implode('<br>', $auxErrors);
			
				}
			}
			else{
				
			}
		}
		
		
		$this->renderJsonContent(array('boolError' => (count($this->Relation->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));	

	}

	// Return the id for the reciprocal relation type (ie, grandfather and grandson)
	public function recipRelation($relation) {

	}

	// Argument is the id of the relationship record
	public function acceptFriendship($id) {
		$this->loadModel('Relation');
		$me = intval($this->Auth->user('id'));

		$data['Relation']['id'] = $id;
		$data['Relation']['approved'] = 1;

		$this->loadModel('Relation');
		
		$objRelation = $this->Relation->findById($id);
		
		if($objRelation->getAttr('profile1_id') == $me){
			$objUserToBeNotified = $this->User->findById($objRelation->getAttr('profile2_id'));
		}else{
			$objUserToBeNotified = $this->User->findById($objRelation->getAttr('profile1_id'));
		}
		
		$objUserAcceptedFriendship = $this->User->findById($me);
		
		$this->loadModel('Notification');
		$this->Notification->notifyFriendshipAprovalByAlert($objUserAcceptedFriendship, $objUserToBeNotified);
		
		$this->Relation->save($data);
		
		$this->redirect(array('controller' => 'users', 'action' => 'friends'));
	}

	/**
	 * Used to activate the user. There is a link on the Activation Email to this action.
	 */
	public function activate($code) {
		$arr = $this->myDecode($this->User->myUrlDecode($code));
		if(!is_numeric($arr['user_id'])){
			$this->Session->setFlash('Invalid link');
			$this->redirect('login');
			exit();
		}
		$objUser = $this->User->findById($arr['user_id'],array(),0);
		if($objUser->activate()){
			$this->Session->setFlash('Your account has been activated and you can now start using our website.');
			$this->redirect('index');
		}else{
			$this->Session->setFlash('There was a problem activating your account, please try again later.');
			$this->redirect('login');
		}
		exit();
	}

	/**
	 * This action is called when a user try to login and is not active.
	 * Just exhibith a message
	 */
	public function msgActivate(){
		
	}

	/**
	 * @author: Pedro Garcia
	 *
	 * The filterWord method filter and sanitize the searched word.
	 * This method must be improved in the future
	 *
	 * @param String $word
	 */
	private function filterWord($word = array()){

		//$word = Sanitize::paranoid($word, array(' ', '@', '_', '-', '.','/'));

		//TODO: any other filters

		return $word;
	}

	/**
	 * Handles the forgot password feature.
	 * It gets the submited Username and captcha. It checks if the captcha is correct and the username exists
	 * If so, it is sent an email with a link to the user set a new password
	 */
	public function forgot_password(){

		if ($this->request->is('post')) {
			if($this->MathCapt->validate($this->request->data['User']['captcha'])){
					
				$objUser = $this->User->findUserByEmailOrUsername($this->request->data['User']['username']);
				
				if(is_object($objUser) && $objUser->getID()){

					if($objUser->sendForgotPasswordEmail()){
						$this->Session->setFlash('An Email with instructions of how to reset your password has been sent to your email.');
						$this->redirect('login');
					}else{
						$this->Session->setFlash('Error sending email');
					}

				}else{
					$this->Session->setFlash('Username was not found. Please check your username.');
				}


			} else {
				$this->Session->setFlash('You must provide the right answer to the math question.');
			}
		}

		$this->set('captcha', $this->MathCapt->getCaptcha());
		
		$this->loadAditionalCss('bootstrap.components.alert');

	}

	/**
	 * Handles the forgot username feature.
	 * It gets the submited Email and captcha. It checks if the captcha is correct and the email exists
	 * If so, I get all Users with that e-mail, list the username of all of them, and send the list to the e-mail.
	 */
	public function forgot_username(){

		if ($this->request->is('post')) {
			if($this->MathCapt->validate($this->request->data['User']['captcha'])){

				$objUser = $this->User->getUserByEmail($this->request->data['User']['email']);

				if(is_object($objUser)){

					if($objUser->sendForgotUsernameEmail()){
						$this->Session->setFlash('An email with you username has been sent to you');
						$this->redirect('login');
					}else{
						$this->Session->setFlash('Error sendind email');
					}

				}else{
					$this->Session->setFlash('Email not found.');
				}


			} else {
				$this->Session->setFlash('You must provide the right answer to the math question.');
			}
		}
		unset($this->request->data['User']['captcha']);
		$this->set('captcha', $this->MathCapt->getCaptcha());
		
		$this->loadAditionalCss('bootstrap.components.alert');

	}

	/**
	 * Handles the process of setting the new password for the user.
	 * The user gets here following a link on the email he receives when he wants to recuperate his password.
	 * The link is valid for one hour if the delay hasn't been set.
	 * 
	 */
	function new_password($hash=''){
		
		$delay = 60;
		
		$hashValue = $this->myDecode($this->User->myUrlDecode($hash));

		if(!$hash || (!is_array($hashValue)) || !$hashValue['user_id']){
			$this->Session->setFlash('Invalid link');
			$this->redirect('forgot_password');
			exit();
		}
		
		$delay = (isset($hashValue['delay']))? $hashValue['delay'] : $delay;
		
		if($hashValue['date_generated'] < date('YmdHi') - $delay || $hashValue['date_generated'] > date('YmdHi')){
			$this->Session->setFlash('The link has expired.');
			$this->redirect('forgot_password');
			exit();
		}

		$this->set('hash', $hash);
		if(!is_object($this->objLoggedUser)){
			$this->objLoggedUser = $this->User->findById($hashValue['user_id']);
		}
		$this->set('objUser', $this->objLoggedUser);
		
		$this->loadAditionalCss('bootstrap.components.alert');

		if($this->request->is('post')){

			if($this->request->data['User']['password'] != $this->request->data['User']['password_confirmation']){
				$this->Session->setFlash('Password and Password Combination does not match.');
			}else{
				$objUser = $this->User->getUserById($hashValue['user_id']);
				if(is_object($objUser)){
					if($objUser->setNewPassword($this->request->data['User']['password'])){
						$this->Session->setFlash('Your password has been changed successfully.  Please use your new password to log in from now on.');
						$this->redirect('login');
						exit();
					}else{
						
						$this->Session->setFlash('Check the password');
					}
				}else{
					$this->Session->setFlash('Unkown Error');
				}
			}
		}

	}

	/**
	 * Handles the process of changing the password of the user
	 * First, we check the old Password, if it is correct we send an e-mail with a token that must be put in the second field
	 * if the token is ok. We save the new password.
	 * The token is valid for 10 minutes
	 */
	function change_password(){
		$token = ClassRegistry::init('Token');


		$users = $this->User->find('first',
				array(
						'conditions' => array('User.id' => $this->Auth->user('id')),
						'contain' => array(
								'Contact',
								'Picture',
								'Tutor'
						)
				)
		);
		$this->set('user',$users);

		$objUser = $this->User->getUserById($this->Auth->user('id'));
		$this->set('state','step1');

		if($this->request->is('post')){

			if(!$objUser->checkPasswordForUser($this->request->data['User']['password'])){
				$this->set('errorsForm',true);
				$this->Session->setFlash('Invalid Old Password');
				return true;

			}

			$token = ClassRegistry::init('Token');

			if(!$token->validateTokenByTime($this->request->data['User']['token'], $objUser->data['User']['id'], 10)){
				$this->set('errorsForm',true);
				$this->Session->setFlash('The token is not valid or is expired!');
				return true;
			}

			if(!$this->request->data['User']['new_password'] || $this->request->data['User']['new_password'] != $this->request->data['User']['new_password_confirmation']){
				$this->set('errorsForm',true);
				$this->Session->setFlash('Please check your new password and the new password confirmation.');

				return true;
			}

			if($objUser->setNewPassword($this->request->data['User']['new_password'])){
				$this->Session->setFlash('Your password has been changed!');
				$this->redirect('index');
				exit();
			}

		}
		
		$this->loadAditionalCss('bootstrap.components.alert');
		$this->loadAditionalCss('users');
	}

	/**
	 * AJAX
	 * Check if the Request Password is the logged user password
	 */
	function validatePasswordForLoggedUser(){
		$objUser = $this->User->getUserById($this->Auth->user('id'));

		echo json_encode(array('boolCorrectPassword'=> $objUser->checkPasswordForUser($this->request->data['password']) ));
		exit();
	}

	/**
	 * AJAX
	 * To send the email with the token to the user.
	 */
	function send_token_to_user(){
		$objUser = $this->User->getUserById($this->Auth->user('id'));

		$objUser->sendEmailWithToken();
		exit();
	}

	/**
	 * The profileView method renders the User Profile
	 *
	 */
	public function profileView(){

		$this->layout = 'ajax';

		$this->populateVariables();
		
		$this->renderJsonContent();

	}

	/**
	 * The profileEdit method edit the Base User Profile
	 *
	 */
	public function profileEdit(){
		$this->layout = 'ajax';
		
		$strErrors = null;


		if($this->request->is('PUT') || $this->request->is('POST')){
			
			$this->request->data['User']['id'] = $this->objLoggedUser->getAttr('id');
			if(isset($this->request->data['Contact']['newResCity']) && $this->request->data['Contact']['newResCity']){
				$objCity = $this->objLoggedUser->insertCity($this->request->data['Contact']['newResCity'],$this->request->data['Contact']['res_region_id']);
				if($objCity->getID()){
					$this->request->data['Contact']['res_city_id'] = $objCity->getID();
				}	
			}
			
			if(isset($this->request->data['Contact']['newBirthCity']) && $this->request->data['Contact']['newBirthCity']){
				$objCity = $this->objLoggedUser->insertCity($this->request->data['Contact']['newBirthCity'],$this->request->data['Contact']['birth_region_id']);
				if($objCity->getID()){
					$this->request->data['Contact']['birth_city_id'] = $objCity->getID();
				}	
			}
			
			$this->User->set($this->request->data);
			
			if ($this->User->validates(array('fieldList' => array('email','password')))) {

				if($this->User->saveAll($this->request->data, array('validate' => false))){
				
					$this->redirect('profileView/');
					exit();
				}
				
			}else{
				$auxErrors = array();
				foreach($this->User->validationErrors as $key => $value){
					foreach($value as $k => $v){
						$auxErrors[] = $v;
					}
				}
				$strErrors = implode('<br>', $auxErrors);
				
			}
		}

		$this->populateVariables();

		$this->set('userId', $this->Auth->user('id'));
		
		$this->renderJsonContent(array('boolError' => (count($this->User->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
	}
	
	/**
	 * The inviteFriends method sends email to your friends
	 */
	public function inviteFriends(){
		$this->layout = 'ajax';
		
		$strErrors = null;
		
		$bbc = array();
		
		if($this->request->is('PUT') || $this->request->is('POST')){
			
			foreach($this->data['User']['emailaddress'] as $key => $value){
				if(!empty($value)){
					if(!Validation::email($value)){
						$strErrors = __('You must provide a valid email address.');
					}
					else{
						$bbc[] = $value;
					}
				}
			}
			
			
			if($strErrors === null ){
				if(!$this->objLoggedUser->inviteFriends($bbc)){
					$strErrors = __('The email could not be sent');
				}else{
					$this->request->data = null;
					$this->Session->setFlash('Invitations sent.','greenFlash',array(),'inviteFriends');
				}
			}
				
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
		
	}
	
	public function shareJournal(){
		
		$this->layout = 'ajax';
		
		$strErrors = null;
		
		$bbc = array();
		
		if($this->request->is('PUT') || $this->request->is('POST')){
			
			foreach($this->data['User']['emailaddress'] as $key => $value){
				if(!empty($value)){
					if(!Validation::email($value)){
						$strErrors = __('You must provide a valid email address.');
					}
					else{
						$bbc[] = $value;
					}
				}
			}
				
				
			if($strErrors === null ){
				if(!$this->objLoggedUser->shareJournal($bbc, $this->data['User']['journalId'])){
					$strErrors = __('The email could not be sent');
				}else{
					$this->request->data = null;
				}
			}
		
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
		
	}
	
	
	public function externalLogin(){
		

		$this->layout = false;
		
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');
		
		//OAuth protocol
		$this->OAuth->authenticate = array('fields' => array('username' => 'username', 'password'=>'password'));
		$this->Auth->allow($this->OAuth->allowedActions);
		$this->Security->blackHoleCallback = 'blackHole';
		
		
		$OAuthParams = $this->Session->read('OAuth.params');
		
		if(empty($OAuthParams))
			$OAuthParams = $this->OAuth->getAuthorizeParams();
		
		$this->set('oAuthParams', $OAuthParams);
		
		$this->set('isLogged', false);
		
		//Write this to session so we can log them out after authenticating
		$this->Session->write('OAuth.logout', true);
		
		//Write the auth params to the session for later
		$this->Session->write('OAuth.params', $OAuthParams);
		

		if ($this->Auth->login()) {
			
			$this->User->id = $this->Auth->user('id');
			$this->User->savefield('online',1);
			$this->User->savefield('last_login',date('Y-m-d H:i:s'));
			
			$data = array('Client'=>array('redirect_uri'=>$OAuthParams['redirect_uri'], 'user_id'=>$this->User->getID()));
			
			debug($OAuthParams);
			
			$code = $this->getAccessCode($data);
			
			$OAuthParams = $this->Session->delete('OAuth.params');
			
			$this->set('isLogged', true);
			$this->set('redirectURL', $code[0].'?code='.$code[1]['query']['code']);

		}
		else {
		
			$fbObjUser = null;
		
			if ($this->request->is('post')) {
					
				//LOGIN FROM USERNAME/EMAIL
				$fbObjUser = $this->User->findUserByEmailOrUsername($this->request->data['User']['username']);
					
				//@TODO: When the email is associated with more than one account, the workflow must be implememted later. Now, the system will show an error.
				if(is_int($fbObjUser) && $fbObjUser == 0){
						
					$this->Session->setFlash(__('Your username or email have not been associated with any livingalpha account.'));
					
				}
				elseif(is_object($fbObjUser)){
		
		
					$this->request->data['User']['username'] = $fbObjUser->getAttr('username');
		
					//LOGIN FROM EMAIL
					if($this->Auth->login()){
							
						if($this->Auth->user('id')){
							$this->User->id = $this->Auth->user('id');
							$this->User->savefield('online',1);
							$this->User->savefield('last_login',date('Y-m-d H:i:s'));
							
							$data = array('Client'=>array('redirect_uri'=>$OAuthParams['redirect_uri'], 'user_id'=>$this->User->getID()));
								
							$code = $this->getAccessCode($data);
							
							$OAuthParams = $this->Session->delete('OAuth.params');
							
							$this->set('isLogged', true);
							$this->set('redirectURL', $code[0].'?code='.$code[1]['query']['code']);
							
						}
					}
					else{

						//@TODO: LAUNCH THE ERROR MESSAGE, THE ACCOUNT IS ASSOCIATED TO THE FACEBOOK ACCOUNT OR THE ARE ERROR IN USERNAME/PASSWORD
						if($fbObjUser->getAttr('facebook_id')){
							
							if($fbObjUser->notifyPasswordChange(true)){
							
								$this->Session->setFlash(__( 'Your email is associated with your Facebook account. An email has been sent to create a new password for living alpha.'));
							}
						}
						else{
							
							$this->Session->setFlash(__('Invalid username or password, try again'));
						}
					}
		
				}
				else{
					$this->Session->setFlash(__('Invalid username or password, try again'));
				}
					
			}
		}	

	}
	
	/**
	 * Check for any Security blackhole errors
	 *
	 * @throws BadRequestException
	 */
	private function validateRequest() {
		if ($this->blackHoled) {
			//Has been blackholed before - naughty
			throw new BadRequestException(__d('OAuth', 'The request has been black-holed'));
		}
	}
	
	public function externalRegistration(){
		
		$this->helpers[] = 'Modal';
		
		$this->layout = false;
		
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');
		
		$OAuthParams = $this->Session->read('OAuth.params');
		
		
		if(empty($OAuthParams))
			$OAuthParams = $this->OAuth->getAuthorizeParams();
		
		$this->set('oAuthParams', $OAuthParams);
		
		
		if($this->request->is('post')){
		
			$captcharesult = $this->MathCapt->validate($this->request->data['User']['captcha']);
		
			$this->request->data['User']['captcha'] = $captcharesult;
			$this->request->data['User']['active'] 	= 1;
		
			$this->User->set($this->request->data);
		
			if ($this->User->validates()) {
					
				$this->User->create();
				
				debug($this->request->data);
		
				if ($this->User->save($this->filterWord($this->request->data))) {
					
					$objUser = $this->User->findById($this->User->getID());
						
					/**
					 * If someone invited him to join living alpha, automatically make them friends
					 */
					if(isset($this->request->query['uiwi'])){
						$userIdWhoInvited = $this->myDecode($this->User->myUrlDecode($this->request->query['uiwi']));
						if(is_numeric($userIdWhoInvited) && $userIdWhoInvited >0){
							$objUserWhoInvited = $this->User->findById($userIdWhoInvited);
							try{
								$objUserWhoInvited->addFriend($objUser);
							}catch(Exception $e){
								$this->reportException($e);
							}
						}
					}
						
						
					if(!file_exists($objUser->Picture->getCompletePathToUserUploadFolder($objUser))){
						mkdir($objUser->Picture->getCompletePathToUserUploadFolder($objUser),0777,true);
					}
						
						
					$objUser->setDefaultPicture($objUser->Picture->findById($objUser->getAttr('gender')));
					
					if($this->Auth->login($objUser->data['User'])){
						
						$data = array('Client'=>array('redirect_uri'=>$OAuthParams['redirect_uri'], 'user_id'=>$this->User->getID()));
							
						$client = $this->OAuth->Client->add($data);
						
						$client['Client']['response_type'] = 'code';
							
						$code = $this->getAuthResult(true, $client['Client']);
						
						$objUser->sendExternalSignUpConfirmation($code);						
							
					}
					
					$this->set('isLogged', true);
					$this->set('redirectURL', $code[0].'?code='.$code[1]['query']['code']);	
					
				}
				else{
		
					//TODO: Launch an exception when the User can't be saved.
					$this->Session->setFlash(__('Your registration could not be saved. Please, try again.'));
					$this->redirect(array('controller' => 'users', 'action' => 'add'));
		
				}
			}
			else{
		
				$this->request->data['User']['captcha'] = '';
			}
		}		
		
		$this->loadAditionalJs('bootstrap.javascript.modal');
		$this->loadAditionalCss('bootstrap.javascript.modal');
		$this->loadAditionalCss('bootstrap.miscellaneous.close_icon');
		$this->loadAditionalCss('users');
		
		
		$this->set('captcha', $this->MathCapt->getCaptcha());
		$this->set('captcha_result', $this->MathCapt->getResult());
		
	}
	
	private function getAuthResult($autorized = true, $oAuthParams = NULL){

		try {
				
			$code = $this->OAuth->getAuthResult(true, $this->Auth->user('id'), $oAuthParams);
		
			$this->set('isLogged', true);
			$this->set('redirectURL', $code[0].'?code='.$code[1]['query']['code']);
			
			return $code;
				
		} catch (OAuth2RedirectException $e) {
				
			debug($e->sendHttpResponse());
		}
	}
	
	public function getAccessCode($param = array()){
		

		
		 if($oauth = $this->OAuth->Client->findKeyByUserIdAndURI($param)){
		 	
		 	$code[] = $oauth['Client']['redirect_uri'];
		 	$code[] = array('query'=>array('code' => $this->OAuth->hash($oauth['AuthCode'][0]['code'])));
		 	
		 	return $code;
		 }
		 else{
		 	
		 	$client = $this->OAuth->Client->add($param);
		 	 
		 	$client['Client']['response_type'] = 'code';
		 	
		 	return $this->getAuthResult(true, $client['Client']);
		 	
		 }
		 
		 
	}
	
	public function createOAuthClient($param){
		
		debug($this->OAuth->Client->add($param));
	}
	

}
