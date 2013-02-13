<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					User - Login
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
							echo $this->Session->flash();
						?>	
							Your account is not active. Check your email for instruction to activate your account.<br>
							<br>
							<?php echo $this->Html->link('Click here to go back to sign in page',array('controller'=>'users','action'=>'login')); ?>
							
	
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
 
