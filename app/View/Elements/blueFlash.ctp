<?php 
if(is_object($objController)){
	$objController->loadAditionalCss('bootstrap.components.alert');
}
?>
<div class="alert alert-info"><?php echo $message; ?></div>