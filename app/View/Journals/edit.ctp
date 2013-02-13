
<script language="JavaScript" id="jscal1x">
	var cal1x = new CalendarPopup("testdiv1");
</script>

<script type="text/javascript">

ddaccordion.init({
	 headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	 contentclass: "categoryitems", //Shared CSS class name of contents group
	 revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	 mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	 collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	 defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	 animatedefault: true, //Should contents open by default be animated into view?
	 scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
	 persiststate: false, //persist state of opened contents within browser session?
	 toggleclass: ["selected", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	 togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	 animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
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
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="angelina">Edit an Alpha Journal Entry</div>
					<div class="clr"></div>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
			<!-- Start left container -->
			<div id="leftCntr">
				<?php echo $this->element('profile/user_image'); ?>
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
							<!--Start popform -->
							
							<div class="expandable selected"><a href="#">Step 1 - Journal Details</a></div>
	
							<div class="categoryitems selected popform">
								<div class="popformLine">
									<div class="poplabel">Date <span class="mendatorytxt">*</span></div>
									<div class="popcalndFld">
										<?php
											echo $this->Form->input('id', array('type' => 'hidden'));
											echo $this->Form->input('edt', array('type' => 'hidden','value'=>1));
											echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => Authcomponent::user('id')));
											//echo $this->Form->input('date_event');

											echo $this->Form->input('date_event', array(
												'dateFormat'	=> 'Y-m-d',
												'type' 			=> 'text',
												'id'			=> 'anchor1x',
												'label'			=> false,
												'class'			=> 'popinptdate',
												'onclick'		=> "cal1x.select(document.forms[0].anchor1x, 'anchor1x', 'MM/dd/yyyy'); return false;"
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
										<?php echo $this->Form->input(
															'areaid', array(
																'class'=>'popselect',
																'div'=> false,
																'label'=> false,
																'value'=>$journals['Area']['name'],
																'id'=>'areas'	
																)); 
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
								<div class="popformLine">
									<div class="poplabel">Cost Incurred</div>
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
									<div class="poplabel">Country <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
											 echo $this->Form->input('country_id', array(
																'class'=>'popselect',
																'div'=> false,
																'label'=> false 
																)); 
										 ?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="popformLine">
									<div class="poplabel">State / Province <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
											 echo $this->Form->input('region_id', array(
																'class'=>'popselect',
											 					'empty'=> $journals['Region']['region'],
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
											 echo $this->Form->input('city_id', array(
																'class'=>'popselect',
											 					'empty'=> $journals['City']['name'],
											 					'div'=> false,
																'label'=> false 
																)); 
										 ?>
									</div>
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
								<br />
							</div>
							<!--End popform -->
							<!--Start popform -->
							<div class="expandable"><a href="#">Step 2 - Sharing Levels</a></div>
							<div class="categoryitems popform">
								<div class="popformLine">
									<div class="sharingtxt2">
										&nbsp;Global Journal Entry
										<div class="journalCheckbox1">
 										<?php
											$checked="";
											if ( $journals['Journal']['forall_description'] != null ||
												count($photos2) > 0 ){
												$checked = "checked"; 
												}
											echo $this->Form->input('chk2', array(
																'type'=>'checkbox',
																'div'=>false,
																'label'=>false,
																'id'=>'chkbx2',
																'checked'=>$checked
											));
											
										?>
										</div>
									</div>
									<script type="text/javascript">
											$(document).ready(function(){
		
												// If checked
												if ($("#chkbx2").is(":checked"))
												{
													//Hide div
												   $("#foralldesc").css("display","block");
												}
												else
												{
													//Show div
												   $("#foralldesc").css("display","none");
												}
		
												// Add onclick handler to checkbox w/id checkme
											   $("#chkbx2").click(function(){
		
												// If checked
												if ($("#chkbx2").is(":checked"))
												{
													//show the hidden div
													$("#foralldesc").show("fast");
												}
												else
												{
													//otherwise, hide it
													$("#foralldesc").hide("fast");
												}
											  });
		
											});
									 
									</script>
									<div id="foralldesc">
										<div class="sharingMsg" style="padding-bottom:10px;">
											<div id="rating2" style="padding-bottom:5px;">
												<?php
													CakeSession::write('shrlev', '2');
													$rate  = $keyrate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['sharing_level'] == 2 && $journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
														}	
													endforeach;
													if ($rate) {
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image($alphasun[($x-$rate<=0 ? 0 : 1)]), "#",
																							array('escape'=> false,'id'=>"rating2$x"));
														}	
													} else { 
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image('rating_icon_big_gry.gif'), "#",
																							array('escape'=> false,'id'=>"rating2$x"));
														}	
													}
													CakeSession::write('keyrate', $keyrate);
												?>
											</div>
											<?php 
												echo $this->Form->textarea('forall_description', array(
																'div'=> false,
																'class'=>'sharingmessage'));
												?>
										</div>
										<?php 
										if (count($photos2)>0) { ?>
										<div style="border:1px solid #ccc; padding:5px 5px 5px 5px; float:left; width:auto;">
											<?php 
												foreach ($photos2 as $photo):
											?>
											<div style="padding-right:5px; float:left;">
											<?php 
												echo $this->Html->link($this->Html->image($photo['Photo']['name'], array('height'=>'45')), 
																			array('controller'=>'photos', 'action' => 'album', $photo['Photo']['journal_id'],0),
																			array('escape'=> false));
											?>
											</div>
											<?php 
											endforeach;
											?>
										</div>	
											<?php 
											}
										?>
									</div>
								</div>						
								<div class="clr"></div>	
								<div class="popformLine">
									<div class="sharingtxt2">

									 &nbsp;Journal Entry for Friends

										<div class="journalCheckbox1">
										<?php
											$checked="";
											if ( $journals['Journal']['forgroup_description'] != null ||
												count($photos1) > 0 ){
												$checked = "checked"; 
												}
											echo $this->Form->input('chk1', array(
																'type'=>'checkbox',
																'div'=>false,
																'label'=>false,
																'id'=>'chkbx1',
																'checked'=>$checked
											))
										?>
										</div>

<!-- 										<input id="chkbx2" type="checkbox" /> -->									</div>
									<script type="text/javascript">
											$(document).ready(function(){
		
												//Hide div w/id extra
												// If checked
												if ($("#chkbx1").is(":checked"))
												{
													//show the hidden div
												   $("#forgroupdesc").css("display","block");
												}
												else
												{
													//otherwise, hide it
												   $("#forgroupdesc").css("display","none");
												}
		
												// Add onclick handler to checkbox w/id checkme
											   $("#chkbx1").click(function(){
		
												// If checked
												if ($("#chkbx1").is(":checked"))
												{
													//show the hidden div
													$("#forgroupdesc").show("fast");
												}
												else
												{
													//otherwise, hide it
													$("#forgroupdesc").hide("fast");
												}
											  });
		
											});
									 
									</script>
									<div id="forgroupdesc" class="sharingMsg">
											<div id="rating1" style="padding-bottom:5px;">
												<?php
													CakeSession::write('shrlev', '1');
													$rate  = $keyrate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['sharing_level'] == 1 && $journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
														}	
													endforeach;
													if ($rate) {
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image($alphasun[($x-$rate<=0 ? 0 : 1)]), "#",
																							array('escape'=> false,'id'=>"rating1$x"));
														}	
													} else { 
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image('rating_icon_big_gry.gif'), "#",
																							array('escape'=> false,'id'=>"rating1$x"));
														}	
													}
													CakeSession::write('keyrate', $keyrate);
												?>
											</div>
										<?php 
											echo $this->Form->textarea('forgroup_description', array(
															'div'=> false,
															'class'=>'sharingmessage')); 
										?>
										<?php 
										if (count($photos1)>0) { ?>
										<div style="border:1px solid #ccc; padding:5px 5px 5px 5px; float:left; width:auto;">
											<?php 
												foreach ($photos1 as $photo):
											?>
											<div style="padding-right:5px; float:left;">
											<?php 
												echo $this->Html->link($this->Html->image($photo['Photo']['name'], array('height'=>'45')), 
																			array('controller'=>'photos', 'action' => 'album', $photo['Photo']['journal_id'],0),
																			array('escape'=> false));
											?>
											</div>
											<?php 
											endforeach;
											?>
										</div>	
											<?php 
											}
										?>
										<div id="forgroupsharing">
											
											<div class="sharingtxt">
											<?php
												$chkbxf = "";
												$checked='';
												foreach ($usrjrnl as $wusrjrnl):
													if ($wusrjrnl['Journalperm']['tablename_id'] == 3 && 
														$wusrjrnl['Journalperm']['id_value'] == 0) {
															$chkbxf = 'checked="checked"';
															$checked ="checked";
															break;
														}
												endforeach;
												echo $this->Form->checkbox('fsharing.0', array(
																'id'=>'chkbxf',
																'checked'=>$checked
																));
											?>
												&nbsp;All my friends
											</div>
											<script type="text/javascript">
													$(document).ready(function(){
				
														//Hide div w/id extra
														if ($("#chkbxf").is(":checked"))
														{
														   $("#fsharing").css("display","none");
														}
														else
														{
														   $("#fsharing").css("display","block");
														}
														// Add onclick handler to checkbox w/id checkme
													   $("#chkbxf").click(function(){
				
														// If checked
														if ($("#chkbxf").is(":checked"))
														{
															//show the hidden div
															$("#fsharing").hide("fast");
														}
														else
														{
															//otherwise, hide it
															$("#fsharing").show("fast");
														}
													  });
				
													});
											 
											</script>
											<div id="fsharing">
											<?php
												$this->set('usrjrnl',$usrjrnl);
												/*
												 *  Params to be passed
												 *  usertobeshow => An array that contains the users to be shown
												 *  elementactions => the element that contains the actions to be shown
												 */ 
												$this->set('isins','');
												$this->set('isdel','');
												$this->set('isedt',1);
												$this->set('ischk','');
												$this->set('isspec','');
												echo $this->element('usersmlbox', array(
																	'usertobeshow'=>$friendlist,
																	'elementactions'=>'edtfriendjournal'
																	));
											?>
											</div>
											<div class="sharingtxt">											
											<?php
												$checked='';
												foreach ($usrjrnl as $wusrjrnl):
													if ($wusrjrnl['Journalperm']['tablename_id'] == 10 && 
														$wusrjrnl['Journalperm']['id_value'] == 0) {
															$checked ="checked";
															break;
														}
												endforeach;
												echo $this->Form->checkbox('gsharing.0', array(
																'id'=>'chkbxg',
																'checked'=>$checked
																));
											?>
												&nbsp;All Groups
											</div>
											<div id="gsharing">
											<?php
												/*
												 *  Params to be passed
												 *  usertobeshow => An array that contains the users to be shown
												 *  elementactions => the element that contains the actions to be shown
												 */ 
												$this->set('isins','');
												$this->set('isdel','');
												$this->set('isedt',1);
												$this->set('ischk',1);
												$this->set('isspec','');
												echo $this->element('jgrpsmlbox', array(
																	'grptobeshow'=>$groupslist,
																	'elementactions'=>'edtgroupjournal'
																	));
											?>
											</div>
											<script type="text/javascript">
													$(document).ready(function(){
				
														//Hide div w/id extra
													   $("#gsharing").css("display","block");
				
														// Add onclick handler to checkbox w/id checkme
													   $("#chkbxg").click(function(){
				
														// If checked
														if ($("#chkbxg").is(":checked"))
														{
															//show the hidden div
															$("#gsharing").hide("fast");
														}
														else
														{
															//otherwise, hide it
															$("#gsharing").show("fast");
														}
													  });
				
													});
											 
											</script>
										</div>
									</div>								
								</div>
								<div class="clr"></div>	
								<div class="popformLine">
									<div class="sharingtxt2">
											&nbsp;Journal Entry for Myself
										<div class="journalCheckbox1">
										<?php
											$checked="";
											if ( $journals['Journal']['forme_description'] != null ||
												count($photos0) > 0 ){
												$checked = "checked"; 
												}
											echo $this->Form->input('chk0', array(
																'type'=>'checkbox',
																'div'=>false,
																'label'=>false,
																'id'=>'chkbx0',
																'checked'=>$checked
											))
										?>
										</div>
									</div>
									<script type="text/javascript">
											$(document).ready(function(){
		
												//Hide div w/id extra
												// If checked
												if ($("#chkbx0").is(":checked"))
												{
													//show the hidden div
												   $("#formedesc").css("display","block");
												}
												else
												{
													//otherwise, hide it
												   $("#formedesc").css("display","none");
												}
		
												// Add onclick handler to checkbox w/id checkme
											   $("#chkbx0").click(function(){
		
												// If checked
												if ($("#chkbx0").is(":checked"))
												{
													//show the hidden div
													$("#formedesc").show("fast");
												}
												else
												{
													//otherwise, hide it
													$("#formedesc").hide("fast");
												}
											  });
		
											});
									 
									</script>
	
									<div id="formedesc" class="sharingMsg">
											<div id="rating0" style="padding-bottom:5px;">
												<?php
													CakeSession::write('shrlev', '0');
													$rate  = $keyrate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['sharing_level'] == 0 && $journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
														}	
													endforeach;
													if ($rate) {
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image($alphasun[($x-$rate<=0 ? 0 : 1)]), "#",
																							array('escape'=> false,'id'=>"rating0$x"));
														}	
													} else { 
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image('rating_icon_big_gry.gif'), "#",
																							array('escape'=> false,'id'=>"rating0$x"));
														}	
													}
													CakeSession::write('keyrate', $keyrate);
												?>
											</div>
										<?php 
											echo $this->Form->textarea('forme_description', array(
															'div'=> false,
															'class'=>'sharingmessage')).'<br>';
										?>
										<br>									
										<?php 
										if (count($photos0)>0) { ?>
										<div style="display:block; border:1px solid #ccc; padding:5px 5px 5px 5px; float:left; width:auto;">
											<?php 
												foreach ($photos0 as $photo):
											?>
											<div style="padding-right:5px; float:left;">
											<?php 
												echo $this->Html->link($this->Html->image($photo['Photo']['name'], array('height'=>'45')), 
																			array('controller'=>'photos', 'action' => 'album', $photo['Photo']['journal_id'],0),
																			array('escape'=> false));
											?>
											</div>
											<?php 
											endforeach;
											?>
										</div>	
											<?php 
											}
										?>
									</div><br />
								</div>							
							</div>
							<div class="expandable"><a href="#">Step 3 - Invitations</a></div>
							<div class="categoryitems popform">
								<h2>Not sent</h2>
									
								<table>
									<tr>
										<td class="invitWho"><h4>Who</h4>
										</td>
										<td class="invitDate"><h4>Date</h4>
										</td>
										<td class="invitIcon">
										</td>
										<td class="invitIcon">
										</td>
									</tr>
								<?php
									foreach ($journals['Invitation'] as $invitation) :
								?>
								<?php
										if (!$invitation['sent']) {
								?>
									<tr>
										<td><?php echo $invitation['invited'] ; ?>
										</td>
										<td><?php echo CakeTime::format('F jS, Y ',$invitation['created']) ; ?>
										</td>
										<td>
											<?php 
												echo $this->Html->link($this->Html->image('email.png',array('width'=>'40')), 
																	array('controller'=>'invitations', 'action' => 'sendEmail', $invitation['id']),
																	array('escape'=> false)); 
											?>
										</td>
										<td>
											<?php
												echo $this->Form->postLink($this->Html->image('delete.png'), 
																	array('controller'=>'invitations', 'action' => 'delete', $invitation['id']),
																	array('escape'=> false), 
																	__('Are you sure to delete this invitation ?'));
							
											?>
										</td>
									</tr>
								<?php
										}
									endforeach;
								?>
								</table>
								<h2>Not accepted</h2>
									
								<table>
									<tr>
										<td class="invitWho"><h4>Who</h4>
										</td>
										<td class="invitDate"><h4>Sent</h4>
										</td>
										<td class="invitIcon">
										</td>
										<td class="invitIcon">
										</td>
									</tr>
								<?php
									foreach ($journals['Invitation'] as $invitation) :
								?>
								<?php
										if ($invitation['sent']) {
								?>
									<tr>
										<td><?php echo $invitation['invited'] ; ?>
										</td>
										<td><?php echo CakeTime::format('F jS, Y ',$invitation['created']) ; ?>
										</td>
										<td>
											<?php 
												echo $this->Html->link($this->Html->image('email.png',array('width'=>'40')), 
																	array('controller'=>'invitations', 'action' => 'sendEmail', $invitation['id']),
																	array('escape'=> false)); 
											?>
										</td>
										<td>
										</td>
									</tr>
								<?php
																					}
									endforeach;
								?>
								</table>
							</div>
							<!--End popform -->
							<?php echo $this->Form->end(__(' Save '));?>
						</div>
					</div>								
										
				</div>
				<!-- End rgtCntrleft -->
					<?php echo $this->element('journals/friend_invitation'); ?>
				<!-- Start rgtCntrright -->
			
				<div class="clr"></div>
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
			<div class="clr"></div>	
		</div>																								
	</div>

	<!-- End content container -->
</div>
<!-- End middle container -->		
<?php
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
	);
?>

<?php
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
	);
?>
<?php 
$keyrate = CakeSession::read('keyrate');
for ($x=0;$x<3;$x++) {
	for ($y=1;$y<6;$y++) {
		$this->Js->get("#rating$x$y")->event('click', 
			$this->Js->request(array(
				'controller'=>'journals',
				'action'=>'saverate',$x,$y,$journals['Journal']['id'], $keyrate
				), array(
				'update'=>"#rating$x",
				'async' => true,
				'method' => 'post',
				'dataExpression'=>true,
				'data'=> $this->Js->serializeForm(array(
					'isForm' => true,
					'inline' => true
					))
				))
			);
		}
	}
	
?>

