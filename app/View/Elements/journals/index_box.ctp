<?php

	 
for ($i=0; $i < count($arrayObjJournal); $i++) { 

	$objJournal = $arrayObjJournal[$i];
	
	if(is_object($objJournal)){
?>
    
		    <div class="row-fluid">			    	
			    <div class="span6 " >
					<?php
						echo $this->element('journals/journal_row',array('objJournal'=>$objJournal));
					?>
				</div>
				<?php
					$i++;
					if(isset($arrayObjJournal[$i])){
						$objJournal2 = $arrayObjJournal[$i]; 
				?>				
			    <div class="span6 ">
			    	<?php
						echo $this->element('journals/journal_row',array('objJournal'=>$objJournal2));
					?>		    	
			    </div>
			    <?php
					} 
				?>
		    </div>
	    
     
<?php
	}
}
?>


