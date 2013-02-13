<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Journals Controller
 *
 * @property Journal $Journal
 */
class JournalsController extends AppController {
	
	public $helpers = array('Js');
 
	public $components = array('Session');

	function beforeFilter(){
		parent::beforeFilter();
		
		$this->Auth->allow('shareview','sharedjournals','home');
		
	}
	
/**
 * index method
 *
 * @return void
 */
	
	public function index(){
		
		$this->loadAditionalCss('popover_journallist');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
		$this->loadAditionalCss('bootstrap.js_components.dropdowns');
		$this->loadAditionalCss('bootstrap.base.icons');
		
		$this->loadAditionalJs('bootstrap.dropdowns');
		
		
		$arrObjJournal = $this->Journal->findObjects('all', array(
				'order'=> array('Journal.date_event'=>'DESC'),
				'conditions'=>array('Journal.ispublishable'=>true, 'Journal.user_id' => $this->Auth->user('id'))
				));
		
		$this->loadModel('User');
		$this->set('user',$this->User->find('first', array(
				'conditions'=>array('User.id'=>$this->Auth->user('id')),
				'contain'=>array(
						'Picture'
				)
		)));
		
		$this->set('arrObjJournal',$arrObjJournal);
				
		$this->loadAditionalCss('users');	
		$this->loadAditionalCss('bootstrap.components.alert');
	}

/**
 * home method
 *
 * @return void
 */
	public function home() {

	}

/**
 * alphajournals method
 *
 * @return void
 */
	public function alphajournals() {
		$arrObjJournal = $this->Journal->findObjects('all', array(
					'order'=> array('Journal.date_event'=>'DESC'),
					'conditions'=>array('Journal.ispublishable'=>true)
					));
						
		$this->loadModel('User');
		$this->set('user',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Auth->user('id')),
							'contain'=>array(
								'Picture'
								)
							)));
		
		
		
		foreach($arrObjJournal as $key => $value){
			if(!$value->getAttr('forall_description')){
				if(!$value->checkCanSeeFriendSection($this->objLoggedUser)){	
					unset($arrObjJournal[$key]);
				}
			}
		}

		$this->set('arrObjJournal',$arrObjJournal);
			
	}
	

/**
 * getByRegion method
 *
 * @return void
 */
	public function getByRegion() {
		$country_id = $this->data['Journal']['country_id'];
		$regions = $this->Journal->Region->find('list', 
				array(	'fields'=> array('id','region'),
						'conditions' => 
						array('Region.country_id' => $country_id),
								'recursive'=> -1
		));
		
		$this->set('regions',$regions);
		$this->layout = 'ajax';
		
	}

/**
 * getByCity method
 *
 * @return void
 */
 
	public function getByCity($id = null) {
		$region_id = $this->data['Journal']['region_id'];
		$cities = $this->Journal->City->find('list', 
				array('conditions' => 
						array('City.region_id' => $region_id),
								'recursive'=> -1
		));
		
		$this->set('cities',$cities);
		$this->layout = 'ajax';
		
	}

/**
 * getLocation method
 *
 * @return void
 */
 
	public function getLocation($id = null) {
		$result = array();
		if (isset($this->data['Journal']['cityname']) && strlen($this->data['Journal']['cityname'])>2) {
			$term = $this->data['Journal']['cityname'];
			$this->loadModel('City');
			$result = $this->City->find('all',array(
											'conditions'=> array("City.name LIKE"=>"%{$term}%"),
											'contain'=> array('Region' => array('Country')))); 
		}
		$cities= array();
		foreach ($result as $city):
			$cities[$city['City']['id']] = $city['City']['name'].", ".$city['Region']['region'].", ".$city['Region']['Country']['name'] ;
		endforeach;
		
		$this->set('cities',$cities);
		$this->layout = 'ajax';
		
	}

/**
 * saveRating method
 *
 * @return void
 */
 
	public function saverate($sl,$rate,$jid,$jrid) {
		$this->set('sl',$sl);
		$this->Journal->Journalrate->id = $jrid;
		$this->Journal->Journalrate->set('sharing_level',$sl);
		$this->Journal->Journalrate->set('rate',$rate);
		$this->Journal->Journalrate->set('user_id',$this->Auth->user('id'));
		$this->Journal->Journalrate->set('journal_id',$jid);
		$this->Journal->Journalrate->save();
		$this->set('journals', $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $jid),
					'contain' => array(
						'Journalrate'
						)
					)
				)
			);
		$this->layout = 'ajax' ;
	}

/**
 * playvideo method
 *
 * @param string $id
 * @return void
 */

	public function playvideo($id = null,$jid) {
		
		$this->Journal = $this->Journal->findById($jid);
		
		if(!is_object($this->Journal) || (is_object($this->Journal) && !$this->Journal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
		
		$this->set('journals', $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $jid),
					'contain' => array(
						'Comment' => array (
							'User' => array(
								'Picture'
								)),
						'User' => array(
							'Picture'),
						'Photo',
						'Video',
						'Area',
						'Country',
						'Region',
						'City',
						'Currency',
						'Journalperm',
						'Journalrate',
						'Share'
						)
					)
				)
			);
		$this->set('video', $this->Journal->Video->find('first', array (
					'conditions' => array(
						'Video.id' => $id))));
		
		$this->Video = $this->Journal->Video->findById($id);
		
		if(!$this->Video->checkIfUserCanSeeVideo($this->objLoggedUser,$this->Journal)){
			throw new ForbiddenException('User trying to access a video without permission.');
		}
		
		
	}
/**
 * commentDetail method
 *
 * @param string $id
 * @return void
 */

	public function commentDetail($id = null) {
		$this->Journal->id = $id;
		$journals = $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $id),
					'contain' => array(
						'Comment' => array (
							'order'=>array('created'=>'DESC'),
							'User' => array(
								'Picture'
								)),
						'User' => array(
							'Picture'),
						'Photo',
						'Video',
						'Area',
						'Country',
						'Region',
						'City',
						'Currency',
						'Journalperm',
						'Journalrate',
						'Share',
						'Participation' => array('User'=>array(
							'Picture'))
						)
					)
				);
		$this->layout = 'ajax';
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */

	public function view($id = null) {
		$this->loadAditionalCss('popover_journallist');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
		$this->loadAditionalCss('bootstrap.js_components.dropdowns');
		$this->loadAditionalCss('bootstrap.base.icons');
		
		$this->loadAditionalJs('bootstrap.dropdowns');
		$this->loadAditionalJs(array(
				'jquery.jcarousel-all',
				'jquery.jcarousel.autoscroll',
				'jquery.jcarousel.control',
				'bootstrap.javascript.photomodal'));	
		$this->loadAditionalCss('bootstrap.javascript.photomodal');
		
		$this->Journal = $this->Journal->findById($id);
// 		$this->Journal->buildHasMany('Photo');
		
		if(!is_object($this->Journal) || (is_object($this->Journal) && !$this->Journal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
		
		if(!$this->Journal->checkCanSeeJournal($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a journal without permission.');
		}
		
		$journals = $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $id),
					'contain' => array(
						'Comment' => array (
							'order'=>array('created'=>'DESC'),
							'User' => array(
								'Picture'
								)),
						'User' => array(
							'Picture',
							'Group'=>array(
								'GroupsUser'
								)
							),
						'Photo',
						'Video',
						'Area' => array(
							'ParentArea'
						),
						'Currency',
						'Journalperm',
						'Journalrate',
						'Share',
						'Participation' => array('User'=>array(
							'Picture'))
						)
					)
				);
		
		$this->loadModel('City');
		$objCity = $this->City->findById($journals['Journal']['city_id']);
		$this->set('fullCityName',$objCity->getNameToExhibit());
		
		if ($journals['Journal']['user_id'] == $this->Auth->user('id')) {
			$this->Journal->updateview(date('Y-m-d H:i:s'),$id);
		}
		$this->set('journals', $journals);
		
		if ($this->request->is('post')) {
			$this->Journal->Comment->create();
			if ($this->Journal->Comment->commentSave($this->request->data)) {
				$this->redirect(array('action' => 'view', $id));
			}
		}
		$this->loadModel('User');
		$friends = $this->User->find('first', 
				array(
					'conditions' => array('User.id' => $this->Auth->user('id')),
					'contain' => array(
						'Relation_A' => array(
							'User_A',
							'User_B'
						),
						'Relation_B' => array(
							'User_A',
							'User_B'
						)						
					)
				)
			);

		$friendlist = array();
		foreach ($friends['Relation_A'] as $friend) :
			if ($friend['approved']) {
				$friendlist[$friend['User_B']['id']] = $friend['User_B']['firstname']." ".$friend['User_B']['lastname']	;
			}	
		
		endforeach;
		foreach ($friends['Relation_B'] as $friend) :
		
			if ($friend['approved']) {
				$friendlist[$friend['User_A']['id']] = $friend['User_A']['firstname']." ".$friend['User_A']['lastname']	;
			}
		
		endforeach;
		
		$this->set('friends', $friends);
		$this->set('friendlist',$friendlist);

		$this->loadModel('GroupsUser');
		$usersbygroup = $this->GroupsUser->find(
								'all',array(
									'conditions'=>array('GroupsUser.user_id'=>$this->Auth->user('id')),
									'contain'=>array(
										'Group'
										)
									)
								);

		$this->set('usersbygroup',$usersbygroup);
		$this->loadModel('Group');

		$usersbygroup2 = $this->Group->find(
								'all',array(
									'conditions'=>array('Group.user_id'=>$this->Auth->user('id')),
									'contain'=>array(
										'GroupsUser'
										)
									)
								);
		
		$this->set('groupslist',$this->Group->find('list',array(
									'conditions'=>array('Group.user_id'=>$this->Auth->user('id'))
									)));		
		
		$this->set('journalId', $this->Journal->id);
		$this->loadModel('Photo');
		$this->set('jPhoto2', 
			$this->Photo->find(
				'count', array(
					'conditions'=>array(
						'Photo.journal_id'=>$this->Journal->id,
						'Photo.sharing_level'=>'2'
						)
					)
				)
			);
		$this->set('jPhoto1', 
			$this->Photo->find(
				'count', array(
					'conditions'=>array(
						'Photo.journal_id'=>$this->Journal->id,
						'Photo.sharing_level'=>'1'
						)
					)
				)
			);
		$this->set('jPhoto0', 
			$this->Photo->find(
				'count', array(
					'conditions'=>array(
						'Photo.journal_id'=>$this->Journal->id,
						'Photo.sharing_level'=>'0'
						)
					)
				)
			);
		
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */

	public function shareview($id = null) {

		$this->loadModel('Share');
		$this->Share->id = $id ;
		if (!$this->Share->exists()) {
			$this->Session->setFlash(__('Not Allowed...'));
			$this->redirect(array('controller'=>'index','action'=>'index'));
		}
		$share = $this->Share->find('first', array (
					'conditions' => array(
						'Share.id' => $id)));
		
		$this->Journal->id = $share['Share']['journal_id'];
		$journals = $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $this->Journal->id),
					'contain' => array(
						'Comment' => array (
							'order'=>array('created'=>'DESC'),
							'User' => array(
								'Picture'
								)),
						'User' => array(
							'Picture'),
						'Photo',
						'Video',
						'Area'=>array(
							'ParentArea'
						),
						'Country',
						'Region',
						'City',
						'Currency',
						'Journalperm',
						'Journalrate',
						'Share',
						'Participation' => array(
								'User'=>array(
									'Picture'
										)
								)
						)
				)
		);
		
		$this->loadModel('City');
		$objCity = $this->City->findById($journals['Journal']['city_id']);
		$this->set('fullCityName',$objCity->getNameToExhibit());
		
		if ($journals['Journal']['user_id'] == $this->Auth->user('id')) {
			$this->Journal->updateview(date('Y-m-d H:i:s'),$id);
		}
		
		$this->set('journals', $journals);
		$this->set('friends', $friends);
		$this->set('friendlist',$friendlist);

		$this->Session->write('sharedemail', $share['Share']['email']);
		$this->Session->write('shareduser', $share['Share']['user_id']);
		
		$this->set('share',$share);
									
	}

/**
 * alphajournals method
 *
 * @return void
 */
	public function sharedjournals() {

		$this->loadModel('Share');
		$journals = $this->Share->find('all', array(
						'conditions'=>array(
							'Share.email'=>$this->Session->read('sharedemail')),
						'contain' => array(
							'Journal'=>array(
								'Comment' => array (
									'order'=>array('created'=>'DESC'),
									'User' => array(
										'Picture'
										)),
								'User' => array(
									'Picture'),
								'Photo',
								'Video',
								'Area',
								'Country',
								'Region',
								'City',
								'Currency',
								'Journalperm',
								'Journalrate',
								'Share',
								'Participation' => array('User'=>array(
									'Picture'))
							))
			));
		
		//debug($journals);
 		
		$this->loadModel('User');
		$this->set('user',$this->User->find('first', array(
							'conditions'=>array('User.id'=>$this->Session->read('shareduser')),
							'contain'=>array(
								'Picture'
								)
							)));
		$friends = $this->User->find('first', 
				array(
					'conditions' => array('User.id' => $this->Session->read('shareduser')),
					'contain' => array(
						'Relation_A' => array(
							'User_A'=> array('Picture'),
							'User_B'=> array('Picture')
						),
						'Relation_B' => array(
							'User_A'=> array('Picture'),
							'User_B'=> array('Picture')
						)						
					)
				)
			);
		$friendlist = array();
		foreach ($friends['Relation_A'] as $friend) :
			if ($friend['approved']) {
				$friendlist[$friend['User_B']['id']] = $friend['User_B']['firstname']." ".$friend['User_B']['lastname']	;
			}	
		
		endforeach;
		foreach ($friends['Relation_B'] as $friend) :
		
			if ($friend['approved']) {
				$friendlist[$friend['User_A']['id']] = $friend['User_A']['firstname']." ".$friend['User_A']['lastname']	;
			}
		
		endforeach;

		$this->loadModel('GroupsUser');
		$usersbygroup = $this->GroupsUser->find('all',array(
									'conditions'=>array('GroupsUser.user_id'=>$this->Auth->user('id'))
									));

		$this->loadModel('Group');
		$groupslist = $this->Group->find('list',array(
									'conditions'=>array('Group.user_id'=>$this->Auth->user('id'))
									));
		
//		die(debug($journal));
		$this->set('journals',$journals);
		
		$this->set('usersbygroup',$usersbygroup);				
		$this->set('groupslist',$groupslist);				
		$this->set('friends', $friends);
		$this->set('friendlist',$friendlist);
		

	}
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		/**
		* WALLACE
		* 10-29-2012
		* The add() functionality was transfered to editnew()
		**/
		$this->log("Using JournalsController::add() that is deprecated. Should use JournalsController:editnew()", 'deprecated');
		$this->redirect('editnew');
		exit();	
	}
	
/**
 * edit publish
 */

	public  function editpublish($id = null,$vpubl){
		$this->Journal->id = $id ;
		$this->Journal->saveField('ispublishable', $vpubl);
		$this->redirect($this->referer());
	}

/**
 * edit publish
 */

	public  function editdreamable($id = null,$vdrm){
		$this->Journal->id = $id ;
		$this->Journal->saveField('isdreamable', $vdrm);
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function adddesc($id = null) {
		
		$this->helpers[] = 'Modal';
		
		$this->loadAditionalCss('bootstrap.basecss.labelsandbadges');
		$this->loadAditionalCss('popover_journallist');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.base.icons');
		
		if(isset($this->request->data['Journal']['id'])){
			$id = $this->request->data['Journal']['id'];
		}
		
		$this->Journal->id = $id;
		
		$this->set('journalId',$this->Journal->id);
		$this->set('journals', $this->Journal->find('first', array (
					'conditions' => array(
						'Journal.id' => $id),
					'contain' => array(
						'Comment' => array (
							'User' => array(
								'Picture'
								)),
						'User' => array(
							'Picture'),
						'Photo',
						'Video',
						'Area',
						'Country',
						'Region',
						'City',
						'Currency',
						'Journalperm',
						'Journalrate',
						'Participation',
						'Share'
						)
					)
				)
			);
		
		
		$objJournal = $this->Journal->findById($this->Journal->id);
		
		$this->set('countAllowedPhotos2',$objJournal->getCountAllowedPhotosUpload(2));
		$this->set('countAllowedPhotos1',$objJournal->getCountAllowedPhotosUpload(1));
		$this->set('countAllowedPhotos0',$objJournal->getCountAllowedPhotosUpload(0));
		
		$this->set('objJournal',$objJournal);
		/**
		 * Security Check
		 */
		if (!$this->Journal->exists()) {
			throw new NotFoundException(__('Invalid journal'));
		}
		if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
			throw new NotFoundException('Journal was not found on the database.');
		}
			
		if(!$objJournal->checkIfIsTheOwner($this->objLoggedUser)){
			throw new ForbiddenException('User trying to access a journal without permission.');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if(isset($this->request->data['Journal']['forall_description'])){
				$this->request->data['Journal']['forall_description'] = nl2br(h($this->request->data['Journal']['forall_description']));
			}
			if(isset($this->request->data['Journal']['forgroup_description'])){
				$this->request->data['Journal']['forgroup_description'] = nl2br(h($this->request->data['Journal']['forgroup_description']));
			}
			if(isset($this->request->data['Journal']['forme_description'])){
				$this->request->data['Journal']['forme_description'] = nl2br(h($this->request->data['Journal']['forme_description']));
			}
			
			if ($this->Journal->save($this->request->data,false)) {
				$objJournal = $this->Journal->findById($this->Journal->getID());
				
				$objJournal->notifyCreation();
				
				$this->redirect(array('controller'=>'journals','action'=>'view',$this->Journal->id));
			}
		} else {
			$this->request->data = $this->Journal->read(null, $id);
		}
		
		$this->loadModel('User');
		$this->set('users',$this->User->find('first', 
			array(
				'conditions' => array('User.id' => $this->Auth->user('id')),
				'contain' => array('Picture'))));

		$friends = $this->User->find('first', 
				array(
					'conditions' => array('User.id' => $this->Auth->user('id')),
					'contain' => array(
						'Relation_A' => array(
							'User_A'=> array(
								'Picture',
								'Contact'=>array(
									'ResCountry',
									'ResRegion',
									'ResCity'),
								'GroupsUser'),
							'User_B'=> array(
								'Picture',
								'Contact'=>array(
									'ResCountry',
									'ResRegion',
									'ResCity'),
								'GroupsUser')
						),
						'Relation_B' => array(
							'User_A'=> array(
								'Picture',
								'Contact'=>array(
									'ResCountry',
									'ResRegion',
									'ResCity'),
								'GroupsUser'),
							'User_B'=> array(
								'Picture',
								'Contact'=>array(
									'ResCountry',
									'ResRegion',
									'ResCity'),
								'GroupsUser')
						)					
					)
				)
			);

		$usrjrnl = $this->Journal->Journalperm->find('all',array(
			'conditions'=>array(
				'Journalperm.journal_id'=>$this->data['Journal']['id']
				),
			'contain'=>false
			)
		);

		$isallfriend = ( $this->Journal->Journalperm->find(
			'first', array(
				'conditions'=>array(
					'Journalperm.journal_id'=>$id,
					'Journalperm.tablename_id'=>'3',
					'Journalperm.id_value'=>'0'))) ? 1 : 0 );
		$isallgroup = ( $this->Journal->Journalperm->find(
			'first', array(
				'conditions'=>array(
					'Journalperm.journal_id'=>$id,
					'Journalperm.tablename_id'=>'10',
					'Journalperm.id_value'=>'0'))) ? 1 : 0 );

		$friendlist = array();
		$jkey=0;
		foreach ($friends['Relation_A'] as $friend) :
			if ($friend['approved']) {
				$friendlist[]['User'] = $friend['User_B'];
				$friendlist[$jkey]['User']['allowed'] = 0;
				$jkey++;
			}	
		endforeach;
		foreach ($friends['Relation_B'] as $friend) :
		
			if ($friend['approved']) {
				$friendlist[]['User'] = $friend['User_A'];
				$friendlist[$jkey]['User']['allowed'] = 0;
				$jkey++;
			}
		endforeach;

		$jkey = 0;
		foreach ($friendlist as $friend) {
			if ( isset($usrjrnl) && !is_null($usrjrnl) ) {
				foreach ($usrjrnl as $jperm) {
					if  ($jperm['Journalperm']['tablename_id'] == '3' && 
						($jperm['Journalperm']['id_value'] == '0' || 
						 $jperm['Journalperm']['id_value'] == $friend['User']['id'])) {
						$friendlist[$jkey]['User']['allowed'] = 1;
						break;
					} else {
						if  ($jperm['Journalperm']['tablename_id'] == '10' && 
							 $jperm['Journalperm']['id_value'] == '0' && 
							 count($friend['User']['GroupsUser']) > 0 ) {
							$friendlist[$jkey]['User']['allowed'] = 1;
						} else {
							if  ($jperm['Journalperm']['tablename_id'] == '10' && 
								 $jperm['Journalperm']['id_value'] != '0' && 
							 	 count($friend['User']['GroupsUser'] ) > 0) {
								foreach ($friend['User']['GroupsUser'] as $grpusr) {
									if ($grpusr['group_id'] == $jperm['Journalperm']['id_value']) {
										$friendlist[$jkey]['User']['allowed'] = 1;
										break;
									}
								}
							} else {
								$friendlist[$jkey]['User']['allowed'] = 0;
							}
						}
					}
				}
			}
		$jkey++;
		}

		$this->set('usrjrnl',$usrjrnl);
		$this->set('isallfriend',$isallfriend);
		$this->set('isallgroup',$isallgroup);

		$this->loadModel('Group');
		$groups = $this->Group->find('all',array('conditions'=>array('Group.user_id'=>$this->Auth->user('id'))));
		$this->set('groupsimg',$this->Group->find('list',array(
				'conditions'=>array('Group.user_id'=>$this->Auth->user('id')),
				'fields'=>array('id','image')
		)));	

		$this->set('groupslist',$groups);
		$this->set('friends', $friends);
		$this->set('friendlist',$friendlist);
		
		$this->loadModel('Photo');
		$this->set('photos0', $this->Photo->find('all', array(
									'conditions'=>array(
										'AND'=>array(
										'Photo.journal_id'=>$this->Journal->id,'Photo.sharing_level'=>'0')))));
			
		$this->set('photos1', $this->Photo->find('all', array(
									'conditions'=>array(
										'AND'=>array(
										'Photo.journal_id'=>$this->Journal->id,'Photo.sharing_level'=>'1')))));
			
		$this->set('photos2', $this->Photo->find('all', array(
									'conditions'=>array(
										'AND'=>array(
										'Photo.journal_id'=>$this->Journal->id,'Photo.sharing_level'=>'2')))));
			
		
		$this->set(compact('friendlist','groupslist'));
		}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function changeperm() { 
		
		$this->layout = 'ajax';

	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function editnew($id = null) {
		$this->helpers[] = 'CachedElement';
		$this->loadAditionalJs('jquery-ui-1.9.1.datepicker');
		$this->loadAditionalCss('users');
		$this->loadAditionalCss('bootstrap.basecss.buttons');
		$this->loadAditionalCss('bootstrap.base.icons');
		
		
		if(isset($this->request->data['Journal']['id'])){
			$id = $this->request->data['Journal']['id'];
		}
		
		$this->Journal->id = $id;
		
		if($this->Journal->id){
			$objJournal = $this->Journal->findById($this->Journal->id);
			
			
			if(!is_object($objJournal) || (is_object($objJournal) && !$objJournal->getID())){
				throw new NotFoundException('Journal was not found on the database.');
			}
			
			if(!$objJournal->checkIfIsTheOwner($this->objLoggedUser)){
				throw new ForbiddenException('User trying to access a journal without permission.');
			}
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if($this->request->data['Journal']['user_id'] != $this->objLoggedUser->getID()){
				throw new ForbiddenException('User trying to create a journal for someone else.');
			}
			
			$this->setFields();
			
			if ($this->Journal->save($this->request->data)) {
				$this->redirect(array('controller'=>'journals','action'=>'adddesc',$this->Journal->id));
			} 
		} elseif($id) {
			$this->request->data = $this->Journal->read(null, $id);
			
			$this->loadModel('Area');
			$objArea = $this->Area->findById($this->request->data['Journal']['area_id']);
			$this->request->data['Area']['name'] = $objArea->getNameToExhibit();
			
			$this->loadModel('City');
			$objCity = $this->City->findById($this->request->data['Journal']['city_id']);
			$this->request->data['Journal']['city_name'] = $objCity->getNameToExhibit(); 
		}
		
		if(isset($this->request->data['Journal']['date_event'])){
			list($y,$m,$d) = explode('-',$this->request->data['Journal']['date_event']);
			$this->request->data['Journal']['date_event'] = $m.'/'.$d.'/'.$y;
		}
		
		$this->loadModel('User');	
		
		if(isset($this->data['Journal']['user_id']) && $this->data['Journal']['user_id']){
			$this->set('userid',$this->data['Journal']['user_id']);
		}else{
			$this->set('userid',$this->objLoggedUser->getID());
		}
		
						
		$this->set('users',$this->User->find('first', 
				array(
					'conditions' => array('User.id' => $this->Auth->user('id')),
					'contain' => array('Picture'))));
		
		$currencies = $this->Journal->Currency->find('list', array('fields'=> array('id','code'),'order'=>'code'));
		
		$this->set(compact('currencies','photos','friendlist','groupslist'));
		
		
		
	}

/**
 * delete on view method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Journal->id = $id;
		if (!$this->Journal->exists()) {
			throw new NotFoundException(__('Invalid journal'));
		}
		if ($this->Journal->delete()) {
			$this->Session->setFlash(__('Journal deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal was not deleted'));
		$this->redirect(array('action'=>'index'));
	}
	
	/**
	 * Sets the fields
	 * 
	 */
	public function setFields(){
		
		$this->request->data['Journal']['date_event'] = date('Y-m-d', strtotime($this->request->data['Journal']['date_event']));
		
		if ((!isset($this->request->data['Area']['id']) || !$this->request->data['Area']['id']) && $this->request->data['Area']['name']) {
			$userDefined = $this->Journal->Area->find('first', array(
					'conditions'=> array(
							'Area.name'=>'User defined')));
				if(!is_array($userDefined) ||  count($userDefined) == 0){
					$userDefined = array('Area'=>array('id'=>0));
					$this->log('Default Area_ID "User defined" doesn\'t exist.'.__FILE__.':'.__LINE__,'alert');
				}
				
				$this->request->data['Area']['id'] = null;
				$this->request->data['Area']['name'] = $this->request->data['Area']['name'];
				$this->request->data['Area']['parent_id'] = $userDefined['Area']['id'];
				$this->request->data['Area']['user_id'] = $this->request->data['Journal']['user_id'];
				$this->request->data['Area']['active'] = 0;
				
				$warea = $this->Journal->Area->save($this->request->data);
		}
		
		if($this->request->data['Area']['id']){
			$this->request->data['Journal']['area_id'] = $this->request->data['Area']['id'];
		}elseif(isset($warea['Area']['id'])){
			$this->request->data['Journal']['area_id'] = $warea['Area']['id'];
		}	
		
		
		
		if ((!isset($this->request->data['Journal']['city_id']) || !$this->request->data['Journal']['city_id']) && $this->request->data['Journal']['city_name']) {
				$city['City']['name'] = $this->request->data['Journal']['city_name'];
				$city['City']['country_id'] = 0;
				$city['City']['region_id'] = 0;
				$city['City']['latitude'] = 0;
				$city['City']['longitude'] = 0;
				$city['City']['timezone'] = 0;
				$city['City']['dmaid'] = 0;
				$city['City']['code'] = 0;
				$city['City']['user_id'] = $this->objLoggedUser->getAttr('id');
				
				$this->Journal->City->set($city);
				if($this->Journal->City->save()){
					$this->request->data['Journal']['city_id'] = $this->Journal->City->getInsertID();
				}
				
				
			
		}
	}
	
	public function journalRow(){
		
		$objJournal = $this->Journal->listMostRecent();

		
		$this->set('objJournal', $objJournal);
		
	}

}
