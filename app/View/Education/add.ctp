<?php
	//echo "<pre>Dummy Ass<br>".print_r($edulevellist,true)."</pre>" ; 
	
?>
<script language="JavaScript" id="jscal1x">
	var cal1x = new CalendarPopup("testdiv1");
</script>

<!--Start middle Container-->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="angelina">New Alpha Journal</div>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php //echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>
			</div>
				
			<!-- End left container -->			
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div class="rgtCntrleft">		
					<div class="midTop">
					    <div class="eventBox">
							<?php echo $this->Form->create('Journal', array('type' => 'file'));?>
							<div id="alphaDiv">
								<!--Start popform -->
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



										<div id="testdiv1"></div>
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
											<?php echo $this->Form->input('areaid', array(
																	'class'=>'popinpt1',
																	'div'=> false,
																	'label'=> false,
																	'id'=>'areas')); 
											?>
										</div>
										<script>
											$(function() {
												var areas = [
												<?php
													foreach ($areas as $id=>$elem) {
														print("\"$elem\",");
													}
													print("\" \"");
 												?>
												];
												$( "#areas" ).autocomplete({
													source: areas
												});
											});
										</script>
										<div class="clr"></div>
		
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
											 					'default'=> '254',
																'class'=>'popslct',
																'div'=> false,
																'label'=> false 
																)); 
										?>
	
									</div>
									<div class="clr"></div>
								</div>
								<div class="popformLine">
									<div class="poplabel">City <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
										echo $this->Form->input('cityid', array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false,
																'id'=>'cities'
																)); 
										 ?>
									</div>
										<script>
											$(function() {
												var cities = [
												<?php
													foreach ($cities as $id=>$elem) {
														print("\"$elem\",");
													}
													print("\" \"");
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
									<div class="poplabel">Location  <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php echo $this->Form->input('location', array(
																'class'=>'popinpt1',
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
							<div align="center"><?php echo $this->Form->end(__(' Save and Continue to Sharing Levels '));?></div>
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
<?php /*
$this->Js->get('#JournalCountryId')->event('change', 
	$this->Js->request(array(
		'controller'=>'journals',
		'action'=>'getByRegion'
		), array(
		'update'=>'#JournalRegionId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	); */
?>

<?php /*
$this->Js->get('#JournalRegionId')->event('change', 
	$this->Js->request(array(
		'controller'=>'journals',
		'action'=>'getByCity'
		), array(
		'update'=>'#JournalCityId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);*/
?>

	<script>
		$(function() {
			$( "#datepicker" ).datepicker({ maxDate: " +0D", changeYear: true, yearRange: "-300:+0",  changeMonth:true });

		});
		
	</script>
