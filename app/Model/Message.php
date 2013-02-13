<?php 

class Message extends AppModel {

	var $useTable = false;
	var $name = 'Message';

	
	public $validate = array(
			
		'name' => array (
			'rule' => 'notEmpty',
			'message' => 'You must provide your name.'
		),
		'email' => array (
			'rule' => 'email',
			'message' => 'You must provide a valid email address.'
		),

		'description' => array (
			'rule' => 'notEmpty',
			'message' => 'You must provide a description.'
		),
		
		'captcha' => array(
			'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'You must provide the correct answer (It is for Captcha).',
					'allowEmpty' => false,
					'required' => true,
					),
				'comparison' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Wrong answer.',
				'on'         => 'create'
			)
	
		)
		
	);
	
	/**
	 * Sends the contact us email
	 * 
	 */
	public function sendContactUs(){
		
		if(!$this->validates()){
			 echo 'this is perfect';
			 
			 debug($this->validationErrors);
			 exit;
		}
		
		
		$objEmail = new CakeEmail('smtp');
		$objEmail->template('contactus', 'default')
		->emailFormat('html')
		->to('contact@livingalpha.com')
		->subject('Living Alpha Contact Us');
		
		$objEmail->viewVars(array(
				'image'=> $this::urlToWebrootImg().'Email_Banner.png',
				'data' => $this->data
		));
		
		if($objEmail->send()){
			return true;
		}else{
			return false;
		}		
		
		$this->loadAditionalCss('bootstrap.components.alert');
		
	}
}

