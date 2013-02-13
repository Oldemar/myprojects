<?php
App::uses('AppController', 'Controller');
class WallaceController extends AppController{
	
	public function index(){
		$this->loadModel('User');
		$arrObjUsers = $this->User->findObjects('all');
		$this->set('objUsers',$arrObjUsers);
	}
}