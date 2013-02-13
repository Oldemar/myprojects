<?php
App::uses('AppController', 'Controller');

class NotificationsController extends AppController {

	public $components = array('RequestHandler');

	function beforeFilter(){
		parent::beforeFilter();
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

	public function markAsViewed(){
		$this->objLoggedUser->markNotificationsAsViewed();
		exit();
	}
	
	public function status(){
		$arrLastNotifications = $this->objLoggedUser->listLastNotifications();
		$arr['countNew']=0;
		
		if(is_array($arrLastNotifications)){
			foreach($arrLastNotifications as $key => $value){
				if($value->getAttr('viewed') == '0'){
					$arr['countNew']++;
				}
				$arr['arrNotifications'][] = $value->toArray($this->objLoggedUser);
			}
		}
		
		$arr['html'] = $this->element('Notifications/alert_list',array('arrNotifications'=>$arr['arrNotifications']));
		
		$this->set('notification', $arr);
		
		$this->set('_serialize', array('notification'));
	}

}
