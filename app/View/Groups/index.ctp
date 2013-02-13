

<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
			
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
				<div class="rgtCntrleft">						
					<!--Start event Box-->
					<div class="eventBox">
						<div class="bluBar">Your Groups</div>
						<div class="friendgryBg">
							<div class="friendgryTop">
								<div class="friendYellowbar">
								
								<?php echo $this->CachedElement->groupAutoCompleteInput('Group.name','Group.id', array(
																	'class'=>'popinpt1',
																	'div'=> false,
																	'label'=> false)); 
								?>
								<a href="#" id="searchGroupMembers">Search Group</a>
								</div>
							</div>
						</div>

						<div id="userbygroup">
							

							<div id="lstusrbygrp">
								<div id="resultGroupSearch"  >
									<?php 
										
										if(isset($objGroup)){
											
											echo $this->element('Groups/search_group'); 
										}
										elseif(isset($listGroup)){
											
											echo $this->element('Groups/list_group'); 
										}
									?>
								</div>	
							</div>		
							
						</div>
					</div>							
					<!-- End event Box -->																						
				</div>
				<div class="rgtCntrright"  style="padding-top: 15px;">
					<div class="groupbutton" style="margin-left: 30px;">
						<a class="btn btn-success" href="/groups/add"><i class="icon-plus icon-white"></i>Add a new Group</a>
					</div>
				</div>
				<!-- Start rgtCntrright -->
					<?php echo $this->element('profile/profile_right_column'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<div class="clr"></div>
			<!-- End right container -->

	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->		
<script>

$(document).ready(function() {


	function listMembers( myParam )
	{
		

	   $.ajax({
		   	async:true, 
		   	data:myParam, 
		   	dataType: 'json',
		   	success:function (ajaxReturn, textStatus) {
		   		
		   		$('#GroupName').val('');
		   		
				$("#resultGroupSearch").html(ajaxReturn.content);
		   	}, 
		   	error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      	  $('#employment_list').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/groups/listMembers/')?>"
	   	});
	}
	
	$('#searchGroupMembers').click(function(){
		
					
		if($("#GroupName").attr('value') == ''){
			
			alert('Please, enter the group name to search.');
		}
		else{
			
			myParam = {	groupName:$("#GroupName").attr('value'),
					groupId:$("#GroupId").attr('value'),
					}
			listMembers(myParam);
		}			
					
		
	});



	
});	
</script>