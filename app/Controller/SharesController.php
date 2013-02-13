<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Invitations Controller
 *
 * @property Invitation $Invitation
 */
class SharesController extends AppController {

	public $components = array('Session');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('check');
		
	}
/**
 * shareJournal method
 *
 * @return void
 */
	public function shareJournal() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Share->create();
				if($this->Share->save($this->request->data)){
					$idshare = $this->Share->id;
					$email = new CakeEmail();
					$email->from(array('info@livingalpha.com' => 'LivingAlpha - Sharing a Journal'));
					$email->to($this->data['Share']['email']);
					$email->subject('Sharing a Journal in LivingAlpha.com');
					
					$email->template('share_journal', 'default');
					
			
					
					$email->send("Join us at ".FULL_BASE_URL.$this->base."/shares/check/$idshare");
					$this->Session->setFlash('Share was successfully sent!');
				} else {
					$this->Session->setFlash('Share was not sent, please try again!');
				}

		}
			//$this->redirect($this->referer());
	}
	
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Share->id = $id;
		if (!$this->Share->exists()) {
			throw new NotFoundException(__('Invalid testimonial'));
		}
		if ($this->Share->delete()) {
			$this->Session->setFlash(__('Share deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Share was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * deleteshare method
 *
 * @param string $id
 * @return void
 */
	public function check($id = null) {
		$this->Share->id = $id;
		if (!$this->Share->exists()) {
			throw new NotFoundException(__('Invalid Journal Share!'));
		} else {
			$share = $this->Share->find('first', array(
					'conditions'=>array(
						'Share.id'=>$this->Share->id)));
			if ($this->request->is('post')) {
				$this->Share->create();
				if($this->data['Share']['email'] == $share['Share']['email']){
					if ($this->data['Share']['agreement'] == 'Y') {
						$this->redirect(array('controller'=>'journals','action'=>'shareview',$id));
					} else {
						$this->Session->setFlash('You have to agree with our terms and conditions!');
					}
				} else {
					$this->Session->setFlash('Email does not match!');
				}
			}
		}
		
	}

/**
 * deleteshare method
 *
 * @param string $id
 * @return void
 */
	public function deleteshare($id = null) {
		$this->Share->id = $id;
		$this->Share->delete();
		$this->redirect($this->referer());
		
	}

/**
 * sendEmail method
 *
 * @param string $id
 * @return void
 */
	public function sendEmail($id) {
		$share = $this->Share->find('first', array('conditions'=>array('Share.id'=>$id)));
		$email = new CakeEmail();
		$email->from(array('info@livingalpha.com' => 'LivingAlpha - Sharing a Journal'));
		$email->to($share['Share']['email']);
		$email->subject('A friend want to share a Journal in LivingAlpha.com');
		$email->send("Find out at ".FULL_BASE_URL."/journals/check/$id");
		$this->Session->setFlash('Share was successfully sent!');

		$this->redirect($this->referer());
	}
	
	
}