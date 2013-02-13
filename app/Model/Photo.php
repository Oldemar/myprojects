<?php
App::uses('AppModel', 'Model');
App::uses('File', 'Utility');
/**
 * Photo Model
 *
 * @property Journal $Journal
 */
class Photo extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	var $compressionRate = 35;

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
		'Photocomment' => array(
			'className' => 'Photocomment',
			'foreignKey' => 'photo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function SavePhoto($data) {
		/** WALLACE
		 * This method is not used anymore
		 */
		/*
		# for me photos upload
		if ( (isset($data['Photo']['files0'])) && ($data['Photo']['files0']!=null) ) {
			$idfile0 = 0 ;
	
			foreach ($data['Photo']['files0'] as $photo) :
		        if ($photo['error'] === UPLOAD_ERR_OK) {
		        				// Resize image
					$tmp = split('\.', $photo['name']);
					// Target filename is the time, to the second, with the original file extension.
					$resizeTarget = "j0".$data['Photo']['journal_id'].$idfile0.date('YmdHis').'.'.$tmp[count($tmp)-1];
					// Perform compression
					$this->compress_image($photo['tmp_name'], $resizeTarget, $this->compressionRate);
					// Save image ... was saving as file['name'] ... reworked to use unique identifier
					if (rename($resizeTarget, 'img/'.$resizeTarget)) {
		                $data['Photo']['name'] = $resizeTarget;
		                $data['Photo']['url'] = null;
		                $data['Photo']['id'] = null;
		                $data['Photo']['sharing_level'] = 0;
						$this->save($data);
		            	}
		        }
		        $idfile0++;
		    endforeach;
		}
		# for group photos upload
		if ( (isset($data['Photo']['files1'])) && ($data['Photo']['files1']!=null) ) {
			$idfile1 = 0 ;
	
			foreach ($data['Photo']['files1'] as $photo) :
		        if ($photo['error'] === UPLOAD_ERR_OK) {
		        				// Resize image
					$tmp = split('\.', $photo['name']);
					// Target filename is the time, to the second, with the original file extension.
					$resizeTarget = "j1".$data['Photo']['journal_id'].$idfile1.date('YmdHis').'.'.$tmp[count($tmp)-1];
					// Perform compression
					$this->compress_image($photo['tmp_name'], $resizeTarget, $this->compressionRate);
					// Save image ... was saving as file['name'] ... reworked to use unique identifier
					if (rename($resizeTarget, 'img/'.$resizeTarget)) {
		        	    $data['Photo']['name'] = $resizeTarget;
		                $data['Photo']['url'] = null;
		                $data['Photo']['id'] = null;
		                $data['Photo']['sharing_level'] = 1;
						$this->save($data);
		            	}
		        }
		        $idfile1++;
		    endforeach;
		}
		# for all photos upload
		if ( (isset($data['Photo']['files2'])) && ($data['Photo']['files2']!=null) ) {
			$idfile2 = 0;
	
			foreach ($data['Photo']['files2'] as $photo) :
		        if ($photo['error'] === UPLOAD_ERR_OK) {
		        				// Resize image
					$tmp = split('\.', $photo['name']);
					// Target filename is the time, to the second, with the original file extension.
					$resizeTarget = "j2".$data['Photo']['journal_id'].$idfile2.date('YmdHis').'.'.$tmp[count($tmp)-1];
					// Perform compression
					$this->compress_image($photo['tmp_name'], $resizeTarget, $this->compressionRate);
					// Save image ... was saving as file['name'] ... reworked to use unique identifier
					if (rename($resizeTarget, 'img/'.$resizeTarget)) {
		        	    $data['Photo']['name'] = $resizeTarget;
		                $data['Photo']['url'] = null;
		                $data['Photo']['id'] = null;
		                $data['Photo']['sharing_level'] = 2;
						$this->save($data);
		            	}
		        }
		        $idfile2++;
		    endforeach;
		}
//				die("<pre>".print_r($data,true)."</pre>");
		return true;*/
	}
	
	function compress_image($source_url, $destination_url, $quality) {
	        $info = getimagesize($source_url);

	        if ($info['mime'] == 'image/jpeg')
	                $image = imagecreatefromjpeg($source_url);
	        elseif ($info['mime'] == 'image/gif')
	                $image = imagecreatefromgif($source_url);
	        elseif ($info['mime'] == 'image/png')
	                $image = imagecreatefrompng($source_url);

	        // save it
	        imagejpeg($image, $destination_url, $quality);

	        // return destination file url
	        return $destination_url;
	}

	public function saveDesc($description){
		$this->data['Photo']['description'] = $description;
		$this->save($data);

		return true;
	}
	
	public function saveCover($id,$jid){
		$this->Journal->id = $jid;
		$this->Journal->saveField('photo_id', $id);
		return true;
	}
	
	public function saveSharingLevel($sharingLevel){
		$this->saveField('sharing_level', $sharingLevel);
		return true;
	}
	
	/**
	* Uploads an photo, compress, create Thumbnails and vinculate the photo to the journal
	* @param $objJournal object of the journal that you want to upload the photo to
	* @param $file is the position of the photo to be uploaded in the Global $_FILES ex: uploadAndAddPhoto($_FILES['pic'])
	* @param $shrlevel 0 or 1 or 2
	**/
	public function uploadPhotoToJournal($objJournal, $file, $shrlevel){
		$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
		$initials = 'pj'.$shrlevel;
		
		try{
			$destinationPath = $objJournal->getCompletePathToUserUploadFolder();
			if(!file_exists($destinationPath)){
				$objJournal->loadObject('User');
				@mkdir($objJournal->User->Picture->getCompletePathToUserUploadFolder($objJournal->User),0777,true);
			}	
		}catch(Exception $e){
			throw $e;
		}
			
		$quality = 75;
		
        $info = @getimagesize($file['tmp_name']);
        $fileParts = pathinfo($file['name']);
		$tempFile   = $file['tmp_name'];
		$fname = $initials.date('YmdHis').rand(100000, 999999);
		$targetFile = $destinationPath.$fname.'.'.$fileParts['extension'];
		$targetThumb50 = $destinationPath.$fname.'_50.'.$fileParts['extension'];
		$targetThumb150 = $destinationPath.$fname.'_150.'.$fileParts['extension'];
		$targetThumb240 = $destinationPath.$fname.'_240.'.$fileParts['extension'];
		$targetThumb520 = $destinationPath.$fname.'_520.'.$fileParts['extension'];
		
		
		// Validate the filetype
		if (!in_array(strtolower($fileParts['extension']), $fileTypes)) {
			throw new Exception('Not a valid image file');
		}
		
		$finfo = new finfo(FILEINFO_MIME);
		$type = $finfo->file($tempFile);
		$info['mime'] = substr($type, 0, strpos($type, ';'));

        if ($info['mime'] == 'image/jpeg'){
                $image = imagecreatefromjpeg($file['tmp_name']);
        }elseif ($info['mime'] == 'image/gif'){
                $image = imagecreatefromgif($file['tmp_name']);
        }elseif ($info['mime'] == 'image/png'){
                $image = imagecreatefrompng($file['tmp_name']);
		}else {
			throw new Exception('The file must be an image');
		}         

        // save it
        if(!imagejpeg($image, $targetFile, $quality)){
        	throw new Exception('Error compressing the image');
        }
        
        $this->createThumbnails(1280 ,$targetFile,$targetFile);
        $this->createThumbnails(50,$targetThumb50,$targetFile);
        $this->createThumbnails(150,$targetThumb150,$targetFile);
        $this->createThumbnails(240,$targetThumb240,$targetFile);
        $this->createThumbnails(520,$targetThumb520,$targetFile);
        
		
		$this->create();
		$targetFolder = 'uui/'.$objJournal->User->getUploadFolderName();
		$this->data['Photo']['journal_id'] = $objJournal->getID();
		$this->data['Photo']['url'] = '/img/';
		//$this->data['Photo']['url'] = $objJournal->getObject('User')->getUploadFolderName();
		$this->data['Photo']['name'] = $targetFolder.$fname.'.'.$fileParts['extension'];
		$this->data['Photo']['w50'] = $targetFolder.$fname.'_50.'.$fileParts['extension'];
		$this->data['Photo']['w150'] = $targetFolder.$fname.'_150.'.$fileParts['extension'];
		$this->data['Photo']['w240'] = $targetFolder.$fname.'_240.'.$fileParts['extension'];
		$this->data['Photo']['w520'] = $targetFolder.$fname.'_520.'.$fileParts['extension'];
		$this->data['Photo']['description'] = basename($fileParts['basename'],$fileParts['extension']) ;
		
		$this->data['Photo']['sharing_level'] = $shrlevel;
		$this->data['Photo']['created'] = date('Y-m-d H:i:s');
		if($data = $this->save()){
			$this->data = $data;
			return $this;
		}else{
			return false;
		}
		
	}
	
	/**
	* Creates thumbnail files to the journal photo
	* @param: $nw: Width of the thumbnail to be created in px
	* @param: $destination complete path to the new thumbnail. Must include the name of the thumbnail
	* @param: $source: complete path to the source image that will be used to create the thumbnail
	**/
	protected function createThumbnails($nw,$destination,$source){
	       	$tmpSource = explode(DS,$source);
	        $dest = $destination;
	        
	        $tmpSource = explode(DS,$source);
	        list($fname,$stype) = explode(".", $tmpSource[count($tmpSource)-1]);
	 
	        $size = getimagesize($source);
	        $w = $size[0];
	        $h = $size[1];
	        
	        $ratio = $nw / $w;
	        $nh = $h * $ratio; 
	 
	        $finfo = new finfo(FILEINFO_MIME);
			$type = $finfo->file($source);
			$mime = substr($type, 0, strpos($type, ';'));

			if($mime == 'image/jpeg'){
				$simg = imagecreatefromjpeg($source);
			}else{
	
		        switch($stype) {
		            case 'gif':
		            case 'GIF':
		            case 'Gif':
		                $simg = imagecreatefromgif($source);
		                break;
		            case 'jpg':
		            case 'JPG':
		            case 'Jpg':
		                $simg = imagecreatefromjpeg($source);
		                break;
		            case 'png':
		            case 'PNG':
		            case 'Png':
		                $simg = imagecreatefrompng($source);
		                break;
		        }
	        
			}
			
	        if(!$simg){
	        	$simg = @imagecreatefrompng($source);
	        }
	 
	        $dimg = imagecreatetruecolor($nw, $nh);
	        $wm = $w/$nw;
	        $hm = $h/$nh;
	        $h_height = $nh/2;
	        $w_height = $nw/2;
	 
	        if($w> $h) {
	            $adjusted_width = $w / $hm;
	            $half_width = $adjusted_width / 2;
	            $int_width = $half_width - $w_height;
	            imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
	        } elseif(($w <$h) || ($w == $h)) {
	            $adjusted_height = $h / $wm;
	            $half_height = $adjusted_height / 2;
	            $int_height = $half_height - $h_height;
	 
	            imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
	        } else {
	            imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
	        }
	        
	        imagejpeg($dimg,$dest,100);
	        chmod($dest,0777);
	}

	/**
	* Load Photo Comments
	**/
	public function loadComments(){
		$this->buildHasMany('Photocomment',array('order'=>'created desc'));
	}
	
	/**
	* Return a array with the image information. This array is used on the JS Galleria Plugin  
	**/
	public function getArrToDisplayGallery(){
		$arr = array();
		$arr['id'] = $this->getAttr('id');
		$arr['journalId'] = $this->getAttr('journal_id');
		$arr['image'] = $this->getAttr('url').$this->getAttr('w520');
		$arr['title'] = '';
		$arr['big'] = $this->getAttr('name');
		$arr['description'] = $this->getAttr('description');
        //$arr['link'] =$this->getAttr('url').$this->getAttr('w520');
        return $arr;
	}

	/**
	 * Post a comment to the photo.
	 * @param: $objUser 
	 * @param: $strComment -> the string of the comment that needs to be saved to db
	 */
	
	public function postComment($objUser, $strComment){
		$objPhotoComment = $this->loadModel('PhotoComment');
		return $objPhotoComment->insertPhotoComment($this, $objUser, $strComment);
	}
	
	public function checkIfUserCanSeePhoto(User $objUser, Journal $objJournal){
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

	public function getFullPath($size) {
		return Picture::getPathToUploadFolder().$this->getAttr('url').$this->getAttr($size);
	}
	/*
	 *  Delete photo from DB and server
	 *  @param: none
	 */
	
	public function deletePhoto(){
		
		$url = $this->getAttr('url');
		$photonames = array($this->getAttr('name'),$this->getAttr('w50'),$this->getAttr('w150'),$this->getAttr('w240'),$this->getAttr('w520'));
		if ($this->delete()) {
			foreach($photonames as $file) {
				
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
	
	public function getUrl($size='name'){
		return '/img/'.$this->getAttr('url').$this->getAttr($size);
	}
	
	public static function getNoCoverPhotoObject(){
		ClassRegistry::init('Journal');
		$objPhoto = ClassRegistry::init('Photo');
		$objPhoto->id = null;
		$objPhoto->data['Photo']['id'] = null;
		$objPhoto->data['Photo']['url'] = '/img/';
		$objPhoto->data['Photo']['name'] = Journal::getNoCoverPhotoImagePath();
		$objPhoto->data['Photo']['w50'] = Journal::getNoCoverPhotoImagePath();
		$objPhoto->data['Photo']['w150'] = Journal::getNoCoverPhotoImagePath();
		$objPhoto->data['Photo']['w240'] = Journal::getNoCoverPhotoImagePath();
		$objPhoto->data['Photo']['w520'] = Journal::getNoCoverPhotoImagePath();
	
		return $objPhoto;
	}
	
}
