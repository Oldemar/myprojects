<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">				
		
			<!-- End left container -->			
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div style="width:744px;" class="rgtCntrleft">
					<div class="bluBar_wide">Sign In</div>
				
			
					<div class="row-fluid">
						<div class="span7" style="padding:20px">
							
							    <?php 
									echo $this->Session->flash();
									echo $this->Form->create('User', array('action' => 'login')); ?>
								
								        	<label><b>Username or Email</b></label>
								        	<?php echo $this->Form->input('username', array(
								        							'type'=>'text',
								        							'div'=> array('class'=>'loginInputBg'),
								        							'label'=>false,
								        							'class'=>'loginInput'
								        							));  
								        	?>
								        <label><b>Password</b></label>
								        	<?php echo $this->Form->input('password', array(
								        							'div'=> array('class'=>'loginInputBg'),
								        							'label'=>false,
								        							'class'=>'loginInput'
								        	)); 
								        	?>
								        
								        <div class="keepMe"><input name="" type="checkbox" value="" class="check" /> Keep me logged in</div><br clear="all">
								        
								        
								        <input type="submit" value="Sign In" class="btn btn-primary pull-right" style="float:right;margin-right: 110px;">
								        
								        
							 	 		<br clear="all"><br clear="all">
								        <?php echo $this->Html->link('Forgot your username?',array('action'=>'forgot_username','controller'=>'users')); ?> <span style="padding-left:5px;"> <?php echo $this->Html->link('Forgot your password?',array('action'=>'forgot_password','controller'=>'users')); ?></span>
								        
								
									
		
			
							
						</div>
						<div class="span1" style="padding-top: 80px;">
						OR
						</div>
						<div class="span4" style="padding-top: 80px;">
						<?php 
							echo $this->Facebook->login(array('img' => 'connectwithfacebook.gif', 'redirect' => array('controller' => 'Users', 'action' => 'facebookSingUp'))); 
						?>
						</div>
						
					</div>
					<div class="row-fluid" style="width:700px;padding:20px">
					
						<div id="alertIE"></div>
						<script>
							if ($.browser.msie) {
								$('#alertIE').html("<div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" style=\"float:right\">x</button><strong>Warning!</strong> You may experience a few minor issues when viewing LivingAlpha using Internet Explorer.  For optimum results, we recommend using Chrome or Mozilla-Firefox.<br>Thank you for your understanding.</div></div");
								$('.close').click(function(){
									$('#alertIE').css('display','none');
								});
							}
						</script>
										
					</div>										
				</div>
			</div>
			<div style="padding-top: 20px;" class="rgtCntrright">	
				<p style="color: #33435D;text-align:center;font-size:16px;"><b>Getting Started Videos</b></p>

				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video1');?></span>	
				
				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video2');?></span>
					
				
					<span style="margin-top:20px;display:block;"><?php echo $this->element('GettingStartedVideos/video3');?></span>
					
				
				
					<p style="color: #33435D;font-size:16px;font-weight:bold;margin-bottom:15px">Testimonials</p>
					<p style="color: #888;text-align:justify;"><i> I really like the Living Alpha website for capturing and sharing adventures with my family and friends.  The website is easy to navigate; photo uploads are effortless and having the journal capability right there with the photo is great.  I also like being able to get feedback and comments about locations before I arrive, it helps with planning activities and the anticipation of the trip is that much better!" – K. Walker</i></p>
			</div>
																					
			
			
			<div class="clr"></div>	
																							
	</div>

	<!-- End content container -->
</div>




					
				
