<?php
echo $this->Html->css(array('bootstrap.alerts.min'));
?>
<script type="text/javascript">
   function sendTokenToUser(){
	$.ajax({
		   type: "POST",
		   url: "<?php echo $this->Html->url('/users/send_token_to_user/', true ); ?>",
		   data: { },
	   	   dataType: "html"
		 }).done(function( returned ) {
			 $('#divMsg1').html('<div class="alert">A verification code(Token) has been sent to your e-mail. Please insert the 6 digits Token in the field bellow.</div>');
		 })
	}	 	 
   
   $(document).ready(function(){

	   textboxes = $("#UserPassword");

	   if ($.browser.mozilla) {
	      $(textboxes).keypress(checkForEnter);
	   } else {
	      $(textboxes).keydown(checkForEnter);
	   }

	   function checkForEnter(event) {
	      if (event.keyCode == 13) {
	         currentTextboxNumber = textboxes.index(this);

	         if (textboxes[currentTextboxNumber + 1] != null) {
	           nextTextbox = textboxes[currentTextboxNumber + 1];
	           nextTextbox.select();
	      }

	         event.preventDefault();
	         return false;
	      }
	   }
	   
	   $('#btnContinue').click(function(){
		   $(this).text('Please wait');
		   $.ajax({
			   type: "POST",
			   url: "<?php echo $this->Html->url('/users/validatePasswordForLoggedUser/', true ); ?>",
			   data: { password: $('#UserPassword').val() },
		   	   dataType: "json"
			 }).done(function( returned ) {
				 $('#btnContinue').text('Continue');
			   	if(returned.boolCorrectPassword == true){
			   		$('#error').html('');
			   		$('#btnContinue').css('display','none');
			   		$('#divToken').css('display','block');
			   		$('#divNewPassword').css('display','block');
			   		$('#divNewPassword2').css('display','block');
			   		$('#divSubmit').css('display','block');
			   		$('#UserPassword').attr( 'readonly'  , 'true');
			   		
			   		sendTokenToUser();
			   	}else{
				   	$('#error').html('Incorrect password.');
			   	}   	   	
			 });
			 
	   });
   });   
</script>
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt" style="padding-top:11px;">
					Change your password
				</div>
			</div>		
		</div>				
		<div class="cntrCntr2">
			<!-- Start left container -->
		
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image_0'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>

			</div>
			<!-- End left container -->
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->
				
				<div class="rgtCntrleft">	
					<div class="alert">
						<?php echo __('Please enter your current password here and we will send you an email with a temporary Token to assist and facilitate in you changing your password.'); ?><br>
						<?php echo __('Thank you.'); ?>
					</div>	
					<div id="alpha_login" >
					    <?php 
							echo $this->Session->flash();
						?>
						
						<div class="loginBox">
						    <div>
						    	<?php echo $this->Form->create('User', array('action' => 'change_password')); ?>

						    	<br><span id='error' style="color:red" ></span>
						        <div class="loginField">
						        	Current Password
						        	<?php echo $this->Form->input('password', array(
						        							'type'=>'password',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div><br>
						        <div id="btnContinue" style="width: 60px;" class="buttons" <?php if(isset($errorsForm)){echo 'style="display:none"';} ?>>
									<span href="javascript:;"  >Continue</span>
								</div>
						<br><br><br>
						        <div id="divMsg1" >
						        </div>
						        <div class="loginField" id="divToken" <?php if(!isset($errorsForm)){echo 'style="display:none"';} ?>>
						        	Token
						        	<?php echo $this->Form->input('token', array(
						        							'type'=>'text',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput',
						        							'maxlength' => '6'
						        							));  
						        	?>
						        </div>
						        
						         <div class="loginField" id="divNewPassword"  <?php if(!isset($errorsForm)){echo 'style="display:none"';} ?>>
						        	New Password
						        	<?php echo $this->Form->input('new_password', array(
						        							'type'=>'password',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div>
						        <div class="loginField"  id="divNewPassword2" <?php if(!isset($errorsForm)){echo 'style="display:none"';} ?>>
						        	New Password Confirmation
						        	<?php echo $this->Form->input('new_password_confirmation', array(
						        							'type'=>'password',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div>
						        
						        
						        
						        
						        
						        <div class="clr"></div>
						        <div class="submit" id="divSubmit" <?php if(!isset($errorsForm)){echo 'style="display:none"';} ?>><input type="submit" value="Change password"></div>
						     </div>
						</div>
						<?php 
							echo $this->Form->end();
					 	 ?>
					</div> 
				</div>
				
				<!-- Start rgtCntrright -->
				<div class="rgtCntrright">							
					<?php echo $this->element('profile/calendar'); ?>												
					<?php echo $this->element('profile/featured_products'); ?>	
					
					<div class="spacer">&nbsp;</div>																																			
						<?php echo $this->element('adwords'); ?>
					<div class="spacer">&nbsp;</div>							
				</div>
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
			<div class="clr"></div>	
		</div>
	</div>	
	<!-- End content container -->
</div>
<!-- End middle container -->		
