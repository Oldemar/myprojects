<?php
//	echo "<pre>Dummy Ass<br>".print_r($journals,true)."</pre>" ; 
?>
<script language="JavaScript">
	//var cal1x = new CalendarPopup("testdiv1");
</script>

<!--Start middle Container-->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">				
		<div class="">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>
			</div>
				
			<!-- End left container -->			
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div class="rgtCntrleft" style="padding-top: 15px;">
					<div class="bluBar"><?php if(isset($this->request->data['Journal']['title']) && strlen($this->request->data['Journal']['title']) > 0){echo $this->request->data['Journal']['title'];}else{?>Add New Journal Entry<?php }?></div>
							
					<div class="midTop">
					    <div class="eventBox">
							<?php echo $this->Form->create('Journal', array('type' => 'file'));?>
							<div id="alphaDiv">
								<!--Start popform -->
								<?php if(count($relateduserlist) > 1){?>
								<div class="popformLine">
									<div class="poplabel">Related user <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
											echo $this->Form->input('userid', array(
													'label'=>false,
													'class'=>'popselect',
													'value'=>$userid,
													'options' => $relateduserlist));

										?>
									</div>
									<div class="clr"></div>
								</div>
								<?php } ?>
								<div class="popformLine">
									<div class="poplabel">Date <span class="mendatorytxt">*</span></div>
									<div class="popcalndFld">
										<?php
											echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => Authcomponent::user('id')));
											echo $this->Form->input('id', array('type' => 'hidden', 'value' => null));

										echo $this->Form->input('date_event', array(
												'dateFormat'	=> 'Y-m-d',
												'type' 			=> 'text',
												'id'			=> 'datepicker',
												'label'			=> false,
												'class'			=> 'popinptdate',
												'minYear'		=> date('Y') -300,
												'maxYear'		=> date('Y') -13

											//	'onclick'		=> "cal1x.select(document.forms[0].anchor1x, 'anchor1x', 'MM/dd/yyyy'); return false;"
											));
	
															
?>

										<!--  <div id="testdiv1"></div>-->
									</div>								
									<div class="clr"></div>
	
								</div>
								<div class="popformLine">
									<div class="poplabel">Title <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php echo $this->Form->input('title', array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false 
																)); 
										?>
									</div>
									<div class="clr"></div>
	
								</div>
									<div class="popformLine">
										<div class="poplabel">Activity Type <span class="mendatorytxt">*</span></div>
										<div class="popfilds">
											<?php echo $this->CachedElement->activityAutoCompleteInput('Area.name','Area.id', array(
																	'class'=>'popinpt1',
																	'div'=> false,
																	'label'=> false)); 
											?>
										</div>
										
										<div class="clr"></div>
		
									</div>
									<div class="clr"></div>
	
								</div>
								<div class="popformLine">
									<div class="poplabel">City <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
										echo $this->CachedElement->cityAutoCompleteInput('city_name','city_id',array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false
																));
										?>
										<?php /**if ( (!isset($cities[$journals['Journal']['city_id']])) || $cities[$journals['Journal']['city_id']] == null ) {
											$wcity =  "";
										} else {
											$wcity = $cities[$journals['Journal']['city_id']]  ;
										}
										echo $this->Form->input('cityid', array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false,
																'value'=>$wcity,
																'id'=>'cities'
																));**/ 
										 ?>
									</div>
										<script>
											$(function() {
												var cities = [
												<?php
													//echo $crc;
 												?>
												];
												$( "#cities" ).autocomplete({
													source: cities,
													minLength: 2
												});
											});
										</script>
									<div class="clr"></div>
								</div>
								<div class="popformLine">
									<div class="poplabel">Place / Venue <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php echo $this->Form->input('location', array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false,
																'placeholder'=>'' 
																)); 
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="popformLine">
									<div class="poplabel">Cost Incurred </div>
									<div class="popfilds">
										<?php 
											echo $this->Form->input('cost', array(
																'class'=>'popinpt',
																'div'=> false,
																'label'=> false 
																)); 
											 echo $this->Form->input('currency_id', array(
											 					'default'=> '151',
																'class'=>'popslct',
																'div'=> false,
																'label'=> false 
																)); 
										?>
	
									</div>
									<div class="clr"></div>
								</div>
								<div class="popformLine">
									<div class="poplabel">Climatic Conditions</div>
									<div class="popfilds">
										<?php 
											echo $this->Form->textarea('climatic_conditions', array(
																'rows'=>'6',
																'cols'=>'20',
																'class'=>'popmessage',
																'div'=> false,
																'label'=> false 
																)); 
										?>
									</div>
	
								<div class="clr"></div>	
							</div>
							<?php echo '<button type="submit" class="btn btn-primary btn-large" style="float:right">Save and Continue to Sharing Levels <i class=\'icon-chevron-right icon-white\'></i></button>'; ?>
						</div>
						</div>
										
				</div>
				
				<!-- End rgtCntrleft -->
				
				<!-- Start rgtCntrright -->
					<?php echo $this->element('journals/add_journal_rightbar_0'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
			<div class="clr"></div>	
		</div>																								
	</div>

	<!-- End content container -->
</div>
<!-- End middle container -->	

	<script>
		$(function() {
			$( "#datepicker" ).datepicker({ maxDate: " +0D", changeYear: true, changeMonth:true, yearRange: "-300:+0"});


		});
		
	</script>	
