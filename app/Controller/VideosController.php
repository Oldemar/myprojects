<?php
App::uses('AppController', 'Controller');
/**
 * Videos Controller
 *
 * @property Video $Video
 */
class VideosController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('User');
		$this->set('user',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
		$this->loadModel('Journal');
		$this->set('journals',$this->Journal->find('all', array(
							'conditions'=>array('Journal.user_id'=>$this->Auth->user('id')),
							'order'=>array('Journal.date_event'=>'DESC'),
							'contain'=>array(
								'Video'=>array('order'=>array('Video.sharing_level'=>'DESC'))
								)
							)));
							
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
		$this->loadAditionalCss('popover_journallist');
		$this->loadAditionalCss('bootstrap.js_components.popovers');
		$this->loadAditionalCss('bootstrap.js_components.tooltips');
		$this->loadAditionalCss('bootstrap.javascript.photomodal');
		
		$this->loadAditionalJs('bootstrap.javascript.photomodal');
		$this->loadAditionalJs('bootstrap.components.alert');
		$this->loadAditionalJs('bootstrap.tooltip');
		$this->loadAditionalJs('bootstrap.popovers');
		$this->loadAditionalJs('bootstrap.dropdowns');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');

		$this->loadModel('Journal');
		$this->Journal = $this->Journal->findById($id);
		
		if(!is_object($this->Journal) || (is_object($this->Journal) && !$this->Journal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
		
		if(!$this->Journal->checkIfIsTheOwner($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a journal without permission.');
		}
		
		if ($this->request->is('post')) {
			$this->Video->create();
			if ($this->Video->SaveVideo($this->request->data)) {
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
		$this->loadModel('Albumcomment');
		$this->set('albumcomments', $this->Albumcomment->find('all', array(
									'order'=>array('Albumcomment.created'=>'DESC'),
									'conditions'=>array(
										'Albumcomment.journal_id'=>$id),
									'contain'=>array(
										'User'=>array('Picture')))));

	
		$objJournal = $this->Journal->findById($id);

		$objJournal->buildHasMany('Video');

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
			$this->Video->SaveDesc($this->request->data);
		}
		$this->redirect($this->referer());
	}

	public function video($id = null,$jid) {
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
		$this->loadAditionalCss('bootstrap.js_components.popovers');
		$this->loadAditionalCss('popover_journallist');
		
		$this->loadAditionalJs('bootstrap.tooltip');
		$this->loadAditionalJs('bootstrap.javascript.photomodal');
		$this->loadAditionalJs('bootstrap.javascript.togglable_tabs.min');
		$this->loadAditionalJs('bootstrap.popovers');
		$this->loadAditionalJs('bootstrap.dropdowns');
		$this->loadAditionalJs('galleria-1.2.8.min'); 	
		
		if ($this->request->is('post')) {
			$this->Video->Videocomment->create();
				$this->Video->Videocomment->Save($this->request->data);
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
		
		$r = $this->Video->findObjects('all',array(
							'recursive'=>0,
							'conditions'=>array('Video.journal_id'=>$jid,'Video.id >='=>$id)
					));
		
		$arrJson = array();
		foreach($r as $key => $value){
			
			try{
				if($value->checkIfUserCanSeeVideo($this->objLoggedUser,$objJournal)){
					$tmp = $value->getArrToDisplayGallery();
					$tmp['comments_html'] = $this->element('Videos/list_comments',array('objVideo'=> $value, 'objLoggedUser'=> $this->objLoggedUser));
					$tmp['iframe'] = $tmp['iframe'];
					$arrJson[] = $tmp;
				}
			}catch(Exception $e){
				$this->reportException($e);
				debug($e->getMessage());exit();
			}	
			
		}
		
		$this->set('videoJson',json_encode($arrJson));
				
	}
 
		  
/** 
 	* This is an ajax function called by PhotosController::photo()
 	**/
 	function loadVideo($journalId, $videoId){
 		
 		$r = $this->Video->findObjects('all',array(
							'conditions'=>array('Video.journal_id'=>$journalId,'Video.id >'=>$videoId),
							'limit' => 10), 0 );
							
		$this->loadModel('Journal');
 		$objJournal = $this->Journal->findById($journalId,array(),0);					
		
		if(count($r) == 0 ){
			$r = $this->Video->findObjects('all',array(
							'conditions'=>array('Video.journal_id'=>$journalId)));
		}			

		$this->Video->iterate($r,'loadComments');
		
		$arrJson = array();
		foreach($r as $key => $value){
			if($value->checkIfUserCanSeeVideo($this->objLoggedUser,$objJournal)){
				$tmp = $value->getArrToDisplayGallery();
				$tmp['comments_html'] = $this->element('Videos/list_comments',array('objVideo'=> $value, 'objLoggedUser'=> $this->objLoggedUser));
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

	public function playvideo($id = null) {
		$this->loadAditionalCss('style');
		$this->loadAditionalCss('bootstrap.components.nav_tabs_pills');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
		$this->loadAditionalCss('bootstrap.js_components.dropdowns');
		$this->loadAditionalCss('bootstrap.base.icons');
		$this->loadAditionalCss('bootstrap.js_components.tooltips');
		$this->loadAditionalCss('bootstrap.javascript.photomodal');
		$this->loadAditionalCss('bootstrap.js_components.popovers');
		$this->loadAditionalCss('popover_journallist');
		
		
		$this->loadAditionalJs('jwplayer/jwplayer');
		$this->layout = 'ajax';
		$this->set('video', $this->Video->find('first', array (
					'conditions' => array('Video.id' => $id),
					'contain'=> array(
						'Journal',
						'Videocomment'=> array(
							'order'=>array('Videocomment.created'=>'DESC'),
							'User'=>array(
								'Picture'
					))))));
		
	}
	
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		$this->set('video', $this->Video->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Video->create();
			if ($this->Video->save($this->request->data)) {
				$this->Session->setFlash(__('The video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.'));
			}
		}
		$journals = $this->Video->Journal->find('list');
		$this->set(compact('journals'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Video->save($this->request->data)) {
				$this->Session->setFlash(__('The video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The video could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Video->read(null, $id);
		}
		$journals = $this->Video->Journal->find('list');
		$this->set(compact('journals'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null,$journalId) {
		$this->Video = $this->Video->findById($id);
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid Video'));
		}
		
		$this->Video->Journal->loadObject('User');
		
		if($this->Video->Journal->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete a Video without permission.');
		}
		$sharingLevel = $this->Video->getAttr('sharing_level');
		if ($this->Video->deleteVideo()) {
			$this->loadModel('Journal');
			$objJournal = $this->Journal->findById($journalId);
			
			$arrReturn['content'] = $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevel));
			$arrReturn['error'] = 0 ;
			
			echo json_encode($arrReturn);
			exit();
		}
	}
	
/**
 * delete album comment method
 *
 * @param string $id
 * @return void
 */
	public function deletecomment($id = null,$idvideo) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Video->Journal->Albumcomment->id = $id;
		if (!$this->Video->Journal->Albumcomment->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		if ($this->Video->Journal->Albumcomment->delete()) {
			$this->redirect(array('action' => 'album',$idvideo));
		}
		$this->redirect(array('action' => 'album',$idvideo));
	}
/**
 * delete video comment method
 *
 * @param string $id
 * @return void
 */
	public function deletevideocomment($id = null,$idvideo) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Video->Videocomment->id = $id;
		if (!$this->Video->Videocomment->exists()) {
			throw new NotFoundException(__('Invalid video'));
		}
		if ($this->Video->Videocomment->delete()) {
			$this->redirect(array('action' => 'video',$idvideo));
		}
		$this->redirect(array('action' => 'video',$idvideo));
	}
	
	public function uploadBoxModalBody($modalId, $journalId, $sharingLevel ,$divDestinationId){
		$this->layout = 'ajax';
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($journalId);
		$this->set('countAllowedVideos',$objJournal->getCountAllowedVideosUpload($sharingLevel));
		
		$this->set('objJournal',$objJournal);
		$this->set('modalId',$modalId);
		$this->set('sharingLevel',$sharingLevel);
		$this->set('divDestinationId',$divDestinationId);
	}
	
	/**
	 * Returns the html with the photos displayed in a row. This is used on the adddesc by the modal to upload images
	 */
	public function displayVideosInRows($journalId, $sharingLevel){
		$this->layout = 'ajax';
		$this->loadModel('Journal');
		$objJournal = $this->Journal->findById($journalId);
	
		$this->set('objJournal',$objJournal);
		$this->set('sharingLevel',$sharingLevel);
	}

	public function saveSharingLevel($id = null,$sharingLevelTo,$sharingLevelFrom) {
		$this->Video = $this->Video->findById($id);
		$journalId = $this->Video->getAttr('journal_id');
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Invalid Video'));
		}
	
		$this->Video->Journal->loadObject('User');
	
		if($this->Video->Journal->User->getID() != $this->objLoggedUser->getID()){
			throw new ForbiddenException('User trying to delete a Video without permission.');
		}
		if ($this->Video->saveSharingLevel($sharingLevelTo)) {
			$this->loadModel('Journal');
			$objJournal = $this->Journal->findById($journalId);
	
			$arrReturn['contentFrom'] = $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevelFrom));
			$arrReturn['contentTo'] = $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevelTo));
			$arrReturn['error'] = 0;
		} else {
			$arrReturn['error'] = 1;
		}
	
		echo json_encode($arrReturn);
		exit();
	}
	
}
