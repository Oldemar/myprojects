<?php 

	foreach($arrObjEducation as $key => $value){
		echo $this->element('Educations/education_row', array('objEducation'=>$value));
	}

?>	
