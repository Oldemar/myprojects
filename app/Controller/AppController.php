<?php
App::uses('Controller', 'Controller');
App::uses('CakeTime', 'Utility');

class AppController extends Controller {
	
	public $helpers = array('Js', 'Html', 'Form', 'Session', 'CachedElement','Facebook.Facebook','Image');

	//We are using Facebook login & Auth Component based on the existing cakephp Plugin	
	public $components = array(
		'Session',
		'Email',
		'Auth' => array(
				'authenticate' => array(
					'Form' => array(
						'fields' => array('username' => 'username', 'password' => 'password'),
						)	
					),
          	'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
           	'logoutRedirect' => array('controller' => 'users', 'action' => 'logout'),
          	'authorize' => array('Controller')
        ),
		'MathCapt',
		'Facebook.Connect',
		'OAuth.OAuth'
	);
	
	public $objLoggedUser = null;
	private $additionalCss = array();
	private $additionalJs = array();
	private $additionalJsTmp = array();

	function beforeFilter(){
		if($this->Auth->user('id')){
			$this->loadModel('User');
		
			$this->objLoggedUser = $this->User->findById($this->Auth->user('id'));
			
			/**
			 * Wallace
			 * Oct 15 2012
			 * Check if the user that is logged is active. 
			 * If not he will be redirected to a page informing that he needs to activate his account
			 */
			 
			 if(!$this->objLoggedUser->checkIsActive()){
			 	$this->objLoggedUser->sendActivationEmail();
				$this->logoutUser();
				
				/**
				 * SetFlash is not working
				 */
				//$this->Session->setFlash(__('Your account is not active. Check your email for instruction to activate your account.'));
				
				$this->redirect(array('controller'=>'users','action'=>'msgActivate'));
				exit();
				
			 }
			 
			 $this->OAuth->allow();
		}
		
		
		$this->set('objLoggedUser', $this->objLoggedUser);
		
		$this->set('objController',$this);
		
		
		//debug($this->objLoggedUser);
		/*
		 * Auth component initial setup
		 */	
		$this->Auth->Allow('display'); //This is used to allow users to navigate into the main index page of the site without loggin in.
		$this->Auth->authError = 'Please Log In to view that page';
		$this->Auth->loginError = 'Incorrect Alpha username/password.';
		
		
		$this->set('logged_in', $this->_loggedIn());
		$this->set('username', $this->_username());
		$this->set('userFullName', $this->_userFullName());
		//$this->set('facebook_user', $this->Connect->user());
		
		
		/**
		 * WHO: Wallace
		 * WHEN: October 10th
		 * WHAT: Removed the query about related users that was executed here to improve performance
		 * I moved it to the method AppController::loadRelatedUsers()
		 * Call this method when you need that array  
		 */
		 $this->loadRelatedUsers();
		 
		 $this->set('uid', $this->Connect->uid);
		 
	}
	
	public function loadRelatedUsers(){
		if($this->_loggedIn()){
			
			$this->loadModel('Relation');
			
			$frRq = $this->Relation->find('all', array(
									'conditions'=> array(
										'Relation.profile2_id'=>$this->Auth->user('id'),
										'Relation.approved'=>null),
									'contain'=>array(
										'User_A'=>array(
											'Picture',
											'Contact'=>array(
												'ResCountry',
												'ResRegion',
												'ResCity')))));
			$this->set('frRqs', $frRq);
		
		/*
		 *  Populate an array that contain related users
		 */

			$this->loadModel('User');
			/*$relatedusers = $this->User->find('all', array(
								'conditions'=>array(
									'User.tutor_id'=>$this->Auth->user('id')),
								'contain'=>array(
									'Picture',
									'Tutor',
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
									'Area',
									'Relation_A'=>array('Relationship_A'),
									'Relation_B'=>array('Relationship_B')
								)));
			$this->set('relatedusers', $relatedusers);

			$relateduserlist = $this->User->find('list', array(
							'conditions'=>array('OR'=>array('User.tutor_id'=>$this->Auth->user('id'),'User.id'=>$this->Auth->user('id')))));
			$this->set(compact('relateduserlist'));*/
		
			/*
			 *  Populate an array that contain relationships
			 
	
			$this->loadModel('Relationship');
			$relatedusers = $this->Relationship->find('list');
			$this->set('relationship', $relationship);
			*/

			/*
			 *  Populate an array that contain not viewd journals
			*/
			/*$this->loadModel('Journal');
			$notviewedjournals = $this->Journal->find('all', array(
									'conditions'=>array(
										'Journal.user_id'=>$this->Auth->user('id')),
									'contain'=>array(
										'Photo',
										'Comment'=>array(
											'conditions'=>array(
												'Comment.viewed'=>'0'),
											'User'=>array(
												'Picture'
								)))));	
			$this->set('notviewedjournals', $notviewedjournals);*/
		
		}
	}

	
	public function listAditionalJs(){
		ksort($this->additionalJs);
		
		return $this->additionalJs;
	}
	
	public function loadAditionalJs($jsFileName,$priority=99){
		if(!in_array($jsFileName,$this->additionalJsTmp)){	
			$this->additionalJsTmp[] = $this->additionalJs[$priority][] = $jsFileName;
		}	
	}
	
	
	public function listAditionalCss(){
		return $this->additionalCss;
	}
	
	public function loadAditionalCss($cssFileName){
		if(!in_array($cssFileName,$this->additionalCss)){
			$this->additionalCss[] = $cssFileName;
		}	
	}

	public function isAuthorized($user) {
  
    // Default deny
    return true;
}

	
	public function _loggedIn(){
		return ($this->Auth->user() ? true : false);
	}
	
	function _username() {
		$username = NULL;
		if($this->Auth->user()) {
			$username = $this->Auth->user('username');
		}
		return $username;
		
	}

	function _userFullName() {
		$userFullName = NULL;
		if($this->Auth->user()) {
			$userFullName = $this->Auth->user('firstname') . " " . $this->Auth->user('lastname');
		}
		return $userFullName;
		
	}
	
	public function getUser($id = null) {
		if (!is_null($id)) {
		} else {
			$id = $this->Auth->user('id');
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$user = $this->User->find('first', 
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
						'Journal' => array(
							'Comment' => array(
									'User' => array('Picture')
							),
							'Area'),

						'Picture',
						'Area',
						'Relation_A',
						'Relation_B'
						
					)
				)
			);
			
	}

	function myEncode($variable){
		return base64_encode(Security::cipher(json_encode($variable), Configure::read('Security.cipherSeed')));
	}
	
	function myDecode($variable){
		$x = json_decode(Security::cipher(base64_decode($variable),Configure::read('Security.cipherSeed')));
		if(is_object($x)){
			return (array) $x;
		}
		return $x;
	}

	function renderJsonContent($arrAuxiliarReturn=array()){
	
		$return = array_merge( array('content' => $this->getRenderedContent() ) ,$arrAuxiliarReturn);
		echo json_encode($return);
		exit();
	}

	function getRenderedContent(){
		$this->autoRender = false;
		
		/* Set up new view that won't enter the ClassRegistry */
		$view = new View($this, false);
		//debug(array_keys($view->viewVars));
		foreach($this->viewVars as $key => $value){
			$view->$key = $value;
		}
		
		/* Grab output into variable without the view actually outputting! */
		return $view->render();
	}
	function logoutUser(){
		$this->Auth->logout();
		$this->Session->destroy();
		Cache::clear();
	}
	
	
	/**
	* This function does the same thing as the View::element and return the rendered element.
	* This is useful when you need the html of an element in a controller
	**/
	function element($name, $data = array(), $options = array()){
		$tmpView = new View();
		$tmpView->helpers = $this->helpers;
		$tmpView->loadHelpers();
		$data['objRequest'] =& $this->request;
		$data['objController'] =& $this;
		
		$return = $tmpView->element($name, $data, $options);
		unset($tmpView);
		return $return;
	}
	
	/**
	 * Sends an email to developers alerting that an exception happened
	 * @param: Exception $e
	 */
	public function reportException(Exception $e){
		AppExceptionHandler::reportUnknownException($e);
	}
}


