<?php
App::uses('AppController', 'Controller');

class WsareasController extends AppController {

	public $components = array('RequestHandler');
	
	public function beforeFilter(){
		
		$this->Auth->allow('index');
	}
	
	public function index() {
		$this->loadModel('Area');
		
		$arrObjArea = $this->Area->findObjects('all');

		$arrReturn = array();
		foreach($arrObjArea as $key => $value){
			$arrReturn[] = $value->getArrayRepresentation();
		}
		if($this->request->query['Debug'] == 2){
			debug($arrReturn);
			exit();
		}
		
		$this->set(array(
				'areas' => $arrReturn,
				'_serialize' => array('areas')
		));
	}
			
}
