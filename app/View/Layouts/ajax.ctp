<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * 
 */
?>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>-->
<?php

	if(isset($objController) && is_object($objController)){
		$objController->loadAditionalCss('bootstrap.miscellaneous.close_icon');
	
		$aditionalCss = $objController->listAditionalCss();
	
		if(is_array($aditionalCss) && count($aditionalCss) > 0){
			echo $this->Html->css($aditionalCss);
		}
		
		$aditionalJs = $objController->listAditionalJs();
	
		if(is_array($aditionalJs) && count($aditionalJs) > 0){
			echo $this->Html->script($aditionalJs);	
		}
	}
	
 	echo $content_for_layout; 
 
 	echo $this->Js->writeBuffer();
 	
 ?>