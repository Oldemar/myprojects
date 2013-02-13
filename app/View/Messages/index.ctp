<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					Contact Us
				</div>
			</div>		
		</div>
		
		<div class="cntrCntr">
			<!-- Start left container -->
			<div id="leftCntr">
				<?php echo $this->element('main_opt_left_column', array('sel'=>'Contact Us')); ?>
			</div>
			<!-- End left container -->
					<!-- Start right container -->
					<div id="rightCntr">
						<!-- Start beforeloginleft -->
						<div class="beforeloginleft">					
							<!--Start location Box-->

							<div class="locationBox">
								<div class="bluHd">Our Location &amp; Address</div>
								<div class="lft">								
									<div class="blkHd">Alpha Sun &amp; Sport / Living Alpha</div>
									<div class="address">

										<div class="fl">Address:</div>
										<div class="fr">1000 W. McNab Road. Ste # 150 Pompano Beach, Florida, USA 33069</div>
										<div class="clr"></div>
									</div>
						
									<div class="address">
										<div class="fl">E-mail:</div>
										<div class="fr"><a href="mailto:contact@livingalpha.com">contact@livingalpha.com</a></div>
										<div class="clr"></div>
									</div>
									</div>
							
								<div class="rgt">
									<div class="locationMap">										
										<a href="map.html" class="popup1"><img src="<?php echo $this->webroot ; ?>img/map.jpg" alt="" width="230" height="149" /></a>									</div>
								</div>
								<div class="clr"></div>
							</div>
							<!-- End location Box -->

							<!-- start form Box -->
							<div class="formBox contactus">
								<?php if($sent) { ?>
								<div class="alert  alert-success">
									Thank you for contacting LivingAlpha, your message has been delivered.  Someone from our support team will respond to you within two business days.
								</div>
								<?php
								}
								
								?>
								<div class="blkHd">Contact Us</div>	
								<div class="topTxt">Please fill the following contact form.
	</div>
								<div class="menadetoryTxt">Fields marked with ' * ' are mandatory.</div>
								<?php echo $this->Form->create('Message'); ?>
								<div class="line">
									<div class="lableTxt">Name: <span class="mendatory">*</span></div>

									<div class="inputFlds"><?php echo $this->Form->input('name', array('label'=>false, 'class'=>'inpt')); ?>
</div>
									<div class="clr"></div>
								</div>
								<div class="line">
									<div class="lableTxt">Email: <span class="mendatory">*</span></div>
									<div class="inputFlds"><?php echo $this->Form->input('email', array('label'=>false, 'class'=>'inpt')); ?>
</div>
									<div class="clr"></div>
								</div>

								<div class="line">
									<div class="lableTxt">Phone: </div>
									<div class="inputFlds"><?php echo $this->Form->input('phone', array('label'=>false, 'class'=>'inpt')); ?></div>
									<div class="clr"></div>
								</div>
								<div class="line">
									<div class="lableTxt">Message: <span class="mendatory">*</span></div>

									<div class="inputFlds"><?php echo $this->Form->input('description', array('label'=>false, 'class'=>'inpt', 'rows'=>3, 'div'=>false)); ?></div>
									<div class="clr"></div>
								</div>
								
								<div class="line">
									<div class="lableTxt">Calculate this: <span class="mendatory">*</span></div>
									<div class="inputFlds">
										<?php echo $this->Form->input('captcha', array('class'=>'inpt', 'div'=> FALSE, 'label' => 'Calculate this: '.$captcha)); ?>
									</div>
									<div class="clr"></div>

								</div>
								<div class="line">
									<div class="lableTxt">&nbsp;</div>
									<div class="inputFlds">
									</div>
									<div class="clr"></div>
								</div>

								<div class="line">
									<div class="lableTxt">&nbsp;</div>
									<div class="inputFlds">

									<?php
										echo $this->Form->submit('Send Message', array('class'=>'submit'));
										 echo $this->Form->end(); ?>
									</div>
									<div class="clr"></div>
								</div>																																										
							</div>
							<!-- End form Box -->															
						</div>
						<!-- End beforeloginleft -->
					
						<!-- Start rgtCntrright -->
						<div class="rgtCntrright" style="width:200px;">							
								<?php // echo $this->element('testimonial_column'); ?>
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



