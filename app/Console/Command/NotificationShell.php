<?php
class NotificationShell extends AppShell {
	
	public $uses = array('NotificationUser','NotificationType','Notification');
	
	public function main(){
		App::uses('CakeEmail', 'Network/Email');
		
		$notificationType = $this->NotificationType->getNotificationTypeEmailCreation();
		
		$arrResult = $this->NotificationUser->findObjects('all',array(
																	'conditions'=>
																		array(
																				'Notification.notification_type_id'=>$notificationType->getPrimaryId(),
																				'viewed' => '0'
																		)
																)
		);

		if(is_array($arrResult)){
			foreach($arrResult as $key => $value){
				$value->Notification->loadExtraObjects();
				
				try{
					$objEmail = new CakeEmail('smtp');
					$objEmail->template('journal_creation_notification', 'default')
					->emailFormat('html')
					->to($value->User->getAttr('email'))
					->bcc('info@livingalpha.com');
					
					$objEmail->subject('Journal Creation Email');
					
					$objEmail->viewVars(array('image'=>Configure::read('CDN_URL').'img/Email_Banner.png','objUser' => $value->Notification->Journal->getObject('User'), 'objJournal'=> $value->Notification->Journal));
					
					$objEmail->send();
					
					$value->data['NotificationUser']['viewed'] = '1';
					$value->save();
					
				}catch(Exception $e){
					
				}
			
			}
		}
		
		
	}
}