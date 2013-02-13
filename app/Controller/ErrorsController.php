<?php

class ErrorsController extends AppController
{
	
	public $helpers = array('Js', 'Html', 'Form');
	
	function beforeFilter(){
		$this->Auth->allow(array('error404','index'));
	}

	/**
	 * This displays a general error message
	 * 
	 */
	public function index(){
		
	}
	
	public function error404(){
		
	}
	
}