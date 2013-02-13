<?php
App::uses('AppModel', 'Model');
/**
 * Video Model
 *
 * @property Journal $Journal
 */
class Video extends AppModel {
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
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasMany = array(
		'Videocomment' => array(
			'className' => 'Videocomment',
			'foreignKey' => 'video_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function saveDesc($data){
		$this->save($data);
//		echo $data['Photo']['journal_id'];
//		echo "data<br>";
//		die("<pre>".print_r($data,true)."</pre>");
		return true;
	}

	public function saveSharingLevel($sharingLevel){
		$this->saveField('sharing_level', $sharingLevel);
		return true;
	}
	
	public function getFullPathAndVideoName() {
		return Picture::getPathToUploadFolder().$this->getAttr('url').$this->getAttr('name').".jpg";
	}

	/**
	* Load Photo Comments
	**/
	public function loadComments(){
		$this->buildHasMany('Videocomment',array('order'=>'created desc'));
	}
	
	/**
	* Return a array with the image information. This array is used on the JS Galleria Plugin  
	**/
	public function getArrToDisplayGallery(){
		$arr = array();
		$arr['id'] = $this->getAttr('id');
		$arr['journalId'] = $this->getAttr('journal_id');
		$arr['iframe'] = FULL_BASE_URL.'/videos/playvideo/'.$this->getID();
		$arr['title'] = '';
		$arr['big'] = $this->getAttr('name');
		$arr['description'] = $this->getAttr('description');
        //$arr['link'] =$this->getAttr('url').$this->getAttr('w520');
        return $arr;
	}
	
	public function postVideoComment($objUser, $strComment){
		$objVideoComment = $this->loadModel('VideoComment');
		return $objVideoComment->insertVideoComment($this, $objUser, $strComment);
	}
	
	public function checkIfUserCanSeeVideo(User $objUser, Journal $objJournal){
		switch ($this->getAttr('sharing_level')) {
			case '0':
				if($objJournal->data['Journal']['user_id'] == $objUser->getID()){
					return true;
				}else{
					return false;
				}
				break;
					
			case '1':
				if($objJournal->checkCanSeeFriendSection($objUser)){
					return true;
				}else{
					return false;
				}
				break;
	
			case '2':
				return true;
				break;
					
			default:
				throw new Exception("Invalid sharing level", 1);
					
				break;
		}
	}
		
	public function deleteVideo(){

		$url = $this->getAttr('url');
		$videonames = array($this->getAttr('name').".".$this->getAttr('originalextension'),$this->getAttr('name').".mp4",$this->getAttr('name').".jpg",$this->getAttr('w140').".jpg",$this->getAttr('w375').".jpg");
		if ($this->delete()) {
			foreach($videonames as $file) {
		
				if($url == 'https://dtv9xkr1dhc5e.cloudfront.net/img/'){
					$amazonS3 = $this->loadModel('AmazonS3ImageBucket');
					$amazonS3->init(); // necessary for now; maybe not in the future
					$amazonS3->deleteObject($amazonS3->bucket, 'img/'.$file);
				}
		
				$fileToBeDeleted = new File(WWW_ROOT.IMAGES_URL.$file,false,0777);
				if($fileToBeDeleted->exists()){
					$fileToBeDeleted->delete();
				}
		
			}
			return true;
		}
		return false;
		
	}
	
	public function getDistinctVideoURL(){
		$r = $this->find('all', array('contain'=>false ,'fields' => array('DISTINCT Video.url')));
		return $r;
	}
	
	
}
