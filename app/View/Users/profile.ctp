<?php
//	echo "<pre>".print_r($users,true)."</pre>";
?>


<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
				
		<div class="cntrCntr2">			
			<!-- Start of Profile Left bar -->	
			<!-- Start left container -->
			<div id="leftCntr">
				<?php 
					if ($isrelated){
						echo $this->element('profile/profile_image'); 
					}else{
						echo $this->element('profile/profile_photo'); 
					} 
				?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>

			</div>
			<!-- End left container -->		
			<!-- End of Profile Left bar -->
			
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft">
					<!--Start profileform -->
					<div class="profileform">
						<div class="strachbar">
							<div class="ltside">
								<div class="rtside">
									<div class="fl">

									<?php 
										if ($users['Tutor'] != null) {
											echo $users['User']['firstname'] . ' ' . $users['User']['lastname'];
											if ($users['Tutor']['id'] != null) {
												echo '<span>\'s Profile related to </span>' . $users['Tutor']['firstname'] . ' ' . $users['Tutor']['lastname'];
											} else {
												echo '<span>\'s Profile</span>';
											}
										} else {
											echo $userFullName. '<span>\'s Profile</span>';
										}
									?>
									<?php if ($users['User']['tutor_id'] == AuthComponent::user('id')) { ?>
									<div class="addjournalbtn">
										<?php echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action'=> 'edit',$users['User']['id'])); ?>
									</div>
									<?php } ?>

									</div>
									<div class="lockIcon">
										<div class="clr"></div>
									</div>
									<div class="clr"></div>
								</div>
							</div>
						</div>


						<?php if(!$objUser->isFriend($users['User']['id'])){  ?>
							<style>
								.button_right {
								    float: right;
								    margin-right: 3px;
								}
							</style>
							<div class="button_right" style="float: left; width: 100%;">
								<div class="button_right" style="padding-top: 5px;">
									
									<a class="btn btn-success addfriend" href="#" friendId="<?php echo $users['User']['id']; ?>"><i class="icon-plus icon-white"></i> Add as a Friend</a>
									
									<div id="loadin_spacer" class="spacer">&nbsp;</div>							
								</div>	
							</div>
						<?php } ?>
						
						<?php 
							if  ( ($users['User']['pusername'] != 0 && 
								( $isallowed || $users['User']['pusername'] == 2 )) || $isrelated ) { ?>
						<div class="fldline">
							<div class="profileLable">Username:</div>
							<div class="profileFld">
								<?php echo h($users['User']['username']); ?>
							</div>									
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['pfirstname'] != 0 && 
								( $isallowed || $users['User']['pfirstname'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">First Name:</div>
							<div class="profileFld">
								<?php echo h($users['User']['firstname']); ?>
							</div>									
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['plastname'] != 0 && 
								( $isallowed || $users['User']['plastname'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">Last Name:</div>
							<div class="profileFld">
								<?php echo h($users['User']['lastname']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['pemail'] != 0 && 
								( $isallowed || $users['User']['pemail'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">Email :</div>
							<div class="profileFld">
								<?php echo h($users['User']['email']); ?>
							</div>
						<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['pdob'] != 0 && 
								( $isallowed || $users['User']['pdob'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">Date of Birth :</div>
							<div class="profileFld">
								<?php echo CakeTime::format('F jS, Y ', h($users['User']['dob'])); ?>
							</div>
						<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['pgender'] != 0 && 
								( $isallowed || $users['User']['pgender'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">Gender :</div>
							<div class="profileFld">
								<?php 
									$gender = array('Not Specified','Male', 'Female'); 
									echo $gender[ $users['User']['gender'] ];	
								 ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if  ( ($users['User']['pabout_me'] != 0 && 
								( $isallowed || $users['User']['pabout_me'] == 2 )) || $isrelated )  { ?>
						<div class="fldline">
							<div class="profileLable">About Me :</div>
							<div class="profileFld">
								<?php echo h($users['User']['about_me']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if ( $users['Contact']['pbirc'] || 
								$users['Contact']['pbirr'] || 
								$users['Contact']['pbir_c'] || $isrelated ) {
						?>
						<div class="profilegryHd">Birth Place: </div>
						<?php
								if 	( ($users['Contact']['pbirc'] != 0 && 
									( $isallowed || $users['Contact']['pbirc'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Country</div>
						<div class="fldline">
							<div class="profileFld">
								<?php  echo $inf=isset($users['Contact']['BirthCountry']['name']) ? h($users['Contact']['BirthCountry']['name']) : "Not informed" ; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if ( ($users['Contact']['pbirr'] != 0 && 
								( $isallowed || $users['Contact']['pbirr'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">State:</div>
							<div class="profileFld">

								<?php echo $inf=isset($users['Contact']['BirthRegion']['region']) ? h($users['Contact']['BirthRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  } ?>
						<?php 
							if ( ($users['Contact']['pbir_c'] != 0 && 
								( $isallowed || $users['Contact']['pbir_c'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">City:</div>
							<div class="profileFld">

								<?php echo $inf=isset($users['Contact']['BirthCity']['name']) ? h($users['Contact']['BirthCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
							}
						?>
						<?php 
							if ($users['Contact']['presc'] || $users['Contact']['presr'] || 
								$users['Contact']['pres_c'] || $users['Contact']['presa'] || 
								$users['Contact']['presz']  || $isrelated) {
						?>
						<div class="profilegryHd">Residential Address: </div>
						<?php 
							if ( ($users['Contact']['presa'] != 0 && 
								( $isallowed || $users['Contact']['presa'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Address #1</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['res_address_1']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">Address #2</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['res_address_2']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['presc'] != 0 && 
								( $isallowed || $users['Contact']['presc'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Country</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResCountry']['name']) ? h($users['Contact']['ResCountry']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['presr'] != 0 && ( $isallowed || $users['Contact']['presr'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">State:</div>
							<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResRegion']['region']) ? h($users['Contact']['ResRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pres_c'] != 0 && 
								( $isallowed || $users['Contact']['pres_c'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">City:</div>
							<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResCity']['name']) ? h($users['Contact']['ResCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['presz'] != 0 && 
								( $isallowed || $users['Contact']['presz'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">Zip:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['res_zip']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
							}
						?>
						<?php 
							if ($users['Contact']['pbusc'] || $users['Contact']['pbusr'] || 
								$users['Contact']['pbus_c'] || $users['Contact']['pbusa'] || 
								$users['Contact']['pbusz'] || $isrelated) {
								if ( ($users['Contact']['pbusc'] != 0 && ( $isallowed || $users['Contact']['pbusc'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profilegryHd">Business Address: </div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pbusa'] != 0 && 
								( $isallowed || $users['Contact']['pbusa'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Address #1</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_address_1']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">Address #2</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_address_2']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pbusc'] != 0 && 
								( $isallowed || $users['Contact']['pbusc'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Country</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusCountry']['name']) ? h($users['Contact']['BusCountry']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pbusr'] != 0 && 
								( $isallowed || $users['Contact']['pbusr'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">State:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusRegion']['region']) ? h($users['Contact']['BusRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pbus_c'] != 0 && 
								( $isallowed || $users['Contact']['pbus_c'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">City:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusCity']['name']) ? h($users['Contact']['BusCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pbusz'] != 0 && 
								( $isallowed || $users['Contact']['pbusz'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">Zip:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_zip']); ?>
								</div>
							<div class="clr"></div>
						</div>
						<?php  }
							}
						?>
						
						<div class="profilegryHd">Contact No: </div>
						<?php 
							if ( ($users['Contact']['phome'] != 0 && 
								( $isallowed || $users['Contact']['phome'] == 2 ) ) || $isrelated ) {
						?>
						<div class="profileLable">Residential:</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['homephone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pmobi'] != 0 && 
								( $isallowed || $users['Contact']['pmobi'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">Mobile:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['mobilephone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						<?php 
							if ( ($users['Contact']['pwork'] != 0 && 
								( $isallowed || $users['Contact']['pwork'] == 2 ) ) || $isrelated ) {
						?>
						<div class="fldline">
							<div class="profileLable">Business:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['workphone']). " - " . h($users['Contact']['workextphone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<?php  }
						?>
						
							<?php
									
									if(count($arrObjEducation) > 0){
										?>
										<div class="profilegryHd">Education:</div>
										<div class="fldline">

										
										<?php
										foreach($arrObjEducation as $key => $value){
											echo $this->element('Educations/education_profile', array('objEducation'=>$value));
										}
										
										?>
										<div class="clr"></div>
										</div>
										<?php
									}
									
																		
									?>
	
							
						
									<?php
									
									if(count($arrObjWork) > 0){
										?>
										<div class="profilegryHd">Work:</div>
										<div class="fldline">
										
										<?php
										foreach($arrObjWork as $key => $value){
										echo $this->element('Works/work_profile', array('objWork'=>$value));
										}
										?>
										<div class="clr"></div>									
										</div>
										<?php
									}
									
									
									?>
							
					</div>
					<!--End profileform -->																													
				</div>
				
			<?php echo $this->element('profile/profile_right_column'); ?>
		</div>																								
	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->	
<script>
	$(document).ready(function() {
		
		
		$('.addfriend').click(function(){
			
			var elem = $( this );
			
				myParam = {
							friendId:$(this).attr('friendId'),
						}		
						
				$.ajax({
					async : true,
					data : myParam,
					dataType: 'json',
					success : function(ajaxReturn, textStatus) {
						
						$('#loadin_spacer').html('');
						
						if(ajaxReturn.boolError){
							
							alert('There is problem with add Friend. Call to the administrator.');
							
								
						}
						else{
							
							
							elem.parent().html ('<span friendid="1" href="#" class="btn btn-success"> The invitation has been sent.</span>')
						}
						
					},
					type : "POST",
					url : "<?php echo $this->Form->url('/users/addFriendAjax/')?>",
			        error: function(xhr,textStatus,error){
			                alert('The server can not be reached in this moment. Please, try later.');
			        },
			        beforeSend: function(){
			        	
			        	$('#loadin_spacer').html('<?php echo $this->Html->image('loading.gif');?>');

						//elem.html('<?php echo $this->Html->image('loading.gif');?>');
	    			}
				});
		});
		
	});	
	
</script>	
