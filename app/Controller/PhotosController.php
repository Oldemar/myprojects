<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {
	
	public $helpers = array('Js');
 
	public $components = array('Session');
	
/**
 * beforeFilter method
 *
 * @return void
 */
	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('getPhoto');
		$this->Auth->allow('displayPhotosInRows');
		
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->Photo->recursive = 0;
		$this->loadModel('User');
		$this->set('user',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
		$this->loadModel('Journal');
		
		$arr = $this->Journal->listJournalsCountPhotos($this->objLoggedUser);
		
		$arrAllJournals = array();
		$arrJournalsWithPhotos = array();
		$arrJournalsWithoutPhotos = array();
		
		foreach($arr as $key => $value){
			if($value[0]['count'] > 0){
				$arrAllJournals[] = $arrJournalsWithPhotos[] = $this->Journal->findById($value['Journal']['id']);
			}else{
				$arrAllJournals[] = $arrJournalsWithoutPhotos[] = $value['Journal'];
			}
		}
		
		$this->set('arrAllJournals',$arrAllJournals);
		$this->set('arrJournalsWithPhotos',$arrJournalsWithPhotos);
		$this->set('arrJournalsWithoutPhotos',$arrJournalsWithoutPhotos);
		
		$this->set('noCoverPhotoImagePath',$this->Journal->getNoCoverPhotoImagePath());
		$this->loadAditionalCss('bootstrap.components.alert');
							
	}

/**
 * album method
 *
 * @return void
 */
	public function album($id = null) {
		$this->helpers[] = 'Modal';
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
		$this->loadAditionalCss('bootstrap.js_components.dropdowns');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.js_components.popovers');
		$this->loadAditionalCss('bootstrap.js_components.tooltips');
		$this->loadAditionalCss('bootstrap.javascript.photomodal');
		$this->loadAditionalCss('popover_journallist');
		
		$this->loadAditionalJs('bootstrap.javascript.photomodal');
		$this->loadAditionalJs('bootstrap.tooltip');
		$this->loadAditionalJs('bootstrap.popovers');
		$this->loadAditionalJs('bootstrap.dropdowns');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');
			
		if ($this->request->is('post')) {
			$this->Photo->create();
			if ($this->Photo->SavePhoto($this->request->data)) {
				$this->redirect(array('action' => 'album', $id));
			}
		}
		$this->loadModel('User');
		$this->set('users',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
		$friends = $this->User->find('first', 
				array(
					'conditions' => array('User.id' => $this->Auth->user('id')),
					'contain' => array(
						'Relation_A' => array(
							'User_A'=> array('Picture','Contact'=>array(
													'ResCountry',
													'ResRegion',
													'ResCity'),
													'GroupsUser'=>array('Group')),
							'User_B'=> array('Picture','Contact'=>array(
													'ResCountry',
													'ResRegion',
													'ResCity'),
													'GroupsUser'=>array('Group'))
						),
						'Relation_B' => array(
							'User_A'=> array('Picture','Contact'=>array(
													'ResCountry',
													'ResRegion',
													'ResCity'),
													'GroupsUser'=>array('Group')),
							'User_B'=> array('Picture','Contact'=>array(
													'ResCountry',
													'ResRegion',
													'ResCity'),
													'GroupsUser'=>array('Group'))
						)						
					)
				)
			);
		$friendlist = array();
		foreach ($friends['Relation_A'] as $friend) :
			if ($friend['approved']) {
				$friendlist[]['User'] = $friend['User_B']	;
			}	
		
		endforeach;
		foreach ($friends['Relation_B'] as $friend) :
		
			if ($friend['approved']) {
				$friendlist[]['User'] = $friend['User_A'];
			}
		
		endforeach;
		
		$this->set('friends', $friends);
		$this->set('friendlist',$friendlist);
		$this->loadModel('Journal');
		$this->set('journals',$this->Journal->find('first', array(
							'conditions'=>array('Journal.id'=>$id)
							)));
		$this->set('photos',$this->Photo->find('all', array(
							'conditions'=>array('Photo.journal_id'=>$id))));
		$this->loadModel('Albumcomment');
		$this->set('albumcomments', $this->Albumcomment->find('all', array(
									'conditions'=>array(
										'Albumcomment.journal_id'=>$id),
									'order'=>array('Albumcomment.created'=>'DESC'),
									'contain'=>array(
										'User'=>array('Picture')))));
		
		$objJournal = $this->Journal->findById($id);
		
		$objJournal->buildHasMany('Photo');
		
		$objJournal->buildHasMany('Albumcomment');
		
		$this->set('objJournal',$objJournal);
		
	}

/**
 * saveDesc method
 *
 * @return void
 */
	public function saveDesc() {
		if ($this->request->is('post')) {
			$objPhoto = $this->Photo->findById($this->request->data['Photo']['id']);
			$objPhoto->Journal->loadObject('User');
			if($objPhoto->Journal->User->getID() != $this->objLoggedUser->getID()){
				throw new ForbiddenException('User trying to access add description to a photo without permission');
			}
			$objPhoto->saveDesc($this->request->data['Photo']['description']);
		}
		$this->redirect($this->referer());
	}

/**
 * saveCover method
 *
 * @return void
 */
	public function saveCover($id,$jid) {
		$this->Photo->SaveCover($id,$jid);
		exit;
	}

/**
 * getPhoto method
 *
 * @return void
 */
	public function getPhoto($id=null,$shrlvl) {
		$this->set('shrlvl',$shrlvl);
		$this->set('journals', $this->Photo->Journal->find('first', array(
							'conditions'=>array('Journal.id'=>$id))));
		$this->set('photos',$this->Photo->find('all', array(
							'conditions'=>array('Photo.journal_id'=>$id))));
		$this->layout = 'ajax';
			
	}
	
/**
 * photo method
 *
 * @return void
 */
	public function photo($id = null,$jid) {
		$this->layout = "ajax";
		$this->loadAditionalCss('style');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
		$this->loadAditionalCss('bootstrap.js_components.dropdowns');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.js_components.tooltips');
		$this->loadAditionalCss('bootstrap.javascript.photomodal');
		$this->loadAditionalCss('popover_journallist');
		
		$this->loadAditionalJs('bootstrap.tooltip');
		$this->loadAditionalJs('bootstrap.javascript.photomodal');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');
		$this->loadAditionalJs('bootstrap.popovers');
		$this->loadAditionalJs('bootstrap.dropdowns');
		$this->loadAditionalJs('galleria-1.2.8.min'); 	
		
		if ($this->request->is('post')) {
			$this->Photo->Photocomment->create();
				$this->Photo->Photocomment->Save($this->request->data);
			}
		$this->loadModel('User');
		$this->set('users',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
							
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($jid,array(),0);
		$this->set('objJournal',$objJournal);
		
		if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
		
		if(!$objJournal->checkCanSeeJournal($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a photo of a journal without permission.');
		}
		
		$objJournal->loadObject('User');
		
		$r = $this->Photo->findObjects('all',array(
							'recursive'=>0,
							'conditions'=>array('Photo.journal_id'=>$jid,'Photo.id >='=>$id),
							'limit' => 10), 0 );
		
		$arrJson = array();
		foreach($r as $key => $value){
			
			try{
				if($value->checkIfUserCanSeePhoto($this->objLoggedUser,$objJournal)){
					$tmp = $value->getArrToDisplayGallery();
					$tmp['comments_html'] = $this->element('Photos/list_comments',array('objPhoto'=> $value, 'objLoggedUser'=> $this->objLoggedUser));
					$tmp['image'] = $tmp['image'];
					$arrJson[] = $tmp;
				}
			}catch(Exception $e){
				$this->reportException($e);
				debug($e->getMessage());exit();
			}	
			
		}
		
		$this->set('photoJson',json_encode($arrJson));
		
	}
	
	public function display($id = null,$jid) {
		//$this->loadAditionalCss('bootstrap.miscellaneus.wells');
		$this->loadAditionalJs('galleria-1.2.8.min');
	
		if ($this->request->is('post')) {
			$this->Photo->Photocomment->create();
			if ($this->Photo->Photocomment->Save($this->request->data)) {
				$this->redirect(array('action' => 'photo', $id,$jid));
			}
		}
		$this->loadModel('User');
		$this->set('users',$this->User->find('first', array(
				'conditions'=>array('User.id'=>$this->Auth->user('id')),
				'contain'=>array(
						'Picture'
				)
		)));
			
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($jid,array(),0);
		$this->set('objJournal',$objJournal);
	
		if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
	
		if(!$objJournal->checkCanSeeJournal($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a photo of a journal without permission.');
		}
	
		$objJournal->loadObject('User');
	
		$r = $this->Photo->findObjects('all',array(
				'recursive'=>0,
				'conditions'=>array('Photo.journal_id'=>$jid,'Photo.id >='=>$id),
				'limit' => 10), 0 );
	
		$arrJson = array();
		foreach($r as $key => $value){
				
			try{
				if($value->checkIfUserCanSeePhoto($this->objLoggedUser,$objJournal)){
					$tmp = $value->getArrToDisplayGallery();
					$tmp['comments_html'] = $this->element('Photos/list_comments',array('objPhoto'=> $value, 'objLoggedUser'=> $this->objLoggedUser));
					$tmp['image'] = $tmp['image'];
					$arrJson[] = $tmp;
				}
			}catch(Exception $e){
				$this->reportException($e);
				debug($e->getMessage());exit();
			}
				
		}
	
		$this->set('photoJson',json_encode($arrJson));
	
		if(strpos($this->request->referer(), '/journals/view/') !== false){
			//back to journal
			$backLinkArray['title'] = 'Back to Journal';
			$backLinkArray['arrLink'] = array('controller'=>'journals','action'=>'view',$objJournal->getID());
		}else{
			//back to album
			$backLinkArray['title'] = 'Back to Album';
			$backLinkArray['arrLink'] = array('action'=>'album',$objJournal->getID());
		}
		$this->set('backLinkArray',$backLinkArray);
	}
 
 
		  
/** 
 	* This is an ajax function called by PhotosController::photo()
 	**/
 	function loadPhoto($journalId, $photoId){
 		
 		$r = $this->Photo->findObjects('all',array(
							'conditions'=>array('Photo.journal_id'=>$journalId,'Photo.id >'=>$photoId),
							'limit' => 10), 0 );

 		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($journalId,array(),0);					
		
		if(count($r) == 0 ){
			$r = $this->Photo->findObjects('all',array(
							'conditions'=>array('Photo.journal_id'=>$journalId),
							'limit' => 10), 0 );
		}			

		$this->Photo->iterate($r,'loadComments');
		
		$arrJson = array();
		foreach($r as $key => $value){
			if($value->checkIfUserCanSeePhoto($this->objLoggedUser,$objJournal)){
				$tmp = $value->getArrToDisplayGallery();
				$tmp['comments_html'] = $this->element('Photos/list_comments',array('objPhoto'=> $value, 'objLoggedUser'=> $this->objLoggedUser));
				$tmp['image'] = $tmp['image'];
				$arrJson[] = $tmp;
			}	
		}
		

		
		echo json_encode($arrJson);
 		exit();
 	}
 
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->set('photo', $this->Photo->read(null, $id));
	}


/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null,$journalId) {
		$this->Photo = $this->Photo->findById($id);
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		
		$this->Photo->Journal->loadObject('User');
		
		if($this->Photo->Journal->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete a photo without permission.');
		}
		$sharingLevel = $this->Photo->getAttr('sharing_level');
		if ($this->Photo->deletePhoto()){
			$this->loadModel('Journal');
			$objJournal = $this->Journal->findById($journalId);
			
			echo $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevel));
			
			exit();
		}
	}

/**
 * delete album comment method
 *
 * @param string $id
 * @return void
 */
	public function deletecomment($id = null,$idphoto) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Photo->Journal->Albumcomment->id = $id;
		if (!$this->Photo->Journal->Albumcomment->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		if ($this->Photo->Journal->Albumcomment->delete()) {
			$this->redirect(array('action' => 'album',$idphoto));
		}
		$this->redirect(array('action' => 'album',$idphoto));
	}
/**
 * delete photo comment method
 *
 * @param string $id
 * @return void
 */
	public function deletephotocomment($id = null) {
		$this->Photo->Photocomment->id = $id;
		if (!$this->Photo->Photocomment->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->Photo->Photocomment->delete() ;
		$this->redirect($this->referer());
	}

	public function uploadify($shrlevel,$journalid){
			
		//$this->loadModel('Picture');
		$this->loadModel('Journal');
		
		$initials = 'pj'.$shrlevel.$journalid;
		
		$objJournal = $this->Journal->findById($journalid);
		
		if (!$objJournal->exists()) {
			throw new NotFoundException(__('Invalid journal'));
		}
		if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
			
		if(!$objJournal->checkIfIsTheOwner($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a journal without permission.');
		}
		
		try{
			$objJournal->uploadAndAddPhoto($_FILES['Filedata'],$shrlevel);
			
			//If it's the first picture, then it's the cover picture in the Journal
			
		}catch(Exception $e){
			$this->reportException($e);
			$e->getMessage();
		}
		
		exit();
	}

	public function uploadBoxModalBody($modalId, $journalId, $sharingLevel ,$divDestinationId){
		$this->helpers[] = 'Modal';
		$this->layout = 'ajax';
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($journalId);
		
		$this->set('countAllowedPhotos',$objJournal->getCountAllowedPhotosUpload($sharingLevel));
		
		$this->set('objJournal',$objJournal);
		$this->set('modalId',$modalId);
		$this->set('sharingLevel',$sharingLevel);
		$this->set('divDestinationId',$divDestinationId);
	}
	
	/**
	 * Returns the html with the photos displayed in a row. This is used on the adddesc by the modal to upload images
	 */
	public function displayPhotosInRows($journalId, $sharingLevel){
		$this->layout = 'ajax';
		
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($journalId);
		
		$this->set('objJournal',$objJournal);
		$this->set('sharingLevel',$sharingLevel);
	}
	

	/**
	 * saveSharingLevel method
	 *
	 * @param string $id
	 * @return void
	 */
	public function saveSharingLevel($id = null,$sharingLevel) {
		$this->Photo = $this->Photo->findById($id);
		$journalId = $this->Photo->getAttr('journal_id');
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		
		$this->Photo->Journal->loadObject('User');
	
		if($this->Photo->Journal->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete a photo without permission.');
		}
		if ($this->Photo->saveSharingLevel($sharingLevel)) {
			$this->loadModel('Journal');
			$objJournal = $this->Journal->findById($journalId);
				
			$arrReturn['content'] = $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevel));
			$arrReturn['error'] = 0;
		} else {
			$arrReturn['error'] = 1;
		}
				
		echo json_encode($arrReturn);
		exit();
		}

}
	
