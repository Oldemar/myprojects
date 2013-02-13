<?php
$objController->loadAditionalCss('style'); 
echo $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>$sharingLevel));
?>