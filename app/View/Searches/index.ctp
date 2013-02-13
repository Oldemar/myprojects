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
	  $('fields').show();
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
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="fl">Search results for <u>"<?php echo $word; ?>"</u></div>
					<div class="clr"></div>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
		
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
					<?php 
						if(count($arrGlobalJournals) > 0) { 
					?>
					<div class="eventBox">
						<div class="expandable"><a href="#">
							Global Alpha Journals Entries
						</a>
						</div>
						<div class="fiedls" >
							<?php
								foreach ($arrGlobalJournals as $objJournal){
									echo $this->element('journals/journal_row',array('objJournal'=>$objJournal,'objLoggedUser'=>$objLoggedUser));
								}
							?>
						</div>
					</div>
					<?php 
						}
					 ?>
					<!-- End event Box -->		
					
					<!-- My searched Journals -->
					<?php 
						if(count($arrMyJournals) > 0) { 
					?>
					<div class="eventBox">
						<div class="expandable"><a href="#">
							My Alpha Journals Entries
						</a>
						</div>
						<div class="fiedls" >
							<?php
								foreach ($arrMyJournals as $objJournal){
									echo $this->element('journals/journal_row',array('objJournal'=>$objJournal,'objLoggedUser'=>$objLoggedUser));
								}
							?>
						</div>
					</div>
					<?php 
						}
					 ?>
				</div>																								
				<!-- End rgtCntrleft -->

			</div>
				<!-- Start rgtCntrright -->
				<?php echo $this->element('profile/profile_right_column'); ?>		
				<!-- End right container -->
			<div class="clr"></div>	

			<!-- End content container -->
		</div>

	<!-- End content container -->
	</div>
<!-- End middle container -->		
</div>
