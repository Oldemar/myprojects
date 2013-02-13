<?php
$objController->loadAditionalJs('bootstrap.javascript.modal');
$objController->loadAditionalCss('bootstrap.javascript.modal');
$objController->loadAditionalCss('bootstrap.miscellaneous.close_icon');
$objController->loadAditionalCss('bootstrap.components.alert');
$objController->loadAditionalCss('users');

?>

	<div style="margin-top:15px;margin-left:35px;">
	<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> Add New Journal Entry', array('controller'=>'journals','action'=>'editnew'),array('class' => 'btn btn-success','escape'=>false) );?><br><br>
	<a href="#myModal" role="button" class="btn btn-primary buttons" data-toggle="modal">Share this Journal</a>
	</div>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				x
			</button>
			<h3 id="myModalLabel">Share this Journal</h3>
			<div id="divErrors" class="alert alert-error" style="display:none;"></div>
		</div>
		
				<?php 
				
				echo $this->Form->create('User', array('id'=>'sharingJournal'));
				echo $this->Form->hidden( 'journalId', array( 'value' => $journalId ) );
				
				?>
		<div class="modal-body" id="invitebody">

				
				<?php echo $this->element('Users/share_journal_body'); ?>
				

				
		</div>
		
		<?php echo $this->Form->end(); ?>
		<div class="modal-footer">
			<button class="btn buttons btn-primary bottomButton" data-dismiss="modal" aria-hidden="true">
				Cancel
			</button>
			<button id="sendemail" class="buttons btn-primary bottomButton">
				Send email
			</button>
		</div>
	</div>

<script>
	

    $("#sendemail").click(function(){

	var formData = $("#sharingJournal :input").serialize();
	
	if(validateInput()) {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "<?php echo $this->Form->url('/users/shareJournal')?>",
        data: formData,
        success: function(ajaxReturn,textStatus,xhr){
        	
        	$('.bottomButton').show();
        	
 			if(ajaxReturn.boolError){
				
				
				$('#invitebody').html(ajaxReturn.content);
				
				$('#divErrors').html(ajaxReturn.strErrors);
				$('#divErrors').show();
				
					
			}else{
				$('#invitebody').html(ajaxReturn.content);
				$('#divErrors').hide();
				
				$('#myModal').modal('hide')
			}		
       	
        },
        error: function(xhr,textStatus,error){

                alert('The server can not be reached in this moment. Please, try later.');
                $('#myModal').modal('hide')
        },
        beforeSend: function(){
        	
        	$('.bottomButton').hide();

			$('#invitebody').html('<?php echo $this->Html->image('loading.gif');?>');
				
				
	    }
    }); 
	
	}
	
	});
	
	function validateInput(){
		
		var validationAmount = 0;
		
		$('.bodymessage').each(function(index, value){
			
		    if ($.trim($(value).val()).length == 0){
	            
				++validationAmount;
	        }
		});
		
		
		if($('.bodymessage').size() == validationAmount){
			
	        	
	        	$('#divErrors').html('You must provide a valid email address.');
				$('#divErrors').show();
				
				return false;
	    }
	    else{
	    	$('#divErrors').hide();
	    	return true;
	    }

	}

    $('#myModal').on('hidden', function () {
    	$('#divErrors').hide();
    	$('#UserViewForm [name*="emailaddress"]').val(null);
    })


</script>