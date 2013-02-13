<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class MessagesController extends AppController {
	public $helpers = array('Js','Html', 'Session', 'Form');
	public $components = array('MathCapt'=> array('timer' => 3));

	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('index');
	}
	
	/**
	 * Sends the contact us email to the info@ 
	 * 
	 */
	public function index() {
		
		$this->set('sent',false);
		
		if ($this->request->is('post') && !empty($this->data)) {
			
			$captcharesult = $this->MathCapt->validate($this->request->data['Message']['captcha']);
			
			$this->request->data['Message']['captcha'] = $captcharesult;
			
			$this->Message->set($this->data);
			
			if($this->Message->validates()){
				
				if($this->Message->sendContactUs()) {
				
					$this->set('sent',true);
				}
				
				$this->request->data['Message'] = '';
			}
			
		}
		
		$this->set('captcha', $this->MathCapt->getCaptcha());
		
		$this->loadAditionalCss('bootstrap.components.alert');
		$this->loadAditionalCss('users');
		
	}		

// Contact form email functionality
 	public function contactus() {
	if ($this->request->is('post')) {
			$email = new CakeEmail('default');
			$email->from(array($this->data['Message']['Email'] => 'LivingAlpha.com - Contact us Form '));
			$email->to('info@livingalpha.com');
			$email->subject('Contact us From LivingAlpha.com');
			$email->send(
					'Information from LivingAlpha Contact Form' . "\n\n" . 
					'Name:'. $this->data['Message']['Name']. "\n" .
					'Email:'. $this->data['Message']['Email']. "\n" .
					'Phone:'. $this->data['Message']['Phone']. "\n" .
			 		'Description:' . $this->data['Message']['Description']. "\n" 
				);
	//		$this->redirect($this->referer());
		}
		
						
						
		
		#	echo"<pre>".  print_r($this->data, true) . "</pre>";
			
	
	}	


}
	



