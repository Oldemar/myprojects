<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<?php echo $userFullName ?>
				</div>

			</div>		
		</div>
		<div class="cntrCntr">
			<!-- Start left container -->
			<div id="leftCntr">
				<?php echo $this->element('main_opt_left_column',array('sel'=>'Sign Up')); ?>
			</div>
			<!-- End left container -->
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start beforeloginleft -->
				<div class="beforeloginleft">					
					<div class="regform">
						<div class="topPart">

							<div class="bottomPart">
								<div class="strachbar">
									<div class="ltside">
										<div class="rtside">Related User Registration</div>
									</div>
								</div>
								<!--	<div class="regformtxt"></div> -->

								<div class="mendatorybox">Please fill the following form marked as  *</div>	
								<!-- start form Box -->
								<div class="formBox">
									<?php 
										echo $this->Form->create('User');
										echo $this->Form->input('tutor_id', array(
															'type'=>'hidden',
															'value'=>AuthComponent::user('id')
										));
										echo $this->Form->input('email', array(
															'type'=>'hidden',
															'value'=>AuthComponent::user('email')
										));
										?>
									<div class="line">
										<div class="lableTxt">Username: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php 
												echo $this->Form->input('username', array(
															'div' => false, 
															'label' => false,
															'class' =>'inptSml'
												)); 
											?>
										</div>
										<div class="clr"></div>

									</div>
									<div class="line">
										<div class="lableTxt">First and Last Name: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php
												echo $this->Form->input('firstname', array(
														'div' => false, 
														'label' => false,
														'class' =>'inptSml'
												));
												echo " ".$this->Form->input('lastname', array(
														'div' => false, 
														'label' => false,
														'class' =>'inptSml'
												)); ?>
										</div>
										<div class="clr"></div>

									</div>
									<div class="line">
										<div class="lableTxt">Gender: <span class="mendatory">*</span></div>
										<div class="inputFlds">
										<?php 
											echo $this->Form->input('gender', array(
															'div'=>false,
															'label'=>false,
															'options'=>array(
																'0' => 'Not specified',
																'1' => 'Male',
																'2' => 'Female'
											))); 
										?>
										</div>
										<div class="clr"></div>

									</div>										
									<div class="line">
										<div class="lableTxt">Birthday: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php 
												echo $this->Form->input('dob', array(
														'div'=>false,
														'label'=>false,
														'minYear' => date('Y') -300
											));?>
										</div>
										<div class="clr"></div>
									</div>

									<div class="line">
										<div class="lableTxt">Password: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php 
												echo $this->Form->input('mainpassword', array(
																	'type'=>'password',
																	'div' => false, 
																	'label' => false,
																	'class' =>'inpt'
												)); 
											?>
										</div>
										<div class="clr"></div>
									</div>

									<div class="line">
																								
											<div class="termsCondition">
												<?php
													echo $this->Form->input('agreement', array(
															'value' => 'Y',
															'hiddenField' => 'N',
															'type' => 'checkbox',
															'label' => " I have read and agreed to the". $this->Html->link(' Terms & Conditions', array('controller'=>'index', 'action'=>'terms')).", and" . $this->Html->link(' Privacy Policy.', array('controller'=>'index', 'action'=>'privacy'))  	
													))
												?>
											</div>
									
									<div class="inputFlds">
										<?php echo $this->Recaptcha->display(); ?>
									</div>
										

									</div>											
									<div class="line">
										<div class="lableTxt">&nbsp;</div>
										<div class="inputFlds"><input type="image" src="<?php echo $this->webroot ; ?>img/submitform.jpg"/> &nbsp;&nbsp;&nbsp;<input type="image" src="<?php echo $this->webroot ; ?>img/cancelform.jpg"/></div>
										<div class="clr"></div>
									</div>											
									<?php //echo $this->Form->end(__('Submit'));?>
								</div>
								<!-- End form Box -->
							</div>

						</div>
					</div>														
				</div>
				<!-- End beforeloginleft -->
				<!-- Start rgtCntrright -->
						<?php echo $this->element('profile/profile_right_column'); ?>
		</div>																								
	</div>
	<!-- End content container -->
</div>

	<!-- End middle container -->		
 
