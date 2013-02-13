<?php 
App::uses('HtmlHelper', 'View/Helper');
Class ImageHelper extends HtmlHelper {

	public function image($path,$options=array()){
		if($path[0] == '/'){
			$path = substr($path, 1);
		}
		$path = Configure::read('IMG_URL').$path;
		return parent::image($path,$options);
	}
	
}

?>