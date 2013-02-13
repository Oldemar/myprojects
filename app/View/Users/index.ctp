<script type="text/javascript">

ddaccordion.init({
 headerclass: "expandable", //Shared CSS class name of headers group that are expandable
 contentclass: "fiedls", //Shared CSS class name of contents group
 revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
 collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
 defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
 animatedefault: false, //Should contents open by default be animated into view?
 persiststate: true, //persist state of opened contents within browser session?
 toggleclass: ["selected", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
 togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
 animatespeed: "fast", //speed of animation: "fast", "normal", or "slow"
 oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
  //do nothing
 },
 onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
  //do nothing
 }
})


</script>
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
					<!--Start profileform -->
					<div>

						<div class="eventBox">
							<div class="expandable">
								<a href="javascript:;">My Personal Profile Information </a>
							</div>
						</div>
						
						<!-- USER PROFILE -->
						<div class="fiedls education">
							<ul id="myTab3" class="nav nav-tabs">
								<li class="active"><a href="#profile_list" data-toggle="tab"
									id="#profile_list_link">View My Personal Information</a></li>
								<li><a href="#add_new_profile" data-toggle="tab"
									id="add_new_profile_link">Edit My Personal Information</a></li>
							</ul>
							<div class="tab-content" style="overflow: visible;">
								<div class="tab-pane active" id="profile_list">
									<?php
									echo $this->element('Users/profile_view', array('objUser'=>$objUser));
									?>
								</div>
								<div class="tab-pane" id="add_new_profile"></div>

							</div>

						</div>
						<!-- END USER PROFILE -->
						<div class="eventBox">
							<div class="expandable">
								<a href="javascript:;">My Education Background</a>
							</div>
						</div>
						<!-- Education  -->

						<div class="fiedls education">
							<ul id="myTab2" class="nav nav-tabs">
								<li class="active"><a href="#education_list" data-toggle="tab"
									id="#education_list_link">Education Background</a></li>
								<li><a href="#add_new_education" data-toggle="tab"
									id="add_new_education_link">Add New Education</a></li>
							</ul>
							<div class="tab-content" style="overflow: visible;">
								<div class="tab-pane active" id="education_list">
									<?php
									
									if(count($arrObjEducation) > 0){
										foreach($arrObjEducation as $key => $value){
											echo $this->element('Educations/education_row', array('objEducation'=>$value));
										}
									}
									else{
										echo '<div class="alert">';
										echo '<strong>'. __('No autobiography would be complete without this, so go ahead and list all the schools you attended since kindergarten.').'</strong>';
										echo '</div>';
									}
																		
									?>
								</div>
								<div class="tab-pane" id="add_new_education"></div>

							</div>
							<div id="educationListView">


								<div id="addEducationDiv"></div>

							</div>
						</div>
						<!-- END Education  -->

						<div class="eventBox">
							<div class="expandable">
								<a href="javascript:;">My Employment History</a>
							</div>
						</div>
						<div class="fiedls employment">
							<ul id="myTab" class="nav nav-tabs">
								<li class="active"><a href="#employment_list" data-toggle="tab"
									id="#employment_list_link">Employment History</a></li>
								<li><a href="#add_new_employment" data-toggle="tab"
									id="add_new_employment_link">Add New Employment</a></li>
							</ul>
							<div class="tab-content" style="overflow: visible;">
								<div class="tab-pane active" id="employment_list">
									<?php
									
									if(count($arrObjWork) > 0){
										foreach($arrObjWork as $key => $value){
										echo $this->element('Works/work_row', array('objWork'=>$value));
										}
									}
									else{
										
										echo '<div class="alert">';
										echo '<strong>'. __('No autobiography would be complete without this, so go ahead and list all the jobs you\'ve had since your first newspaper run or babysitting job.').'</strong>';
										echo '</div>';
									}
									
									?>
								</div>
								<div class="tab-pane" id="add_new_employment"></div>

							</div>
							<div id="employmentListView">


								<div id="addEmploymentDiv"></div>

							</div>
						</div>
					</div>



<script>

		//This load the Edit Profile
		$('#add_new_profile_link').click(function(){
			$.ajax({
				  url: "<?php echo $this->Form->url('/users/profileEdit/')?>",
				  dataType: "json",
				  success: function(retorno) {
					  $('#add_new_profile').html(retorno.content);
				  },
				  beforeSend: function(){
					  $('#add_new_profile').html('<?php echo $this->Html->image('loading.gif');?>');  	
				  }	  
				});
		})

		//This load the Add New Education
		$('#add_new_education_link').click(function(){
			$.ajax({
				  url: "<?php echo $this->Form->url('/educations/educationEdit/')?>",
				  dataType: 'json',
				  success: function(ajaxReturn,textStatus,xhr) {
				  	
					  $('#add_new_education').html(ajaxReturn.content);
				  },
				  beforeSend: function(){
					  $('#add_new_education').html('<?php echo $this->Html->image('loading.gif');?>');  	
				  }	  
				});
		})
		
		
		//This load the Add  New Employment
    	$('#add_new_employment_link').click(function(){
    		$.ajax({
    			  url: "<?php echo $this->Form->url('/works/workEdit/')?>",
    			  dataType: 'json',
    			  success: function(ajaxReturn,textStatus,xhr) {
    			  	
    			  	$('#add_new_employment').html(ajaxReturn.content);

    			  },
    			  beforeSend: function(){
    				  $('#add_new_employment').html('<?php echo $this->Html->image('loading.gif');?>');  	
    			  }	  
    			});
        })
    
</script>
					<div class="clr"></div>
				</div>
							<!--End profileform -->
			<?php echo $this->element('profile/profile_right_column_2'); ?>
			
			
			</div>

		</div>

	</div>

</div>
<!-- End content container -->
</div>
<!-- End middle container -->



