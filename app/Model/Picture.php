<?php
App::uses('AppModel', 'Model');
App::uses('Folder','Utility');
App::uses('File','Utility');
/**
 * Picture Model
 *
 * @property User $User
 */
class Picture extends AppModel {
	public $compressionRate = 35;

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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	protected function uploadFile($resizeTarget) {
		
		if ($this->uploadData['error'] === UPLOAD_ERR_OK) {
			
			
			// Perform compression
			return $this->compress_image($this->uploadData['tmp_name'], $resizeTarget, $this->compressionRate);
			
		}

		$this->invalidate('file', 'Failed to upload file');

		return false;
	}
	
	protected function compress_image($source_url, $destination_url, $quality) {
	        $info = getimagesize($source_url);

	        if ($info['mime'] == 'image/jpeg'){
	                $image = imagecreatefromjpeg($source_url);
	        }elseif ($info['mime'] == 'image/gif'){
	                $image = imagecreatefromgif($source_url);
	        }elseif ($info['mime'] == 'image/png'){
	                $image = imagecreatefrompng($source_url);
			}else{
				return false;
			}
			
	        // save it
	        if(!imagejpeg($image, $destination_url, $quality)){
	        	return false;
	        }
			
	        // return destination file url
	        return $destination_url;
	}
	
	protected function createThumbnails($nw){
	        $source = IMAGES.$this->getAttr('name');
	       	$tmpSource = explode(DS,$source);
	        list($fname,$stype) = explode(".", $tmpSource[count($tmpSource)-1]);
	        
	        $dest = $this->getCompletePathToUserUploadFolder().$fname.'_'.$nw.'.'.$stype;
	        
	        $this->data['Picture']['w'.$nw] = 'uui/'.$this->User->getUploadFolderName().$fname.'_'.$nw.'.'.$stype;
	 
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
	        
	}
	
	protected function createPicture(){
		if(!is_object($this->User) || !$this->User->getAttr('id')){
			throw new Exception("User not associated with object picture", 1);
		}
		$this->data['Picture']['user_id']	= $this->User->getAttr('id');
		$this->data['Picture']['url']		= Configure::read('IMG_URL');
		$this->create($this->data);
		
		chmod(IMAGES.$this->data['Picture']['name'],0777);
		chmod(IMAGES.$this->data['Picture']['w40'],0777);
		chmod(IMAGES.$this->data['Picture']['w90'],0777);
		chmod(IMAGES.$this->data['Picture']['w190'],0777);
		
		return $this->save();
	}
	
	public function uploadToAmazonS3(){
		if(!file_exists(IMAGES.$this->getAttr('name'))){
			throw new Exception('Image file does not exists. File:'.IMAGES.$this->getAttr('name'));
		}
		if(!file_exists(IMAGES.$this->getAttr('w40'))){
			throw new Exception('Image file does not exists. File:'.IMAGES.$this->getAttr('w40'));
		}
		if(!file_exists(IMAGES.$this->getAttr('w90'))){
			throw new Exception('Image file does not exists. File:'.IMAGES.$this->getAttr('w90'));
		}
		if(!file_exists(IMAGES.$this->getAttr('w190'))){
			throw new Exception('Image file does not exists. File:'.IMAGES.$this->getAttr('w190'));
		}
		
		$amazonS3 = $this->loadModel('AmazonS3ImageBucket');
		$amazonS3->init(); // necessary for now; maybe not in the future
		$amazonS3->putObjectFile(IMAGES.$this->getAttr('name'), $amazonS3->bucket, 'img/'.$this->getAttr('name'), S3::ACL_PUBLIC_READ);
		$amazonS3->putObjectFile(IMAGES.$this->getAttr('w40'), $amazonS3->bucket, 'img/'.$this->getAttr('w40'), S3::ACL_PUBLIC_READ);
		$amazonS3->putObjectFile(IMAGES.$this->getAttr('w90'), $amazonS3->bucket, 'img/'.$this->getAttr('w90'), S3::ACL_PUBLIC_READ);
		$amazonS3->putObjectFile(IMAGES.$this->getAttr('w190'), $amazonS3->bucket, 'img/'.$this->getAttr('w190'), S3::ACL_PUBLIC_READ);
		
		return true;
	}
	
	public function generateName(){
		return "u".$this->User->getAttr('id').date('YmdHis');
	}
	

	public function updatePicture($data) {
			
		$this->User->id = $this->data['User']['id'];
		
		$this->User->saveField('picture_id',$this->data['Picture']['id']);
	
		return true ;
	}
	
	public function uploadPictureForUser($objUser, $pictureData){
		
		if(isset($pictureData['Picture']['upload']) && $pictureData['Picture']['upload']){
			$this->create();
			
			$this->uploadData	= $pictureData['Picture']['upload'];
			$this->User 		= $objUser;
			
			
			$tmp = split('\.', $this->uploadData['name']);
			$extention = $tmp[count($tmp)-1];
			
			// Target filename is the time, to the second, with the original file extension.
			$this->data['Picture']['name']	= 'uui/'.$this->User->getUploadFolderName().$this->generateName().'.'.$extention;
			$resizeTarget 					= $this->getCompletePathToUserUploadFolder().$this->generateName().'.'.$extention;
			
			if(!file_exists(IMAGES.Picture::getPathToUploadFolder())){
				@mkdir(IMAGES.Picture::getPathToUploadFolder(),0777,true);
			}
			
			if(!file_exists($this->getCompletePathToUserUploadFolder())){
				@mkdir($this->getCompletePathToUserUploadFolder(),0777,true);
			}
			
			
			if(!$this->uploadFile($resizeTarget)){
				return false;
			}
			
			$this->createThumbnails(40);
			$this->createThumbnails(90);
			$this->createThumbnails(190);
			
			
			if(!$this->createPicture()){
				return false;
			}

			$picture = $this->findById($this->getID(),array(),0);
			if(Configure::read('environment') == 'production'){
				if($picture->uploadToAmazonS3()){
					$picture->deleteFiles();
				}
			}	
			
			return $picture;
		}else{
			
			exit('Error');
		}
	}
	
	public static function getPathToUploadFolder(){
		return Configure::read('UUI');
	}
	
	/**
	*	Returns the complete path on HD to the userUploadFolder
	**/
	public function getCompletePathToUserUploadFolder($objUser = ''){
		if(!is_object($objUser) && is_object($this->User)){
			$objUser = $this->User;
		}
		
		if(!is_object($objUser)){
			return false;
		}
		return IMAGES.Picture::getPathToUploadFolder().$objUser->getUploadFolderName();
	}	
	
	public function deleteFiles(){
		$file = new File(IMAGES.$this->data['Picture']['name'],false,0777);
		if($file->exists() && !$file->delete()){
			throw new Exception('Error deleting file: '.IMAGES.$this->data['Picture']['name']);
		}
		$file = new File(IMAGES.$this->data['Picture']['w40'],false,0777);
		if($file->exists() && !$file->delete()){
			throw new Exception('Error deleting file: '.IMAGES.$this->data['Picture']['w40']);
		}
		$file = new File(IMAGES.$this->data['Picture']['w90'],false,0777);
		if($file->exists() && !$file->delete()){
			throw new Exception('Error deleting file: '.IMAGES.$this->data['Picture']['w90']);
		}
		$file = new File(IMAGES.$this->data['Picture']['w190'],false,0777);
		if($file->exists() && !$file->delete()){
			throw new Exception('Error deleting file: '.IMAGES.$this->data['Picture']['w190']);
		}
		return true;
	}
	
	protected function deleteFromAmazonS3(){
		$amazonS3 = $this->loadModel('AmazonS3ImageBucket');
		$amazonS3->init(); // necessary for now; maybe not in the future
		$amazonS3->deleteObject($amazonS3->bucket, 'img/'.$this->getAttr('name'));
		$amazonS3->deleteObject($amazonS3->bucket, 'img/'.$this->getAttr('w40'));
		$amazonS3->deleteObject($amazonS3->bucket, 'img/'.$this->getAttr('w90'));
		$amazonS3->deleteObject($amazonS3->bucket, 'img/'.$this->getAttr('w190'));
	}
	
	public function deletePicture(){
		$this->deleteFiles();
		if(Configure::read('environment') == 'production'){
			$this->deleteFromAmazonS3();
		}
		
		return $this->delete(); 
	}

}