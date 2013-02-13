<?php 

	foreach($arrObjWork as $key => $value){
		echo $this->element('Works/work_row', array('objWork'=>$value));
	}

?>	
