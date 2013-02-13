<?php
App::uses('AppModel', 'Model');
App::uses('Sanitize', 'Utility');
/**
 * Comment Model
 *
 * @property Journal $Journal
 * @property User $User
 */
class Comment extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

		function commentSave($data) {

			$this->create($this->data);
			$this->data['Comment']['user_id'] = Authcomponent::user('id');

			if (isset($data['Comment0']['journal_id']) && !is_null($data['Comment0']['journal_id']))
				$this->data['Comment']['journal_id'] = $data['Comment0']['journal_id'];
			if (isset($data['Comment1']['journal_id']) && !is_null($data['Comment1']['journal_id']))
				$this->data['Comment']['journal_id'] = $data['Comment1']['journal_id'];
			if (isset($data['Comment2']['journal_id']) && !is_null($data['Comment2']['journal_id']))
				$this->data['Comment']['journal_id'] = $data['Comment2']['journal_id'];


			if ((isset($data['Comment0']['juserownerid']) && $data['Comment0']['juserownerid']== Authcomponent::user('id'))) {
				$this->data['Comment']['viewed'] = 1;
			}
			if ((isset($data['Comment1']['juserownerid']) && $data['Comment1']['juserownerid']== Authcomponent::user('id'))) {
				$this->data['Comment']['viewed'] = 1;
			}
			if ((isset($data['Comment2']['juserownerid']) && $data['Comment2']['juserownerid']== Authcomponent::user('id'))) {
				$this->data['Comment']['viewed'] = 1;
			}
			if ( (isset($data['Comment0']['comment0'])) && ($data['Comment0']['comment0'] != null) ) {
				$this->data['Comment']['comment'] = $data['Comment0']['comment0'];
				$this->data['Comment']['sharing_level'] = 0 ;
				$this->save($this->data);
			} 
			if ( (isset($data['Comment1']['comment1'])) && ($data['Comment1']['comment1'] != null) ) {
				$this->data['Comment']['comment'] = $data['Comment1']['comment1'];
				$this->data['Comment']['sharing_level'] = 1 ;
				$this->save($this->data);
			} 
			if ( (isset($data['Comment2']['comment2'])) && ($data['Comment2']['comment2'] != null) ) {
				$this->data['Comment']['comment'] = $data['Comment2']['comment2'];
				$this->data['Comment']['sharing_level'] = 2 ;
				$this->save($this->data);
			} 
			return TRUE;

		}

		/**
		* Returns an array of objects with the comments of a journal
		**/
		function listCommentsByJournal($objJournal,$sharingLevel=2){
			return $this->findObjects('all',array('conditions'=>array('Comment.journal_id'=>$objJournal->getID(),'Comment.sharing_level'=> $sharingLevel),'order'=>'Comment.created desc'),1);
		}
		
		public function getDateCreatedToExhibit(){
			if (CakeTime::isToday($this->getAttr('created'))) {
				return CakeTime::timeAgoInWords($this->getAttr('created'));
			} else {
				if (CakeTime::wasYesterday($this->getAttr('created'))) {
					return 'Yesterday';
				} else {
					return CakeTime::format('h:i | F d, Y', $this->getAttr('created')) ;
				}
			}
		}
		
		public function checkLoggedUserCanDeleteComment(User $objLoggedUser){
			if(!is_object($objLoggedUser) || !is_object($this->User) || !is_object($this->Journal)){
				throw new Exception('Missing informations');
			}
			if ($this->User->getID() == $objLoggedUser->getID() || $this->Journal->getAttr('user_id') == $objLoggedUser->getID()){
				return true;
			}	
			return false;
		}
		
		public function postCommentForJournal(Journal $objJournal, $sharingLevel, $comment, User $objUser){
			$this->create();
			$this->data['Comment']['comment'] = Sanitize::html($comment);
			$this->data['Comment']['sharing_level'] = $sharingLevel;
			$this->data['Comment']['journal_id'] = $objJournal->getID();
			$this->data['Comment']['user_id'] = $objUser->getID();
			
			if($objJournal->checkIfIsTheOwner($objUser)){
				$this->data['Comment']['viewed'] = '1';
			}
			
			$this->data = $this->save();
			return $this;
		}
		
		public function getUsersCommentedOnJournal($objJournal, $sharingLevel){
			$arr = $this->find('all',array('recursive'=>'-1','conditions'=>array('Comment.journal_id'=>$objJournal->getPrimaryId(),'sharing_level'=>$sharingLevel),'group'=>'Comment.user_id'));
			
			$userModel = $this->loadModel('User');
			
			$arrUsers = array();
			
			if(is_array($arr)){
				foreach($arr as $key => $value){
					$arrUsers[] = $userModel->findById($value['Comment']['user_id'],array(),0);
				}
			}
			
			return $arrUsers;
		}
	
}
