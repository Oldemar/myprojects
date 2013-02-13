<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {
	
	var $helpers = array('Js');


/**
 * index method
 *
 * @return void
 */
	public function index() {
		
			if($this->request->params['named']['groupid']){
				
				if($strErrors === null ){
						
				}
					
				$objGroup = $this->Group->findGroupByNameOrId($this->request->params['named']['groupid']);
				
				if($this->objLoggedUser->getID() != $objGroup->User->getID()){
					throw New ForbiddenException('User trying to reach a group without authorization.');
						
				}
				
				if(!is_null($objGroup->getAttr('id'))){
				
					$arrayObjFriend = $objGroup->listMembers();
				}
				else{
				
					if(trim($this->request->data['groupName']) != ''){
							
						$objGroup->set('name', $this->request->data['groupName']);
					}
					else{
						$strErrors = array('Please, enter the group name.');
					}
				
				}
				
				$this->set('arrayObjFriend', $arrayObjFriend);
				$this->set('objUser', $this->objLoggedUser);
					
					
				$this->set('objGroup', $objGroup);				
			}
			else{
				
				$listGroup = $this->objLoggedUser->listGroupsByUser();
				
				$this->set('listGroup', $listGroup);
			}
			
		$this->set('users', array('User'=>array('id'=> $this->objLoggedUser->getAttr('id'))));
		
		$this->helpers[] = 'CachedElement';
		$this->helpers[] = 'Modal';
		
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		
		
		$this->loadAditionalJs('users/index');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');
		
	
	}
	
	
/**
 * getbyGroup  method
 *
 * @param string $id
 * @return void
 */
	public function getByGroup($id = null) {
		$this->loadModel('GroupsUser');
		$this->set('usersbygroup',$this->GroupsUser->find('all',array(
									'conditions'=>array('GroupsUser.group_id'=>$this->data['group_id']),
									'contain'=>array(
										'Group',
										'User'=>array(
											'Picture',
											'Contact'=>array(
												'ResCountry',
												'ResRegion',
												'ResCity'),
												'GroupsUser'=>array('Group')
												)))));
		$this->layout = 'ajax';
		$this->set('group',$this->Group->find('first',array(
									'conditions'=>array('Group.id'=>$this->data['group_id']),
									'fields'=>array('id','name'))));
		$this->set('groupsimg',$this->Group->find('list',array(
									'conditions'=>array('Group.user_id'=>$this->Auth->user('id')),
									'fields'=>array('id','image')
									)));
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$this->Group->create();
			
			if ($this->Group->save($this->request->data)) {
				
				$this->Session->setFlash(__('The group has been saved. Now, you can add new members.'));
				
				$this->redirect(array('action' => 'index','groupId'=>$this->Group->getInsertID()));
			} 
		}
		
		$this->set('users', array('User'=>array('id'=> $this->objLoggedUser->getAttr('id'))));

		$this->set('user',$this->Group->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
		
		
		$this->loadGroups();
	}
	
	private function loadGroups(){

		$arrayObjFriend = $this->objLoggedUser->listFriend();
		
		foreach ($arrayObjFriend as $key => $value) {
				
			$arrayObjFriend[$key]->Contact->loadObject('ResCity');
				
		}
		
		$this->set('arrayObjFriend', $arrayObjFriend);
		$this->set('objUser', $this->objLoggedUser);
		
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		$this->Group->id = $id;
		
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
			
		} else {
			
			$this->request->data = $this->Group->read(null, $id);
			
			
			if($strErrors === null ){
			
			}
				
			$objGroup = $this->Group->findGroupByNameOrId($id);
				
			if(!is_null($objGroup->getAttr('id'))){
			
				$arrayObjFriend = $objGroup->listMembers();
			}
			else{
			
				if(trim($this->request->data['groupName']) != ''){
						
					$objGroup->set('name', $this->request->data['groupName']);
				}
				else{
					$strErrors = array('Please, enter the group name.');
				}
			
			}
			
			$this->set('arrayObjFriend', $arrayObjFriend);
			$this->set('objUser', $this->objLoggedUser);
				
				
			$this->set('objGroup', $objGroup);			
		}

		$this->helpers[] = 'CachedElement';
		
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.components.alert');
		
		
		$this->loadAditionalJs('users/index');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');		
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		
		debug($this->request);
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Group->id = $id;

		$objGroup = $this->Group->findById($id);
		
		if($this->objLoggedUser->getID() != $objGroup->User->getID()){
			throw New ForbiddenException('User trying to delete a group without authorization.');
			
		} 
		
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * delete User from Group method
 *
 * @param string $id
 * @return void
 */
	public function delusergroup($id = null) {
		$this->loadModel('GroupsUser');
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->GroupsUser->id = $id;
		if (!$this->GroupsUser->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->GroupsUser->delete()) {
			$this->redirect(array('controller'=>'groups','action' => 'index'));
		}
		$this->redirect(array('controller'=>'groups','action' => 'index'));
	}
	
	public function addFriendToGroup() {
		
		$this->loadModel('GroupsUser');
		$this->layout = 'ajax';
		$this->render(false);
	
		$strErrors = null;
	
	
		if($this->request->is('PUT') || $this->request->is('POST')){
	
			$this->GroupsUser->set('user_id', 	$this->request->data['userId']);
			$this->GroupsUser->set('group_id', 	$this->request->data['groupId']);
				
			if ($this->GroupsUser->validates()) {
	
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
	
	
		$this->renderJsonContent(array('boolError' => (count($this->GroupsUser->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
	
	}
	
	public function removeFriendToGroup() {
	
		$this->loadModel('GroupsUser');
		$this->layout = 'ajax';
		$this->render(false);
	
		$strErrors = null;
	
	
		if($this->request->is('PUT') || $this->request->is('POST')){
	
			$this->GroupsUser->set('user_id', 	$this->request->data['userId']);
			$this->GroupsUser->set('group_id', 	$this->request->data['groupId']);
			
			$objGroup = $this->Group->findGroupByNameOrId($this->request->data['groupId']);
			
			if($this->objLoggedUser->getID() != $objGroup->User->getID()){
				throw New ForbiddenException('User trying to reach a group without authorization.');
			
			}
	
			if ($this->GroupsUser->deleteAll(array(	'GroupsUser.user_id' => $this->request->data['userId'],
													'GroupsUser.group_id' => $this->request->data['groupId']))) {
	

	
			}else{

				$strErrors ='The user could not be removed from the group';
	
			}
		}
	
	
		$this->renderJsonContent(array('boolError' => (count($this->GroupsUser->validationErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
	
	}	
	
	public function listMembers(){
		
		$this->layout = 'ajax';
		
		$this->helpers[] = 'Modal';
		
		$strErrors = null;
		
		if($this->request->is('PUT') || $this->request->is('POST')){
		
			if($strErrors === null ){
			
			}
			
			$objGroup = $this->Group->findGroupByNameOrId($this->request->data['groupId'], $this->request->data['groupName'], $this->objLoggedUser);
			
			if($objGroup->getID() && $this->objLoggedUser->getID() != $objGroup->User->getID()){
				throw New ForbiddenException('User trying to reach a group without authorization.');
			
			} 		
			
			if(!is_null($objGroup->getAttr('id'))){
				
				$arrayObjFriend = $objGroup->listMembers();
			}
			else{

				if(trim($this->request->data['groupName']) != ''){
					
					$objGroup->set('name', $this->request->data['groupName']);
				}
				else{
					$strErrors = array('Please, enter the group name.');
				}
				
			}

			$this->set('arrayObjFriend', $arrayObjFriend);
			$this->set('objUser', $this->objLoggedUser);
			
			
			$this->set('objGroup', $objGroup);			
		
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors, 'memberCount'=>count($arrayObjFriend),'groupId'=>$objGroup->getAttr('id')));		
	}
	
	public function addGroup(){
		
		$this->layout = 'ajax';
		
		if($this->request->is('PUT') || $this->request->is('POST')){
			
			$this->Group->set('id', null);
			$this->Group->set('name', $this->request->data['groupName']);
			$this->Group->set('user_id', $this->objLoggedUser->getAttr('id'));
			
			if($this->Group->save()){
				
			}
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
	}
	
	public function listNewMembers(){

		$this->layout = 'ajax';
		
		$strErrors = null;
		
		if($this->request->is('PUT') || $this->request->is('POST')){
		
			$objGroup = $this->Group->findGroupByNameOrId($this->request->data['groupId']);
			
			$newFriends = array();
			
			$arrayObjFriend = $this->objLoggedUser->findUsers($this->request->data['q']);
				
			foreach ($arrayObjFriend as $key => $value) {
				
				if($this->objLoggedUser->isFriend($value->getAttr('id'))){
					
					$arrayObjFriend[$key]->Contact->loadObject('ResCity');
					$arrayObjFriend[$key]->findFriendStatus($this->objLoggedUser->getAttr('id'));
					
					$newFriends[$key] = $arrayObjFriend[$key];
				
				}
					
			}
				
			$this->set('arrayObjFriend', $newFriends);
			$this->set('objUser', $this->objLoggedUser);
				
			$this->set('objGroup', $objGroup);
		
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors, 'memberCount'=>count($arrayObjFriend),'groupId'=>$objGroup->getAttr('id')));
		
	}
	
	
	public function editGroup(){
		
		$this->layout = 'ajax';
		
		if($this->request->params['named']['groupId']){
			
			$objGroup = $this->Group->findGroupByNameOrId($this->request->params['named']['groupId']);
			
			if($this->objLoggedUser->getID() != $objGroup->User->getID()){
				throw New ForbiddenException('User trying to delete a group without authorization.');
					
			}
		}
		
		$this->set('objGroup', $objGroup);
	}
	
	public function editGroupName(){
		
		$this->layout = 'ajax';
		
		if($this->request->is('PUT') || $this->request->is('POST')){
				
			if(isset($this->request->data['groupName'])){
		
				$objGroup = $this->Group->findGroupByNameOrId($this->request->data['groupId']);
		
				if(!$objGroup->editName($this->request->data['groupName'])){
						
						
					$strErrors = $objGroup->validationErrors;
				}
		
			}
				
			$this->set('objGroup', $objGroup);
				
			$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors));
			
			exit();
		}		
		
	}
	
	public function listAllMembers(){
		
		$this->layout = 'ajax';
		
		$strErrors = null;
		
		if($this->request->is('PUT') || $this->request->is('POST')){
		
			$objGroup = $this->Group->findGroupByNameOrId($this->request->data['groupId']);
			
			$newFriends = array();
			
			$arrayObjFriend = $this->objLoggedUser->listFriendsByAlphabetic($this->request->data['ini']);
				
			foreach ($arrayObjFriend as $key => $value) {
				
				if($this->objLoggedUser->isFriend($value->getAttr('id')) ){
					
					$arrayObjFriend[$key]->Contact->loadObject('ResCity');
					$arrayObjFriend[$key]->findFriendStatus($this->objLoggedUser->getAttr('id'));
					
					$newFriends[$key] = $arrayObjFriend[$key];
				
				}
					
			}
				
			$this->set('arrayObjFriend', $newFriends);
			$this->set('objUser', $this->objLoggedUser);
				
			$this->set('objGroup', $objGroup);
		
		}
		
		$this->renderJsonContent(array('boolError' => (count($strErrors) > 0 ? 1 :0 ), 'strErrors'=>$strErrors, 'memberCount'=>count($arrayObjFriend),'groupId'=>$objGroup->getAttr('id')));
		
	}
	

}
