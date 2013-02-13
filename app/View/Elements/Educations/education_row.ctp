<?php 

if (!$objEducation->data['Education']['perm']) $perm = $this->Html->image('P.jpg');
else $perm = $this->Html->image($cl_i = ($objEducation->data['Education']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg'));
	
?>

<?php $str = h($objEducation->Edulevel->data['Edulevel']['name']); ?>
	
<?php $str .= ', '; ?>
<?php $str .=  h($objEducation->Institute->data['Institute']['name']); ?>

<?php $location = h($objEducation->City->getNameToExhibit()); ?>

<?php

	if ($objEducation->data['Education']['start_month'] =='00' || $objEducation->data['Education']['start_day'] == '00' || $objEducation->data['Education']['start_year'] =='0000'){
		
		$startdate = $date = ($objEducation->data['Education']['startdate'] == '0000-00-00')?'Date Unknown': $objEducation->data['Education']['startdate'];
	}else{
		
		$startdate = ($objEducation->data['Education']['startdate'] == '0000-00-00')? 'Date Unknown': CakeTime::format('F jS, Y',$objEducation->data['Education']['startdate']); 
	}
	
	if ($objEducation->data['Education']['end_month'] =='00' || $objEducation->data['Education']['end_day'] == '00' || $objEducation->data['Education']['end_year'] =='0000'){
		
		$enddate = $date = ($objEducation->data['Education']['enddate'] == '0000-00-00')?'Date Unknown': $objEducation->data['Education']['enddate'];
	}else{
		
		$enddate = ($objEducation->data['Education']['enddate'] == '0000-00-00')? 'Date Unknown': ($objEducation->data['Education']['enddate'] == '9999-99-99')? 'Present': CakeTime::format('F jS, Y',$objEducation->data['Education']['enddate']); 
	}

 	$date = h($startdate.' - '.$enddate);
?>

<div class="row-fluid itemrow" id="educationrow_<?php echo $objEducation->data['Education']['id']; ?>" >
    <div class="span10"><b><?php echo $perm." ".$str; ?></b><br>
   		<span class="below"><?php echo $location; ?></span><br>
   		<?php echo $date; ?>
    </div>
    
   	<div class="span2">
   		<span class="wedit" id="ecedit_<?php echo $objEducation->data['Education']['id']; ?>"> <a href="javascript:;" id="empEdit_<?php echo $objEducation->data['Education']['id']; ?>"><i class="icon-pencil"></i>Edit</a></span>
	   	</div>
   	 </div>
    <script>
    	$('#ecedit_<?php echo $objEducation->data['Education']['id']; ?>').click(function(){

    		$.ajax({
    			  url: "<?php echo $this->Form->url('/educations/educationEdit/'.$objEducation->data['Education']['id'])?>",
    			  dataType: 'json',
    			  success: function(ajaxReturn,textStatus,xhr){
    			  	
		 			if(ajaxReturn.boolError){
						$('#educationrow_<?php echo $objEducation->data['Education']['id']; ?>').html(ajaxReturn.content);
						
						$('#divErrorsEmployment').text(ajaxReturn.strErrors);
						$('#divErrorsEmployment').show();
					}else{
						$('#educationrow_<?php echo $objEducation->data['Education']['id']; ?>').html(ajaxReturn.content);
					}		
    			  	
    			  },
    			  beforeSend: function(){
    				  $('#educationrow_<?php echo $objEducation->data['Education']['id']; ?>').html('<?php echo $this->Html->image('loading.gif');?>');  	
    			  }	  
    			});
        })
    
    </script>