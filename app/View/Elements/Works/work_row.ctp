<?php 

if (!$objWork->data['Work']['perm']) $perm = $this->Html->image('P.jpg');
else $perm = $this->Html->image($cl_i = ($objWork->data['Work']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg'));
	
?>

<?php $str = h($objWork->Specialty->data['Specialty']['name']); ?>
	
<?php $str .= ', '; ?>
<?php $str .=  h($objWork->Workplace->data['Workplace']['name']); ?>

<?php $location = h($objWork->City->getNameToExhibit()); ?>

<?php

	if ($objWork->data['Work']['start_month'] =='00' || $objWork->data['Work']['start_day'] == '00' || $objWork->data['Work']['start_year'] =='0000'){
		
		$startdate = $date = ($objWork->data['Work']['startdate'] == '0000-00-00')?'Date Unknown': $objWork->data['Work']['startdate'];
	}else{
		
		$startdate = ($objWork->data['Work']['startdate'] == '0000-00-00')? 'Date Unknown': CakeTime::format('F jS, Y',$objWork->data['Work']['startdate']); 
	}
	
	if ($objWork->data['Work']['end_month'] =='00' || $objWork->data['Work']['end_day'] == '00' || $objWork->data['Work']['end_year'] =='0000'){
		
		$enddate = $date = ($objWork->data['Work']['enddate'] == '0000-00-00')?'Date Unknown': $objWork->data['Work']['enddate'];
	}else{
		
		$enddate = ($objWork->data['Work']['enddate'] == '0000-00-00')? 'Date Unknown': ($objWork->data['Work']['enddate'] == '9999-99-99')? 'Present': CakeTime::format('F jS, Y',$objWork->data['Work']['enddate']); 
	}

 	$date = h($startdate.' - '.$enddate);
?>

<div class="row-fluid itemrow" id="workrow_<?php echo $objWork->data['Work']['id']; ?>" >
    <div class="span10"><b><?php echo $perm." ".$str; ?></b><br>
   		<span class="below"><?php echo $location; ?></span><br>
   		<?php echo $date; ?>
    </div>
    
   	<div class="span2">
   		<span class="wedit" id="cedit_<?php echo $objWork->data['Work']['id']; ?>"> <a href="javascript:;" id="empEdit_<?php echo $objWork->data['Work']['id']; ?>"><i class="icon-pencil"></i>Edit</a></span>
	   	</div>
   	 </div>
    <script>
    	$('#cedit_<?php echo $objWork->data['Work']['id']; ?>').click(function(){

    		$.ajax({
    			  url: "<?php echo $this->Form->url('/works/workEdit/'.$objWork->data['Work']['id'])?>",
    			  dataType: 'json',
    			  success: function(ajaxReturn,textStatus,xhr){

		 			if(ajaxReturn.boolError){
						$('#workrow_<?php echo $objWork->data['Work']['id']; ?>').html(ajaxReturn.content);
						
						$('#divErrorsEmployment').text(ajaxReturn.strErrors);
						$('#divErrorsEmployment').show();
					}else{
						$('#workrow_<?php echo $objWork->data['Work']['id']; ?>').html(ajaxReturn.content);
						//$('#myTab a[href="#employment_list"]').tab('show');
						//$('#divErrorsEmployment').hide();
					}		
   			  },
    			  beforeSend: function(){
    				  $('#workrow_<?php echo $objWork->data['Work']['id']; ?>').html('<?php echo $this->Html->image('loading.gif');?>');  	
    			  }	  
    			});
        });

    </script>