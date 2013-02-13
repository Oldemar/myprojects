<!--scroll script -->
<script type="text/javascript">
	var msgBeforeUnload = "It seems like you did not make any changes to your journal!";
	var rateBeforeUnload = 0;
</script>
<script>
	window.onbeforeunload = function (e) {
    return msgBeforeUnload;
	}
</script>
<?php # echo "<pre>" . print_r($journals, true) . "</pre>"; ?> 
<!--Start middle Container-->

<div id="middleCntr">	
	<!-- Start content container --> 
	<div id="contentCntr">				
		<div class="">			
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

				<div class="rgtCntrleft" style="padding-top:15px;width:744px;">
					<div class="bluBar_wide"><?php echo $journals['Journal']['title']; ?></div>		
					<div class="midTop">
						<div class="eventBox" style="width:100%;">
							<?php echo $this->Form->create('Journal', array('type' => 'file', 'id'=>'journalForm'));
							echo $this->Form->input('id',array('value'=>$journals['Journal']['id'], 'type'=>'hidden'));
							echo $this->Form->input('date_event',array('value'=>$journals['Journal']['date_event'], 'type'=>'hidden'));
							echo $this->Form->input('area_id',array('value'=>$journals['Journal']['area_id'], 'type'=>'hidden'));
							echo $this->Form->input('city_id',array('value'=>$journals['Journal']['city_id'], 'type'=>'hidden'));
							echo $this->Form->input('region_id',array('value'=>$journals['Journal']['region_id'], 'type'=>'hidden'));
							echo $this->Form->input('country_id',array('value'=>$journals['Journal']['country_id'], 'type'=>'hidden'));
							?>
							<!--Start popform -->
							<div id="JrnlEntryChkBox">
								
									<span style="color: darkblue;font-size: 16px;font-weight:bold;">Select your Sharing Levels</span>
								
								
								
								<div class="popformLine">
									<div class="sharingtxt2">
										<span class="shrSelectable">&nbsp;&nbsp;<span class="label label-success">G</span> For Alpha World &nbsp;</span>
										<div class="journalCheckbox1" id="chkbxD1">
											<?php
												$checked = "";
												if ($journals['Journal']['forall_description'] != "" ||
													count($photos2) > 0) {
													$checked = "checked=\"checked\"";
												}

											?>
											<input id="chkbx1" type="checkbox" <?php echo $checked; ?>  style="height:20px;width:20px;" />
										</div> 
									</div>
										<script type="text/javascript">
											$(document).ready(function(){
		
											   $("#chkbxD1").change(function(){
		
												// If checked
												if ($("#chkbx1").is(':checked'))
												{
													//show the hidden div
													$("#alphaWorld").css("display","block");
													$(this).parents('.sharingtxt2').eq(0).addClass('sharingtxt2_selected');
												}
												else
												{
													//otherwise, hide it
													$("#alphaWorld").css("display","none");
													$(this).parents('.sharingtxt2').eq(0).removeClass('sharingtxt2_selected');
												}
											  }).change();
											});
									 
									</script>
									<?php if (count($friendlist) != 0) { ?>
									<div class="sharingtxt2">
									<span class="shrSelectable">&nbsp;&nbsp;<span class="label label-info">F</span>  For my Alpha Friends</span>
										<div class="journalCheckbox1" id="chkbxD2" >
											<?php
												$checked = "";
												if ($journals['Journal']['forgroup_description'] != "" ||
													count($photos1) > 0) {
													$checked = "checked=\"checked\"";
												}

											?>
											<input id="chkbx2" type="checkbox" <?php echo $checked; ?> style="height:20px;width:20px;" />
										</div> 
									</div>
									<script type="text/javascript">
											$(document).ready(function(){
		
												// Add onclick handler to checkbox w/id checkme
											   $("#chkbxD2").change(function(){
		
												// If checked
												if ($("#chkbx2").is(":checked"))
												{
													//show the hidden div
													$("#alphaFriends").css("display","block");
													$(this).parents('.sharingtxt2').eq(0).addClass('sharingtxt2_selected');
												}
												else
												{
													//otherwise, hide it
													$("#alphaFriends").css("display","none");
													$(this).parents('.sharingtxt2').eq(0).removeClass('sharingtxt2_selected');
												}
											  }).change();
		
											});
									 
									</script>
									<?php } ?>
									<div class="sharingtxt2">
										<span class="shrSelectable">&nbsp;&nbsp;<span class="label label-important">P</span> For my eyes only</span>
										<div class="journalCheckbox1" id="chkbxD3" >
											<?php
												$checked = "";
												if ($journals['Journal']['forme_description'] != "" ||
													count($photos0) > 0) {
													$checked = "checked=\"checked\"";
												}

											?>
											<input id="chkbx3" type="checkbox" <?php echo $checked; ?> style="height:20px;width:20px;" />
										</div> 
									</div>
									<script type="text/javascript">
											$(document).ready(function(){
												// Add onclick handler to checkbox w/id checkme
											   $("#chkbx3").change(function(){
		
												// If checked
												if ($("#chkbx3").is(":checked"))
												{
													//show the hidden div
													$("#forMyself").css("display","block");
													$(this).parents('.sharingtxt2').eq(0).addClass('sharingtxt2_selected');
												}
												else
												{
													//otherwise, hide it
													$("#forMyself").css("display","none");
													$(this).parents('.sharingtxt2').eq(0).removeClass('sharingtxt2_selected');
												}
											  }).change();

											   $('.shrSelectable').click(function(){
												   var checkBoxSharingLevel = $(this).parents('.sharingtxt2').eq(0).find("input[type|=checkbox]").eq(0);
													if (checkBoxSharingLevel.is(":checked")){
														$(this).parents('.sharingtxt2').eq(0).removeClass('sharingtxt2_selected');
														checkBoxSharingLevel.removeAttr('checked');
														checkBoxSharingLevel.change();
														
													}else{
														$(this).parents('.sharingtxt2').eq(0).addClass('sharingtxt2_selected');
														checkBoxSharingLevel.attr('checked',"true");
														checkBoxSharingLevel.change();
													}		
												});
											});
									 
									</script>
	
								</div>
								<?php
									echo $this->Html->link('<i class="icon-chevron-left"></i> Previous', array('controller'=>'journals', 'action'=>'editnew',$journals['Journal']['id']), array('class' => 'btn','escape'=>false));
									echo $this->Html->link('Next <i class="icon-chevron-right icon-white"></i>','#', array('id'=>'next_1', 'class' => 'btn btn-primary','style'=>'float:right;','escape'=>false));
								?>		
								<script type="text/javascript">
										$(document).ready(function(){
											$('#next_1').click(function(){
											    $('#JrnlEntryChkBox').hide("fast");
											    $('#finish').css("display","block");
											    $('#JournalEntries').css("display","block");
											});
										});
								 
								</script>
							</div>
							<!--Start popform -->
							<div id="JournalEntries">							
								<div id="alphaWorld">
									<div style="margin-top:5px;" class="popover_journal_list left">
										<h3 class="popover_journal_list-title" style="font-size:14px;">
											<b><span class="label label-success">G</span> For Alpha world</b> 
											<span style="float:right;" id="rating2">
												<?php
													echo $this->element('journals/rating',array('shrlvl'=>'2'))
												?>
											</span></h3>
										<div class="popover_journal_list-content">
											<div class="row-fluid">
												<div class="span12">
													<textarea id="JournalForallDescription" class="sharingmessage" name="data[Journal][forall_description]"><?php echo htmlspecialchars_decode(str_replace(array('<br>','<br />'),'',$this->request->data['Journal']['forall_description'])); ?></textarea>
												</div>	
												<script>
													$('#JournalForallDescription').change(function(){
														if (rateBeforeUnload == 0) {
															window.onbeforeunload = function (e) {
																return "You did not rated your journal entry...";
															};
														} else {
															window.onbeforeunload = null;
														}
													});
												</script>
												</div>
											<div class="row-fluid" style="margin-top:10px;">
												<div class="span3">
												<?php
													if ($countAllowedPhotos2 > 0 ) {
												?>
													<a href="javascript:;" class="btn btn-success" id="addPhotoButton2">
														<i class="icon-plus icon-white"></i> Add Photos
													</a>
												<?php
													echo $this->Modal->photoUpload('addPhotoButton2', $objJournal, 2 , 'divPhotosSharingLevel2');
													}
												?>	
												</div>
												<div class="span3">
												<?php
													if (2-count($journals['Video']) > 0 ) {
												?>
													<a href="javascript://" class="btn btn-success"  id="addVideoButton2">
														<i class="icon-plus icon-white"></i> Add videos
													</a>
												<?php
													echo $this->Modal->videoUpload('addVideoButton2', $objJournal, 2 , 'divVideosSharingLevel2');
													}
												?>	
												</div>
													
											</div>
											
											<div class="row-fluid albumPhoto">
												<div id="divPhotosSharingLevel2">
													<?php
														echo $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>2)); 
													?>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span12" id="divVideosSharingLevel2">
													<?php
														echo $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>2)); 
													?>
												</div>
											</div>
										</div>
										
									</div>
									
										
								</div>
								<!--End popform -->
								<!--Start popform -->
								<div id="alphaFriends">
									<div style="margin-top:25px;" class="popover_journal_list left">
										<h3 class="popover_journal_list-title" style="font-size:14px;">
											<b><span class="label label-info">F</span> For my Alpha friends</b> 
											<span style="float:right;"  id="rating1">
												<?php
													echo $this->element('journals/rating',array('shrlvl'=>'1'))
												?>
											</span></h3>
										<div class="popover_journal_list-content">
											<div class="row-fluid">
												<div class="span12">
													<textarea id="forgroup_description" class="sharingmessage" name="data[forgroup_description]"><?php echo htmlspecialchars_decode(str_replace(array('<br>','<br />'),'',$this->request->data['Journal']['forgroup_description'])); ?></textarea>
												<script>
													$('#forgroup_description').change(function(){
														if (rateBeforeUnload == 0) {
															window.onbeforeunload = function (e) {
																return "You did not rated your journal entry...";
															};
														} else {
															window.onbeforeunload = null;
														}
													});
												</script>
													
													<div class="headingInt" style="border-bottom:0px;padding-top:10px">
														
														<div class="selectbox">
															<div class="selecteddata" onclick="select_show('fl')">
																Share with ...
															</div>
															<div class="chkselct" id="fl">
																<ul>
																	<li id="liAllGrp">
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
																	</li>
																	<script type="text/javascript">
																			$(document).ready(function(){
																				$(".usrAllwd").css("display",'block');
																			    $("#liAllGrp").change(function(){
																				// If checked
																				if ($("#chkbxg").is(":checked"))
																				{
																					//hide the shown div
																					$("#gsharing").css("display",'none');
																					$(".allGrps").css("display",'block');
																					$(".allGSgrps").css("display","none");
																					$(".allBxGrps").css("display","none");
		
																				}
																				else
																				{
																					//otherwise, show it
																					$("#gsharing").css("display","block");
																					$(".allGrps").css("display",'none');
																					$(".usrAllwd").css("display",'block');
																					$(".allGSgrps").css("display","block");
																					$(".allBxGrps").css("display","block");
																				}
																			  }).change();
										
																			});
																	 
																	</script>
																	<div id="gsharing">
																		<li>
																	<?php
																		$checked='';
																		foreach ($usrjrnl as $wusrjrnl):
																			if ($wusrjrnl['Journalperm']['tablename_id'] == 10 && 
																				$wusrjrnl['Journalperm']['id_value'] != 0) {
																					$checked ="checked";
																					break;
																				}
																		endforeach;
																		echo $this->Form->checkbox('selctGrp', array(
																						'id'=>'chkbxSg',
																						'checked'=>$checked
																							));
																		?>
																		&nbsp;Selected Groups
																		</li>
																		<script type="text/javascript">
																			$(document).ready(function(){
										
																				//Hide div w/id extra
																			   $("#gSsharing").css("display","none");
										
																				// Add onclick handler to checkbox w/id checkme
																			   $("#chkbxSg").change(function(){
										
																				// If checked
																				if ($("#chkbxSg").is(":checked"))
																				{
																					//show the hidden div
																					$("#liAllGrp").css("display","none");
																					$("#gSsharing").css("display",'block');
																					$(".allBxGrps").css("display","none");
																				}
																				else
																				{
																					//otherwise, hide it
																					$("#gSsharing").css("display",'none');
																					$("#liAllGrp").css("display",'block');
																					$(".allBxGrps").css("display","block");
																				}
																			  }).change();
										
																			});
																		 
																		</script>
																		<div id="gSsharing">
																			<?php
																				foreach ($groupslist as $grp) :
																					$checked ="";
																					foreach ($usrjrnl as $wusrjrnl):
																						if ($wusrjrnl['Journalperm']['tablename_id'] == 10 && 
																							$wusrjrnl['Journalperm']['id_value'] == $grp['Group']['id']) {
																								$checked ="checked";
																								break;
																							}
																					endforeach;
																			?>
																			<div id="liGrp<?php echo $grp['Group']['id']; ?>" style="padding:5px 0 0 24px">
																			<?php	
																				echo $this->Form->checkbox(
																					'gsharing.'.$grp['Group']['id'], array(
																						'id'=>'chkbxg'.$grp['Group']['id'],
																						'checked'=>$checked
																						));
																				echo ' '.$grp['Group']['name'];
																					
																			?>
																			</div>
		
																			<script type="text/javascript">
																				$(document).ready(function(){
											
																					// Add onclick handler to checkbox w/id checkme
																				   $("#chkbxg<?php echo $grp['Group']['id']; ?>").change(function(){
											
																					// If checked
																					if ($("#chkbxg<?php echo $grp['Group']['id']; ?>").is(":checked"))
																					{
																						//show the hidden div
																						$(".grp_<?php echo $grp['Group']['id']; ?>").css("display","block");
																						$(".selUgrp_<?php echo $grp['Group']['id']; ?>").css("display","none");
																						$(".grpBxs_<?php echo $grp['Group']['id']; ?>").css("display","none");
																					} else {
																						$(".grp_<?php echo $grp['Group']['id']; ?>").css("display","none");
																						$(".selUgrp_<?php echo $grp['Group']['id']; ?>").css("display","block");
																						$(".grpBxs_<?php echo $grp['Group']['id']; ?>").css("display","block");
																						$(".usrAllwd").css("display",'block');
																					}
																				  }).change();
											
																				});
																			 
																			</script>
			
																			<?php	
																				endforeach;
																			?>
																		
																		</div>
																	</div>
																	<div id="liAllFrnd">
																		<li>
																		<?php
																			$checked='';
																			foreach ($usrjrnl as $wusrjrnl):
																				if ($wusrjrnl['Journalperm']['tablename_id'] == 3 && 
																					$wusrjrnl['Journalperm']['id_value'] == 0) {
																						$checked ="checked";
																						break;
																					}
																			endforeach;
																			echo $this->Form->checkbox('fsharing.0', array(
																							'id'=>'chkbxf',
																							'checked'=>$checked
																							));
																		?>
																		&nbsp;All Friends
																		</li>
																	</div>
																	<script type="text/javascript">
																		$(document).ready(function(){
																
																			$("#liAllFrnd").change(function(){
									
																			// If checked
																			if ($("#chkbxf").is(":checked"))
																			{
																				//show the hidden div
																				$("#fsharing").css("display","none");
																				$("#gsharing").css("display","none");
																				$("#liAllGrp").css("display","none");
																				$(".allFrnds").css("display","block");
																				$(".allSFrnds").css("display","none");
																				$(".allbxFrnds").css("display","none");
																			}
																			else
																			{
																				//otherwise, hide it
																				$("#fsharing").css("display",'block');
																				if ($("#chkbxg").is(":checked")) {}
																				else 
																				{
																					$("#gsharing").show("fast");
																				}
																				$("#liAllGrp").show("fast");
																				$(".allFrnds").css("display","none");
																				$(".allSFrnds").css("display","block");
																				$(".usrAllwd").css("display",'block');
																				$(".allbxFrnds").css("display","block");
																			}
																		}).change();
									
																		});
																	</script>
																	<div id="fsharing">
																		<li>
																		<?php
																			echo $this->Form->checkbox('selctFrnd', array(
																						'id'=>'chkbxSf'
																						));
																		?>
																		&nbsp;Selected Friends
																		</li>
																		<script type="text/javascript">
																			$(document).ready(function(){
									
																				//Hide div w/id extra
																			   $("#fSsharing").css("display","none");
										
																				// Add onclick handler to checkbox w/id checkme
																			   $("#chkbxSf").click(function(){
										
																				// If checked
																				if ($("#chkbxSf").is(":checked"))
																				{
																					//show the hidden div
																					$("#liAllFrnd").hide("fast");
																					$("#fSsharing").show("fast");
																				}
																				else
																				{
																					//otherwise, hide it
																					$("#fSsharing").hide("fast");
																					$("#liAllFrnd").show("fast");
																				}
																			  });
										
																			});
																		 
																		</script>
																		<div id="fSsharing">
																			<?php
																				foreach ($friendlist as $frnd) :
																					if ($frnd['User']['allowed']) {
																						$disp='display:none;';
																					} else {
																						$disp='display:block;';
																					}
																			if (isset($frnd['User']['GroupsUser']) && !is_null($frnd['User']['GroupsUser'])) {
																				$selgrps = "";
																				foreach ($frnd['User']['GroupsUser'] as $grp) {
																					$selgrps .= "selUgrp_".$grp['group_id']." ";
																				}
																				if ($selgrps != "") {
																					$selgrps = "allGSgrps ".$selgrps;
																				}
																			
																			}		
																			?>
																			<div class="allSFrnds <?php echo $selgrps; ?>" id="selUsr<?php echo $frnd['User']['id']; ?>" style="<?php echo $disp ;?>padding:5px 0 0 24px">
																			<?php	
																					echo $this->Form->checkbox('fsharing.'.$frnd['User']['id'], array(
																								'id'=>'chkbxf'.$frnd['User']['id']
																								));
																					echo ' '.$frnd['User']['firstname'].' '.$frnd['User']['lastname'];
																					$idchkbxf = "\"#chkbxf".$frnd['User']['id']."\"";
																					$jkey = key($frnd);
																					
																			?>
																			</div>
																			<script type="text/javascript">
																			$(document).ready(function(){
		
																				// Add onclick handler to checkbox w/id checkme
																			   $("#<?php echo 'chkbxf'.$frnd['User']['id']; ?>").click(function(){
																				// If checked
																				if ($("#<?php echo 'chkbxf'.$frnd['User']['id']; ?>").is(":checked"))
																				{
																					//show the hidden div
																					$("#<?php echo 'allowedUsr'.$frnd['User']['id']; ?>").css("display","block");
																					$("#<?php echo 'selUsr'.$frnd['User']['id']; ?>").css("display","none");
																					$("#fsharing").show("fast");
																					if (!$("#chkbxg").is(":checked")) 
		
																					{
																						$("#gsharing").show("fast");
																					}
																					$("#liAllGrp").show("fast");
																					$("#<?php echo 'chkbxf'.$frnd['User']['id']; ?>").attr("checked",false);
																					$("#<?php echo 'uchkbxf'.$frnd['User']['id']; ?>").attr("checked",true);
																					$(".usrAllwd").css("display",'block');				
																				}
																			  });
										
																			});
																		 
																		</script>											
		
																			<?php	
																			
																				endforeach;
																			?>
																		</div>
																	</div>
																	
																	<input type="hidden" id="flvr" value="0">
																</ul>
			 												</div>
		 												</div>
		 												<div style="float:right;position:relative;padding-right: 10px;padding-top: 5px;">Who do you want to share with?</div>
													</div>
													<div id="forgroupsharing">
														<?php echo $this->element('journals/changeperm'); ?>
													</div>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span3">
												<?php
													if ($countAllowedPhotos1 ) {
												?>
													<a href="javascript:;" class="btn btn-success" id="addPhotoButton1">
														<i class="icon-plus icon-white"></i> Add Photos
													</a>
												<?php
													echo $this->Modal->photoUpload('addPhotoButton1', $objJournal, 1 , 'divPhotosSharingLevel1');
													}
												?>
												</div>
												<div class="span3">
												<?php
													if (2-count($journals['Video']) > 0 ) {
												?>
													<a href="javascript://" class="btn btn-success" id="addVideoButton1">
														<i class="icon-plus icon-white"></i> Add videos
													</a>
												<?php
													echo $this->Modal->videoUpload('addVideoButton1', $objJournal, 1 , 'divVideosSharingLevel1');
													}
												?>	
												</div>
													
											</div>
											
											
											<div class="row-fluid">
												<div class="span12" id="divPhotosSharingLevel1">
													<?php
														echo $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>1)); 
													?>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span12" id="divVideosSharingLevel1">
													<?php
														echo $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>1)); 
													?>
												</div>
											</div>
										</div>												
									</div>
									
								</div>
								<!--End popform -->
								<!--Start popform -->
								<div id="forMyself">
									<div style="margin-top:25px;" class="popover_journal_list left">
										<h3 class="popover_journal_list-title" style="font-size:14px;">
											<b><span class="label label-important">P</span> For my eyes only</b> 
											<span style="float:right;"  id="rating0">
												<?php
													echo $this->element('journals/rating',array('shrlvl'=>'0'))
												?>
											</span></h3>
										<div class="popover_journal_list-content">
											<div class="row-fluid">
												<div class="span12">
													<textarea id="forme_description" class="sharingmessage" name="data[forme_description]"><?php echo htmlspecialchars_decode(str_replace(array('<br>','<br />'),'',$this->request->data['Journal']['forme_description'])); ?></textarea>
												<script>
													$('#forme_description').change(function(){
														if (rateBeforeUnload == 0) {
															window.onbeforeunload = function (e) {
																return "You did not rated your journal entry...";
															};
														} else {
															window.onbeforeunload = null;
														}
													});
												</script>
													</div>
											</div>
											<div class="row-fluid"  style="margin-top:10px;">
												<div class="span3">
												<?php
													if ($countAllowedPhotos0) {
												?>
													<a href="javascript:;" class="btn btn-success" id="addPhotoButton0">
														<i class="icon-plus icon-white"></i> Add Photos
													</a>
												<?php
													echo $this->Modal->photoUpload('addPhotoButton0', $objJournal, 0 , 'divPhotosSharingLevel0');
													}
												?>		
												</div>
												<div class="span3">
												<?php
													if (2-count($journals['Video']) > 0 ) {
												?>
													<a href="javascript://"  class="btn btn-success" id="addVideoButton0">
														<i class="icon-plus icon-white"></i> Add videos
													</a>
												<?php
													}
													echo $this->Modal->videoUpload('addVideoButton0', $objJournal, 0 , 'divVideosSharingLevel0');
												?>	
												</div>
												
											</div>								
											
											
											<div class="row-fluid">
												<div class="span12" id="divPhotosSharingLevel0">
													<?php
														echo $this->element('Photos/list_photos',array('objJournal'=>$objJournal,'sharingLevel'=>0)); 
													?>
												</div>
											</div>
											<div class="row-fluid">
												<div class="span12" id="divVideosSharingLevel0">
													<?php
														echo $this->element('Videos/list_videos',array('objJournal'=>$objJournal,'sharingLevel'=>0)); 
													?>
												</div>
											</div>
											<!--Start albumBox -->
											
											<!--Start albumBox -->
											
										</div><br />
									</div>							
								</div>
								<!--End popform -->
								<div id="finish" style="display:none;margin-top:15px">
									<?php
										echo $this->Html->link('<i class="icon-chevron-left"></i> Previous', '#',array('id'=>'previous_2', 'class' => 'btn','escape'=>false) );
										echo '<button type="submit" id="saveAndFinish" class="btn btn-primary btn-large" style="display: none; float: right"><i class=\'icon-download-alt icon-white\'></i> Finish and Save</button>';
										echo $this->Form->end();								
									?>
								</div>		
								<script type="text/javascript">
										$(document).ready(function(){
											$('#previous_2').click(function(){
											    $('#JournalEntries').hide("fast");
											    $('#JrnlEntryChkBox').show("slow");
											});
										});
											
									
										$("#queuep2").change(function(){
											var photocount = parseFloat($('#photocount').text());
											var photoadded = $('.filename').length;
											var photocount2 = (photocount) - (photoadded);

											$('#photocount').text(photocount2);	
												console.log(photocount);
												console.log(photoadded);

										});

										$('#JournalForallDescription').click(function(){
											$('#saveAndFinish').css('display','block');
										});
										$('#forgroup_description').click(function(){
											$('#saveAndFinish').css('display','block');
										});
										$('#forme_description').click(function(){
											$('#saveAndFinish').css('display','block');
										});
										
								</script>
							</div>
						</div>
					</div>								
										
				</div>
				<!-- End rgtCntrleft -->
				<!-- Start rgtCntrright -->
		
				<?php //echo $this->element('journals/share'); ?>
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

<script>
	if (rateBeforeUnload == 0) {
		msg = "You did not rated your journal entry...";
		window.onbeforeunload = function (e) {
		return msgBeforeUnload;
} 
</script>

