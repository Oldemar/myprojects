<?php
App::uses('AppModel', 'Model');
/**
 * Video Model
 *
 * @property Journal $Journal
 */
class Videocomment extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
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
	
	public function saveDesc($data){
		$this->save($data);
//		echo $data['Photo']['journal_id'];
//		echo "data<br>";
//		die("<pre>".print_r($data,true)."</pre>");
		return true;
	}
	public function insertVideoComment($objVideo, $objUser, $strComment){
		$data = array();
		$data['VideoComment']['video_id'] = $objVideo->getID();
		$data['VideoComment']['user_id'] = $objUser->getID();
		$data['VideoComment']['comment'] = $strComment;
		$this->create($data);
		
		if(!$this->save()){
			$e = new Exception("ValidationError", 1);
			$e->validationErrors = $this->validationErrors;
			
			throw $e;
			
		}else{
			return true;
		}
	}
}
