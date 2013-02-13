<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					User - New Password
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
					    <?php 
							echo $this->Session->flash('auth');
							echo $this->Form->create('User', array('action' => 'new_password/'.$hash)); ?>
						<div class="loginBox">
						    <div>
						    	<div class="alert  alert-info">
						    	<p>Hi <?php echo $objUser->getAttr('firstname'); ?> :</p>
								<p>Please enter your New Password</p>
								</div>
						        <div class="loginField">
						        	New Password
						        	<?php echo $this->Form->input('password', array(
						        							'type'=>'password',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div>
						        <div class="loginField">
						        	New Password Confirmation
						        	<?php echo $this->Form->input('password_confirmation', array(
						        							'type'=>'password',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div>
						        
						        
						        <div class="clr"></div>
						     </div>
						</div>
						<?php 
							echo $this->Form->end(__('Save'), array('div'=>false));
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
 
