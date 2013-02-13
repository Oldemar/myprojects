<?php 

echo $this->Form->create('Education');
echo $this->Form->hidden('id');
echo $this->Form->hidden('Education.user_id');


?>
<div id="divErrorsEducation" class="alert alert-error" style="display:none;"></div>

<div class="row-fluid smallMarginRow">
	<div class="span4">
		<span class="employmentrow"> Sharing Level<br>
		</span>
		<?php 
		echo ' '.$this->Form->radio('Education.perm',
				array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')),
				array('legend' => false,'value'=>$obj->getAttr('perm'), 'id'=>'employmentperm', 'class'=>'classemploymentperm'));
		?>
	</div>
</div>
<div class="row-fluid employmentrow  smallMarginRow">
	<div class="span5">
		Education Level
		<?php 
		echo $this->CachedElement->edulevelAutoCompleteInput('Edulevel.name','Education.edulevel_id',array(
				'id'=>'eduleveldit',
				'class'=>'popinpt2',
				'div'=> false,
				'label'=> false,
				'value'=> $obj->Edulevel->getAttr('name'),
				'placeholder' => 'e.g. Bachelor',
		));

		?>
	</div>
	<div class="span5 offset1">
		Institute<br>
		<?php 
		echo $this->CachedElement->instituteAutoCompleteInput('Institute.name','Education.institute_id',array(
				'id'=>'instituteedit',
				'class'=>'popinpt2',
				'div'=> false,
				'label'=> false,
				'value'=> $obj->Institute->getAttr('name'),
				'placeholder' => 'e.g. College',
		));
		?>
	</div>
</div>

<div class="row-fluid employmentrow smallMarginRow">
	<div class="span7">
		<?php 

		echo __('City, Region, Country').$this->CachedElement->cityAutoCompleteInput('Education.location','Education.city_id',array(
				'class'=>'popinpt1',
				'div'=> false,
				'label'=> false,
				'id'=>'city0201',
				'placeholder' => 'e.g. Miami, Fl, USA',
				'value'=>$obj->City->getNameToExhibit()

		));

		?>
	</div>
</div>

<div class="row-fluid employmentrow smallMarginRow">
	<div class="span6">
		<?php 
		echo $this->Form->input('Education.startdate', array(
				'label'			=> 'Start Date',
				'type' 			=> 'date',
				'minYear'		=> date('Y') -300,
				'maxYear'		=> date('Y'),
    			'empty'			=> '--'
		));
		?>
	</div>
	<div class="span6">
		<?php 

		echo $this->Form->input('Education.enddate', array(
				'label'			=> 'End Date',
				'type' 			=> 'date',
				'minYear'		=> date('Y') -300,
				'maxYear'		=> date('Y'),
    			'empty'			=> '--'
		));

		$date_checked = ($obj->getAttr('enddate') == '9999-99-99');
		
		echo $this->Form->checkbox('Education.current', array('id'=>'current'.$educationId,'checked'=>$date_checked)).' '.__('I\'m currently studying here.');
		
		?>
	</div>
</div>




<div class="row-fluid employmentrow smallMarginRow">
	<div class="span5">
		<?php 
		echo $this->Form->input('Education.description', array('class'=>'popinpt3', 'rows'=>3));
		?>
	</div>
</div>


<?php 
echo $this->Form->button('Save', array('type'=>'button','id'=>'esaveButton'.$educationId, 'class' => 'buttons'));

echo $this->Form->end();
?>

<script>

    $("#esaveButton<?php echo $educationId; ?>").click(function(){

	var formData = $("#EducationEducationEditForm :input").serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "<?php echo $this->Form->url('/educations/educationEdit/'.$educationId)?>",
        data: formData,
        success: function(ajaxReturn,textStatus,xhr){
        	
        	
 			if(ajaxReturn.boolError){
				
				<?php if($educationId){?>
					
					$('#educationrow_<?php echo $educationId; ?>').html(ajaxReturn.content);
					
				<?php }else{?>
					
					$('#add_new_education').html(ajaxReturn.content);

				<?php }?>
				
				$('#divErrorsEducation').html(ajaxReturn.strErrors);
				$('#divErrorsEducation').show();
				
					
			}else{

				<?php if($educationId > 0){?>
					$('#educationrow_<?php echo $educationId; ?>').html(ajaxReturn.content);
					$('#divErrorsEducation').hide();
				<?php }else{?>
					$('#education_list').html(ajaxReturn.content);
					$('#myTab2 a[href="#education_list"]').tab('show');
					$('#divErrorsEducation').hide();
				<?php }?>
			}		
       	
        },
        error: function(xhr,textStatus,error){

                alert('The server can not be reached in this moment. Please, try later.');
        },
        beforeSend: function(){
        	<?php if($educationId){?>
				$('#educationrow_<?php echo $educationId; ?>').html('<?php echo $this->Html->image('loading.gif');?>');
			<?php }else{?>
				$('#add_new_education').html('<?php echo $this->Html->image('loading.gif');?>');
				$('#myTab2 a[href="#add_new_education"]').tab('show');
				
			<?php }?>  	
	    }
    }); 
	
	
});



<?php 

    if($date_checked){
    ?>
    $("#educationrow_<?php echo $educationId; ?> #EducationEnddateMonth,#EducationEnddateDay,#EducationEnddateYear").attr("disabled", "disabled");
    <?php 
    }
    ?>

    $( '#current<?php echo $educationId; ?>' ).change(function(){

    	if( $( this ).attr('checked') ){
    		$(this).parent().find("#EducationEnddateMonth,#EducationEnddateDay,#EducationEnddateYear").attr("disabled", "disabled");
    	}
    	else{
    		$(this).parent().find("#EducationEnddateMonth,#EducationEnddateDay,#EducationEnddateYear").removeAttr("disabled");
    	}
        });

    	

</script>
