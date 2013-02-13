<?php 
if(is_object($objController)){
	$objController->loadAditionalCss('bootstrap.components.alert');
}
?>
<div class="alert alert-error"><?php echo $message; ?></div>