		<!--Start middle Container-->
<script>

var typingTimer;
var doneTypingInterval = 450;

//Detect keystroke and only execute after the user has finish typing
	function delayExecute()
	{
	    clearTimeout(typingTimer);
	        typingTimer = setTimeout(
	        function(){somethingExecuted('typesomethinghere')},
	        doneTypingInterval
	    );
	
	    return true;
	}
	
	function somethingExecuted( theInputName)
	{
		
	   $.ajax({
		   	async:true, 
		   	data:$("#q").serialize(), 
		   	dataType:"html", 
		   	success:function (data, textStatus) {

		   		$("#usrList").html(data);
		   	}, 
		   	error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      	  $('#usrList').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/users/findFriend/')?>"
	   	});
	}
	
	
</script>
		<div id="middleCntr">	
			<!-- Start content container -->
			<div id="contentCntr">
				<div class="headingBg">
					<div class="lt">
						<div class="rt">
							<div class="fl"><?php echo $userFullName; ?></div>
							<div class="addjournalbtn">
								
							</div>
							<div class="clr"></div>
						</div>
					</div>		
				</div>				
				<div class="cntrCntr2">			
				
					<!-- Start of Profile Left bar -->	
						
						<div id="leftCntr">
							<?php echo $this->element('profile/profile_image'); ?>
							<?php echo $this->element('profile/alphaworldmap'); ?>
							<?php echo $this->element('profile/side_navigation'); ?>
							</div>
					
						
					<!-- End of Profile Left bar -->	

					<!-- Start right container -->
					<div id="rightCntr">
						<!-- Start rgtCntrleft -->

						<div class="rgtCntrleft">					
							<!--Start event Box-->
							<div class="eventBox">
							
								<div class="bluBar">Find Friends</div>
									<div class="friendgryBg">
										<div class="friendgryTop">
											<div class="friendgryBottom">
												Please simply start typing the name, username or email of the person you are looking for.<br><br>
												<div class="srchfriend">
												<?php 
													echo $this->Form->input('q', array('label'=>false,
																'type' => 'text',
																'class' => 'srchfld',
																'value' => 'Search Friends',
																'onblur' => "replaceText(this)",
																'onfocus' => "clearText(this)",
																'onkeypress' => "return delayExecute();"
														));
													?>
												</div>

												<div class="clr"></div>
											</div>
										</div>
									</div>
									<div id="usrList" style="margin-left: 20px;" >
									
									</div>							
								</div>
							<!-- End event Box -->																														
						</div>
						<!-- End rgtCntrleft -->
						<!-- Start rgtCntrright -->
							<?php echo $this->element('profile/profile_right_column'); ?>				
						<!-- End right container -->
						<div class="clr"></div>	
					</div>
				</div>																								
			</div>

			<!-- End content container -->
		</div>
		<!-- End middle container -->		


