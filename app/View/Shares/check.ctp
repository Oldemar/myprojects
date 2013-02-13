<?php 
//	echo CakeSession::read('shareduser')." - ".CakeSession::read('sharedemail');
//	echo "<pre>".print_r($share,true)."</pre>";
//	echo "<pre>".print_r($journals,true)."</pre>";
?>
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					Email check
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
							echo $this->Form->create('Share');
						?>
						<div class="loginBox">
						    <div>
						        <div class="loginField">
						        	Type your email below
						        	<?php echo $this->Form->input('email', array(
						        							'type'=>'text',
						        							'div'=> array('class'=>'loginInputBg'),
						        							'label'=>false,
						        							'class'=>'loginInput'
						        							));  
						        	?>
						        </div>
						        <div class="keepMe">
								<?php
									echo $this->Form->input('agreement', array(
											'value' => 'Y',
											'hiddenField' => 'N',
											'type' => 'checkbox',
											'label' => " I have read and agreed to the". $this->Html->link(' Terms & Conditions', array('controller'=>'pages', 'action'=>'display', 'terms')).", and" . $this->Html->link(' Privacy Policy.', array('controller'=>'pages', 'action'=>'display', 'privacy'))  	
									))
								?>
								</div>
						        <div class="clr"></div>
        				    </div>
						</div>
						<?php 
							echo $this->Form->end(__('View'));
					 	 ?> 
		
					</div> 
				</div>
				<!-- Start rgtCntrright -->
				<div class="rgtCntrright">							
					<?php echo $this->element('profile/calendar'); ?>												
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
 
