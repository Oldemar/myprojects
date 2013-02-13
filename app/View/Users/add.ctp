<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">				
		
			<!-- End left container -->			
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div style="width:744px;" class="rgtCntrleft">
					<div class="bluBar_wide">Registration</div>
					
				<div class="regTop">
					<div class="regbluhd">"At the right time and under the right sun, there is a little Alpha in each of us!"</div>
					<div class="regbluhd">Start creating your Alpha World today.</div>
					<div class="reglist">
						<ul>
							<li>Anthropology says that Alpha people are the ones that like to wear the crowns, 
								have the colorful plumage and like to stand out. We on the other hand prefer to say it this way... <a href="#myModal" role="button" data-toggle="modal">read more</a></li>									
						</ul>
						
					    <div style="display: none" class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										    <div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
										    <h3 id="myModalLabel">LivingAlpha</h3>
										    </div>
										    <div class="modal-body">
										    <p class="pmodal">"A person having a LivingAlpha Spirit or Personality is one who exhibits self-assurance, 
										    	physical and emotional strength, self control, independence of thought, 
										    	grit and a laser like focus on achieving one's goals. A person that is LivingAlpha does not fear to try new things and to risk themselves. 
										    	LivingAlpha, however; also means having a caring and long long term view of the world.</p>
				
											<p class="pmodal">	An Alpha is one who encourages and helps others. 
												A true Alpha person is quiet, invisible and always there for friends and family. 
												They do not always shine the light on themselves and often prefer to recognize the achievement of others. 
												Alphas are skilled in building personal connections and they are great team players."</p>
											<p class="pmodal">	This is what we believe is the definition of LivingAlpha.</p>
										    </div>
										    <div class="modal-footer">
										    
										    </div>
					    </div>
				    
				    
				
					</div>
				
				</div>
<!-- End regTop -->


			<!--	<div class="regformtxt"></div> -->
 
			
			<div class="row-fluid">
				<div class="span7">
					<div class="mendatorybox">Please fill the following form marked as  *</div>
					<div class="formBox">
						<?php echo $this->Form->create('User');?>
						
						
						<div class="line">
							<div class="lableTxt">Username: <span class="mendatory">*</span></div>
							<div class="inputFlds"><?php echo $this->Form->input('username', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
							</div>
							<div class="clr"></div>
		
						</div>
						<div class="line">
							<div class="lableTxt">First name: <span class="mendatory">*</span></div>
							<div class="inputFlds"><?php echo $this->Form->input('firstname', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
							</div>
							<div class="clr"></div>
		
						</div>
						<div class="line">
							<div class="lableTxt">Last name: <span class="mendatory">*</span></div>
							<div class="inputFlds"><?php echo $this->Form->input('lastname', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
							</div>
							<div class="clr"></div>
		
						</div>
						
						<div class="line">
							<div class="lableTxt">Gender:  <span class="mendatory">*</span></div>
							<div class="inputFlds"><?php echo $this->Form->input('gender', array('div'=>false,'label'=>false,'options'=>array(
															'0' => 'Not specified',
															'1' => 'Male',
															'2' => 'Female'
														) )); ?>
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
											'minYear' => date('Y') -300,
											'maxYear' => date('Y') -13
								));?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="line">
							<div class="lableTxt">E-mail address: <span class="mendatory">*</span></div>
							<div class="inputFlds">
								<?php echo $this->Form->input('email', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
							</div>
							<div class="clr"></div>
						</div>
		
						<div class="line">
							<div class="lableTxt">Password: <span class="mendatory">*</span></div>
							<div class="inputFlds">
								<?php echo $this->Form->input('password', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="line">
							<div class="lableTxt">Confirm Password: <span class="mendatory">*</span></div>
		
							<div class="inputFlds">
								<?php echo $this->Form->input('password_confirm', array('type'=>'password','div' => false, 'label' => false,'class' =>'inpt'));?>
							</div>
							<div class="clr"></div>
						</div>																																								
		
						<div class="line">
						<div class="lableTxt">Calculate this:<span class="mendatory">*</span></div>
								<?php echo $this->Form->input('captcha', array('label' => $captcha)); ?>
							<div class="clr"></div>
						</div>																																								
						
						<div class="line">
																					
								<div class="termsCondition">
									<?php
										echo $this->Form->input('agreement', array(
												'value' => 'Y',
												'hiddenField' => 'N',
												'type' => 'checkbox',
												'label' => " I have read and agreed to the <a href='javascript:;' id='aTerms'>Terms & Conditions</a>, and <a href='javascript:;' id='aPrivacy'>Privacy Policy</a>"  	
										));
									?>
								</div>
						<?php echo $this->Modal->displayAction('aTerms', array('controller'=>'index','action'=>'termsAjax'));?>
						<?php echo $this->Modal->displayAction('aPrivacy', array('controller'=>'index','action'=>'privacyAjax'));?>
						<div class="inputFlds">
							
						</div>
							
		
						</div>											
						<div class="line">
							<div class="lableTxt">&nbsp;</div>
							<div class="inputFlds"><input type="image" src="<?php echo $this->webroot ; ?>img/cancelform.jpg"/>&nbsp;&nbsp;&nbsp;<input type="image" src="<?php echo $this->webroot ; ?>img/submitform.jpg"/></div>
							<div class="clr"></div>
						</div>											
					</div>
				</div>
				<div class="span1" style="padding-top: 100px;">
				OR
				</div>
				<div class="span4" style="padding-top: 100px;">
				<?php 
					echo $this->Facebook->login(array('img' => 'connectwithfacebook.gif', 'redirect' => array('controller' => 'Users', 'action' => 'facebookSingUp'))); 
				?>
				</div>
				
			</div>
								

					
										
				</div>
				<div style="padding-top: 20px;" class="rgtCntrright">
				
					<p style="color: #33435D;text-align:center;font-size:16px;"><b>Getting Started Videos</b></p>

				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video1');?></span>	
				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video2');?></span>
				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video3');?></span>
				
					<p style="color: #33435D;font-size:16px;font-weight:bold;margin-bottom:15px;margin-top:20px;">Testimonials</p>
					<p style="color: #888;text-align:justify;"><i> I really like the Living Alpha website for capturing and sharing adventures with my family and friends.  The website is easy to navigate; photo uploads are effortless and having the journal capability right there with the photo is great.  I also like being able to get feedback and comments about locations before I arrive, it helps with planning activities and the anticipation of the trip is that much better!" – K. Walker</i></p>
				</div>
																					
			</div>
			
			<div class="clr"></div>	
																							
	</div>

	<!-- End content container -->
</div>




					
				