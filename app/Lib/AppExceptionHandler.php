<?php

App::uses('AuthComponent', 'Controller/Component');

class AppExceptionHandler {
	public static function handle($exception) {
		App::uses('Router', 'Routing');
		
		if ($exception instanceof PDOException) {
			AppExceptionHandler::reportDatabaseError($exception);	
		}else{
			AppExceptionHandler::reportUnknownException($exception);
		}
		
		if(Configure::read('environment') == "production"){
			
			if($exception instanceof NotFoundException || $exception instanceof MissingControllerException){
				echo '<meta http-equiv="refresh" content="0;URL=\''.Router::url(array('controller'=>'errors','action'=>'error404'),true).'\'">';
			}else{
				echo '<meta http-equiv="refresh" content="0;URL=\''.Router::url(array('controller'=>'errors','action'=>'index'),true).'\'">';
			}	
			exit();
		}else{
			return ErrorHandler::handleException($exception);
		}
	}
	
	public static function renderDefaultErrorPage(){
		App::uses('Router', 'Routing');
		echo '<meta http-equiv="refresh" content="0;URL=\''.Router::url(array('controller'=>'errors','action'=>'index'),true).'\'">';
		exit();
		
	}
	
	public static function reportUnknownException($exception){
		App::uses('CakeEmail', 'Network/Email');
		if(Configure::read('environment') != "production"){
			return true;
		}
		try{
			$email = new CakeEmail('default');
			$email->template('exception_report','blank');
			$email->emailFormat('html');
			$email->subject('['.$_SERVER['SERVER_NAME'].'] Exception     '.date('Y-m-d H:i:s'));
			$email->to(Configure::read('Developers.email'));
			//$email->from('info@alphasunandsport.com');
			$email->viewVars(array(
					'exception' => nl2br($exception->__toString()),
					'loggedUserData' => AuthComponent::user()
			));
			
			$email->send();
		}catch(Exception $e){
			
		}
	}
	
	public static function reportDatabaseError($exception){
		App::uses('CakeEmail', 'Network/Email');
		try{
			if(Configure::read('environment') != "production"){
				return true;
			}
			$email = new CakeEmail('default');
			$email->template('databaseerror_report','blank');
			$email->emailFormat('html');
			$email->subject('['.$_SERVER['SERVER_NAME'].'] Database Error     '.date('Y-m-d H:i:s'));
			$email->to(Configure::read('Developers.email'));
			//$email->from('info@alphasunandsport.com');
			$email->viewVars(array(
					'errorInfo' => $exception->errorInfo[2],
					'queryString' => $exception->queryString,
					'loggedUserData' => AuthComponent::user()
			));
		
			$email->send();
		}catch(Exception $e){
			
		}	
	}
	
	public static function getArrayContextToPrint(&$context){
		if(is_array($context)){
			foreach($context as $key => $value){
				AppError::getArrayContextToPrint($context[$key]);
	
			}
		}elseif(is_object($context)){
			$keyName = 'OBJECT:'.get_class($context);
			if(isset($context->useDbConfig)){
				$tmpObj[$keyName] = array();
				foreach($context as $key => $value){
					if(in_array($key,array('id','data','validationErrors')) || is_object($value)){
						$tmpObj[$keyName][$key] = $context->$key;
						AppError::getArrayContextToPrint($tmpObj[$keyName][$key]);
					}
				}
				$context = $tmpObj;
			}else{
				$context = $keyName;
			}
		}
	}
	// ...
}

?>