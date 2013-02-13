<?php
App::uses('AppController', 'Controller');
class OldemarController extends AppController{
	
	public function index(){
		
		$this->loadModel('Video');
		$arrObjVideo = $this->Video->findObjects('all');
		
		$this->set('objVideo',$arrObjVideo);
		
	}
	
}
