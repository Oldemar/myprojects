<?php
$objController->loadAditionalJs('bootstrap.javascript.modal');
$objController->loadAditionalCss('bootstrap.javascript.modal');
$objController->loadAditionalCss('bootstrap.miscellaneous.close_icon');
$objController->loadAditionalCss('bootstrap.components.alert');
$objController->loadAditionalCss('users');

?>

	<div class="invitebutton btn btn-primary buttons divinvitefriend">
		<a href="javascript:;" role="button" data-toggle="modal">Invite Friends</a>
	</div>
	
	<div class="invitebutton btn btn-primary buttons divfindfriend">
		<?php echo $this->Html->link('Find Friends', array( 'controller' => 'users', 'action'=> 'findFriends')) ?>
	</div>

	<div class="modal" id="inviteFriendsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				x
			</button>
			<h3 id="myModalLabel">Invite friends</h3>
			<p>Please enter email addresse(s) of the friend(s) you would like to invite.</p>
			<div id="divErrors" class="alert alert-error" style="display:none;"></div>
		</div>
		
				<?php 
				
				echo $this->Form->create('User', array('id'=>'inviteFriend'));
				?>
		<div class="modal-body" id="invitebody">

			<?php echo $this->element('Users/invite_friends_body'); ?>
				
		</div>
		
		<?php echo $this->Form->end(); ?>
		<div class="modal-footer">
			<button class="btn buttons bottomButton" data-dismiss="modal" aria-hidden="true">
				Cancel
			</button>
			<button id="sendemail" class="buttons bottomButton">
				Send email
			</button>
		</div>
	</div>
<script>
	$(".divfindfriend").click(function(){
		window.location = $(this).find('a').attr('href');
	});
	$(".divinvitefriend, .divinvitefriend a").click(function(){
		$("#inviteFriendsModal").modal({show:true});
		$("#inviteFriendsModal").show();
	});
</script>
<script>
	

    $("#sendemail").click(function(){

	var formData = $("#inviteFriend :input").serialize();

	if(validateInput()) {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "<?php echo $this->Form->url('/users/inviteFriends')?>",
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
    	$('.bodymessage').val(null);
    })


</script>