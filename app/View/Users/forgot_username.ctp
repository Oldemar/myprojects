<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					User - Forgot Username
				</div>

			</div>		
		</div>
		<div class="cntrCntr">
			<!-- Start left container -->
			<div id="leftCntr">
				<?php echo $this->element('main_opt_left_column', array('sel'=>'Login')); ?>
			</div>
			<!-- End left container -->
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->
				
				<div class="rgtCntrleft">		
					<div id="alpha_login" >
				<div class="alert  alert-info">
				Please enter your email address and complete the small mathematical calculation below.  We will be happy to send you your email in just a couple seconds.
				</div>
						
					    <?php 
							echo $this->Session->flash('auth');
							echo $this->Form->create('User', array('action' => 'forgot_username')); ?>
						<div class="loginBox">
						    	
						        <div class="loginField">
						        	Email
						        	<?php echo $this->Form->input('email', array(
						        							'type'=>'text',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        
						        <div class="clr"></div>
						     </div>
					     	<div class="loginField">
					     		Calculate this: <?php echo $captcha; ?>
								<?php echo $this->Form->input('captcha', array(
						        							'type'=>'text',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							)); ?>
					        </div>
						     
						</div>
						<?php 
							echo $this->Form->end(__('Send'), array('div'=>false));
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
 
