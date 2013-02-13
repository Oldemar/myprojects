<?php 
if(is_object($objController)){
	$objController->loadAditionalCss('bootstrap.components.alert');
}
?>
<div class="alert alert-success"><?php echo $message; ?></div>