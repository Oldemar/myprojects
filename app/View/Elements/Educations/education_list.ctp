<?php 
	
	foreach($arrObjEducation as $objEducation){
		
?>
	
	<?php 
	
	if (!$objEducation->getAttr('perm')) $perm = $this->Html->image('P.jpg');
	else $perm = $this->Html->image($cl_i = ($objEducation->getAttr('perm') == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg'));
		
	?>
	
	<?php $str = h($objEducation->Edulevel->getAttr('name')); ?>
		
	<?php $str .= ', '; ?>
	<?php $str .=  h($objEducation->Institute->getAttr('name')); ?>
	
	<?php $location = h($objEducation->City->getNameToExhibit()); ?>
	
	<?php $date = h($objEducation->getAttr('startdate')); ?>
	<?php $date .= " - "; ?>

	<?php $labeldate = ($objEducation->getAttr('enddate') == '9999-99-99')? 'Present': $objEducation->getAttr('enddate'); ?>
	<?php $date .= h($labeldate); ?>

	
	<div class="row-fluid employmentrow" id="educationrow_<?php echo $objEducation->getAttr('id'); ?>" >
	    <div class="span7"><?php echo $perm." ".$str; ?>
	   	<span class="below"><?php echo $location; ?></span>
	    </div>
	    <div class="span4 rightcolumn"><?php echo $date; ?></div>
	   	<div class="span1">
	   		<span class="wedit" id="cedit_<?php echo $objEducation->getAttr('id'); ?>"> <a href="javascript:;" id="empEdit_<?php echo $objEducation->getAttr('id'); ?>">EditIcon</a></span>
	   	</div>
   	 </div>

    <script>
    	$('#cedit_<?php echo $objEducation->getAttr('id'); ?>').click(function(){

    		$.ajax({
    			  url: "<?php echo $this->Form->url('/educations/educationEdit/'.$objEducation->getAttr('id'))?>",
    			  success: function(data) {

        			  $('#educationrow_<?php echo $objEducation->getAttr('id'); ?>').html(data);
        			  $('#educationrow_<?php echo $objEducation->getAttr('id'); ?>').show();
    			  },
    			  beforeSend: function(){
    				  $('#educationrow_<?php echo $objEducation->getAttr('id'); ?>').hide();
    				  $('#educationrow_<?php echo $objEducation->getAttr('id'); ?>').html('LOADING');  	
    			  }	  
    			});
        })
    
    </script>

<?php 
	}// END foreach
?>
