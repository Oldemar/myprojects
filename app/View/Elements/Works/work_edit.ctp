<?php 

	echo $this->Form->create('Work');
	echo $this->Form->hidden('id');
	echo $this->Form->hidden('Work.user_id');
	
?>
<div id="divErrorsEmployment" class="alert alert-error" style="display:none;"></div>

    <div class="row-fluid smallMarginRow">
    	<div class="span4">
    		<span class="employmentrow">
	    	Sharing Level<br>
	    	</span>
		    <?php
		    echo $this->Form->radio('perm',
		    		array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')),
		    		array('legend' => false,'value'=>$obj->getAttr('perm'), 'id'=>'employmentperm', 'class'=>'classemploymentperm'));
					
		    ?>
    	</div>
    </div>
    
    <div class="row-fluid employmentrow smallMarginRow">
	    <div class="span5">
	    	Position/Speciality
		    <?php
		    echo $this->SpecialtyCachedElement->specialtyAutoCompleteInput('Specialty.name','Work.specialty_id',array(
		    		'id'=>'specialtyedit',
		    		'class'=>'popinpt2',
		    		'div'=> false,
		    		'label'=> false,
		    		'placeholder' => 'e.g. Systems Analyst',
		    		'value'=> $obj->Specialty->getAttr('name')
		    ));    
		    
		    ?>
	    </div>
	    
	    <div class="span5 offset1">
	    	Workplace
		    <?php 
		    echo $this->WorkplaceCachedElement->workplaceAutoCompleteInput('Workplace.name','Work.workplace_id',array(
		    		'id'=>'workplaceedit',
		    		'class'=>'popinpt2',
		    		'div'=> false,
		    		'label'=> false,
		    		'placeholder' => 'e.g. Microsoft',
		    		'value'=> $obj->Workplace->getAttr('name')
		    ));    
		        ?>
	    </div>
    </div>
    
    <div class="row-fluid employmentrow smallMarginRow">
    <div class="span7"><?php 
    
    echo __('City, Region, Country').'<br>' .$this->CachedElement->cityAutoCompleteInput('Workplace.location','Work.city_id',array(
    		'class'=>'popinpt2 input-xlarge',
    		'div'=> false,
    		'label'=> false,
    		'id'=>'lkfdjagfghl',
    		'placeholder' => 'e.g. Miami, Fl, USA',
    		'value'=>$obj->City->getNameToExhibit()	
    ));
    ?>
    </div>
    </div>

    <div class="row-fluid employmentrow smallMarginRow">
    <div class="span6"><?php 
   	echo $this->Form->input('Work.startdate', array(
   			'label'			=> 'Start Date',
    		'type' 			=> 'date',
    		'minYear'		=> date('Y') -300,
    		'maxYear'		=> date('Y'),
    		'empty'			=> '--'
    ));
        ?>
    </div>
    <div class="span6"><?php 
    
    echo $this->Form->input('Work.enddate', array(
    		'label'			=> 'End Date',
    		'type' 			=> 'date',
    		'minYear'		=> date('Y') -300,
    		'maxYear'		=> date('Y'),
    		'empty'			=> '--'
    ));
        
    $date_checked = ($obj->getAttr('enddate') == '9999-99-99');

    echo $this->Form->checkbox('Work.current', array('id'=>'current'.$workId,'checked'=>$date_checked)).' '.__('I\'m currently working here.');
         ?>
    </div>
    </div>
    
    
    
    
    <div class="row-fluid employmentrow smallMarginRow">
    <div class="span11"><?php 
    echo $this->Form->input('Work.description', array('class'=>'popinpt100', 'rows'=>3));    
    ?>
    </div>
    </div>
    
    
    <?php 
		echo $this->Form->button('Save', array('type'=>'button','id'=>'saveButton', 'class' => 'buttons'));
		
        echo $this->Form->end();
    ?>

<script>


$("#saveButton").click(function(){

	var formData = $("#WorkWorkEditForm :input").serialize();

		
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "<?php echo $this->Form->url('/works/workEdit/'.$workId)?>",
        data: formData,
        success: function(ajaxReturn,textStatus,xhr){
        	
			if(ajaxReturn.boolError){
				
				<?php if($workId){?>
					
					$('#workrow_<?php echo $workId; ?>').html(ajaxReturn.content);
					
				<?php }else{?>
					
					$('#add_new_employment').html(ajaxReturn.content);

				<?php }?>
				
				$('#divErrorsEmployment').html(ajaxReturn.strErrors);
				$('#divErrorsEmployment').show();
				
					
			}else{

				<?php if($workId){?>
					$('#workrow_<?php echo $workId; ?>').html(ajaxReturn.content);
					$('#divErrorsEmployment').hide();
				<?php }else{?>
					$('#employment_list').html(ajaxReturn.content);
					$('#myTab a[href="#employment_list"]').tab('show');
					$('#divErrorsEmployment').hide();
				<?php }?>
			}		
   
        },
        error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        },
        beforeSend: function(){

        	<?php if($workId){?>
				$('#workrow_<?php echo $workId; ?>').html('<?php echo $this->Html->image('loading.gif');?>');
			<?php }else{?>
				$('#add_new_employment').html('<?php echo $this->Html->image('loading.gif');?>');
				$('#myTab a[href="#add_new_employment"]').tab('show');
			<?php }?>  	
        	

	    }
    }); 
	
	
});

<?php 

if($date_checked){
?>
$("#workrow_<?php echo $workId; ?> #WorkEnddateMonth,#WorkEnddateDay,#WorkEnddateYear").attr("disabled", "disabled");
<?php 
}
?>

$( '#current<?php echo $workId; ?>' ).change(function(){
	
	if( $( this ).attr('checked') ){
		$(this).parent().find("#WorkEnddateMonth,#WorkEnddateDay,#WorkEnddateYear").attr("disabled", "disabled");
	}
	else{
		$(this).parent().find("#WorkEnddateMonth,#WorkEnddateDay,#WorkEnddateYear").removeAttr("disabled");
	}
});

	

</script>    
