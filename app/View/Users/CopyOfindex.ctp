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
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt" style="padding-top:11px;">
					<?php echo $userFullName . '\'s Profile'; ?>
					<div class="addjournalbtn">
						<?php echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action'=> 'edit')); ?>
					</div>
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
				<div class="rgtCntrleft">
					<!--Start profileform -->
					<div class="profileform">
					
					<div class="eventBox"> 
								<div class="expandable"><a href="#">
									Your Personal Information
								</a></div></div>
						
<!-- USER PROFILE -->		

<div id="dialog"  title="<?php echo __('Requesting to the server');?>">
	<p><?php echo __('The information has been requested to the server...'); ?></p>
	<br>
    <?php echo $this->Html->image('loading.gif')?>

</div>

<div class="fiedls uprofile">		
<div class="editsavebuttons">		
<div class="editbuttons uprofile">
<div class="editbutton">Edit Profile</div>  
</div>		
<div class="savebuttons uprofile">
<div class="savebutton">Save Profile</div></div>
</div>		

								<div class="borderHd">
									<div class="fl" style="padding-top:10px;">Basic Information</div>
									<div class="clr"></div>
								</div>
<div id="uprofileframe">								
<div id="uprofileListView">
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pusername']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pusername'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Username:</div>
							<div class="profileFld">
								<?php echo h($users['User']['username']); ?>
							</div>									
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pfirstname']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pfirstname'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							First Name:</div>
							<div class="profileFld">
								<?php echo h($users['User']['firstname']); ?>
							</div>									
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['plastname']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['plastname'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Last Name:</div>
							<div class="profileFld">
								<?php echo h($users['User']['lastname']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pemail']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pemail'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Email :</div>
							<div class="profileFld">
								<?php echo h($users['User']['email']); ?>
							</div>
						<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pdob']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pdob'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Date of Birth :</div>
							<div class="profileFld">

								<?php $dob = ($users['User']['dob'] == '')?'-- -- ----':CakeTime::format('F jS, Y ', h($users['User']['dob'])); ?>
								<?php echo $dob; ?>
							</div>
						<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pgender']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pgender'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Gender :</div>
							<div class="profileFld">
								<?php 
									$gender = array('Not Specified', 'Male', 'Female'); 
									echo $gender[ $users['User']['gender'] ];	
								 ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['User']['pabout_me']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['User']['pabout_me'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							About Me :</div>
							<div class="profileFld">
								<?php echo h($users['User']['about_me']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profilegryHd">Birth Place: </div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbirc']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbirc'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Country
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php  echo $inf=isset($users['Contact']['BirthCountry']['name']) ? h($users['Contact']['BirthCountry']['name']) : "Not informed" ; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbirr']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbirr'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							State:
							</div>
							<div class="profileFld">

								<?php echo $inf=isset($users['Contact']['BirthRegion']['region']) ? h($users['Contact']['BirthRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbir_c']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbir_c'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							City:
							</div>
							<div class="profileFld">

								<?php echo $inf=isset($users['Contact']['BirthCity']['name']) ? h($users['Contact']['BirthCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profilegryHd">Residential Address: </div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['presa']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['presa'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Address #1
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['res_address_1']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['presa']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['presa'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Address #2
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['res_address_2']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['presc']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['presc'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Country
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResCountry']['name']) ? h($users['Contact']['ResCountry']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['presr']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['presr'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							State:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResRegion']['region']) ? h($users['Contact']['ResRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pres_c']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pres_c'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							City:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['ResCity']['name']) ? h($users['Contact']['ResCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['presz']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['presz'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Zip:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['res_zip']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profilegryHd">Business Address: </div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbusa']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbusa'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Address #1
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_address_1']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbusa']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbusa'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Address #2
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_address_2']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbusc']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbusc'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Country
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusCountry']['name']) ? h($users['Contact']['BusCountry']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbusr']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbusr'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							State:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusRegion']['region']) ? h($users['Contact']['BusRegion']['region']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbus_c']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbus_c'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							City:</div>
							<div class="profileFld">
								<?php echo $inf=isset($users['Contact']['BusCity']['name']) ? h($users['Contact']['BusCity']['name']) : "Not informed"; ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pbusz']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pbusz'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Zip:
							</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['bus_zip']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="profilegryHd">Contact No: </div>
						<div class="profileLable">
							<?php 
								if (!$users['Contact']['phome']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['phome'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
						Residential:
						</div>
						<div class="fldline">
							<div class="profileFld">
								<?php echo h($users['Contact']['homephone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pmobi']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pmobi'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Mobile:</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['mobilephone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<div class="fldline">
							<div class="profileLable">
							<?php 
								if (!$users['Contact']['pwork']) echo $this->Html->image('P.jpg');
								else echo $this->Html->image($cl_i = ($users['Contact']['pwork'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
							?> 
							Work:
							</div>
							<div class="profileFld">
								<?php echo h($users['Contact']['workphone']). " - " . h($users['Contact']['workextphone']); ?>
							</div>
							<div class="clr"></div>
						</div>
						<!-- End uprofile view -->
						</div>							
								
								
<<<<<<< Updated upstream
						<div id="uprofileEditBox">
=======
<div id="uprofileEditBox">
<!-- FORM TESTING -->
<?php echo $this->element('users/useredit'); ?>
<!-- END FORM TESTING -->
>>>>>>> Stashed changes
								<?php echo $this->Form->create('User'); ?>
								<div class="uprofileEditBox">
								<div class="fldline">
									<div class="profileLable">Username:</div>
									<div class="profileFld">
										<?php 
											echo $this->Form->input('User.id', array('type'=>'hidden'));
											echo $this->Form->input('Contact.id', array('type'=>'hidden'));
											echo $this->Form->input('User.username', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('pusername', 
													array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
													 
														array('legend' => false,'value'=>$user['User']['pusername']));
										?>
									
									</div>									
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">First Name:</div>
									<div class="profileFld">
										<?php 
											echo $this->Form->input('User.firstname', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
											echo ' '.$this->Form->radio('pfirstname', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['pfirstname']));
										
										?>
									</div>									
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Last Name:</div>
									<div class="profileFld">
										<?php 
											echo $this->Form->input('User.lastname', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('plastname', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['plastname']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Email :</div>
									<div class="profileFld">
										<?php echo $this->Form->input('User.email', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('pemail', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['pemail']));
										?>
										<div id="emailerror">The email is required.</div>
																			</div>
																			
								<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Date of Birth :</div>
									<div class="profileFld">
										<?php echo $this->Form->input('User.dob', array(
													'div'=>false,
													'label'=>false,
													'minYear'=>date('Y')-16, 
													'maxYear'=>date('Y')-301+1, 
													'empty'=>array('--'),
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('pdob', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['pdob']));
										?>
									</div>
								<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Gender :</div>
									<div class="profileFld">
										<?php 
											echo $this->Form->input('User.gender', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'type' => 'select',
			             							'options' => array(
			             								'0'=>'Not Specified',
			             								'1'=>'Male',
			             								'2'=>'Female' 
			             								))); 
											echo ' '.$this->Form->radio('pgender', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['pgender']));
			             								?>
												
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">About Me :</div>
									<div class="profileFld">
										<?php echo $this->Form->input('User.about_me', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileTxtA',
													'type'=> 'textarea',
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('pabout_me', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['User']['pabout_me']));
										?>
																			</div>
									<div class="clr"></div>
								</div>
								<div class="profilegryHd">Birth Place: </div>
								<div class="profileLable">Country</div>
								<div class="fldline">
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.birth_country_id', array(
													'div'=>false,
													'label'=>false,
													'class'=>'profileSlct',
													'onblur'=>'replaceText(this)',
													'default'=>$this->data['Contact']['birth_country_id'],
													'empty'=>'Select one'));
											echo ' '.$this->Form->radio('Contact.pbirc', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbirc']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">State:</div>
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.birth_region_id', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'empty'=>'Select one')); 
											echo ' '.$this->Form->radio('Contact.pbirr', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbirr']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">City:</div>
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.birth_city_id', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'empty'=>'Select one'));
											echo ' '.$this->Form->radio('Contact.pbir_c', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbir_c']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="profilegryHd">Residential Address: </div>
								<div class="profileLable">Address #1</div>
								<div class="fldline">
									<div class="profileFld">
										<?php 
										echo $this->Form->input('Contact.res_address_1', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
										echo ' '.$this->Form->radio('Contact.presa', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['presa']));
										?>


									</div>
									<div class="clr"></div>
								</div>
								<div class="profileLable">Address #2</div>
								<div class="fldline">
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.res_address_2', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
										?>

										
									</div>
									<div class="clr"></div>
								</div>
								<div class="profileLable">Country</div>
								<div class="fldline">
									<div class="profileFld">
										<?php
											echo $this->Form->input('Contact.id', array('type'=>'hidden'));
												echo $this->Form->input('Contact.res_country_id', array(
													'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileSlct',
													'default'=>$this->data['Contact']['res_country_id'], 
													'empty'=>'Select one'
													));
											echo ' '.$this->Form->radio('Contact.presc', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['presc']));
													?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">State:</div>
									<div class="profileFld">
										<?php
								 			echo $this->Form->input('Contact.res_region_id', array(
								 					'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileSlct',
													'empty'=>'Select one'
								 				)); 
											echo ' '.$this->Form->radio('Contact.presr', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['presr']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">City:</div>
									<div class="profileFld">
										<?php
								 			echo $this->Form->input('Contact.res_city_id', array(
								 					'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileSlct',
													'empty'=>'Select one'
								 				)); 
											echo ' '.$this->Form->radio('Contact.pres_c', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pres_c']));
								 				?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Zip:</div>
									<div class="profileFld">
										<?php
								 			echo $this->Form->input('Contact.res_zip', array(
								 					'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileInpt'
								 				)); 
											echo ' '.$this->Form->radio('Contact.presz', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['presz']));
								 				?>
										</div>
									<div class="clr"></div>
								</div>
								<div class="profilegryHd">Business Address: </div>
								<div class="profileLable">Address #1</div>
								<div class="fldline">
									<div class="profileFld">
									
										<?php echo $this->Form->input('Contact.bus_address_1', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
											echo ' '.$this->Form->radio('Contact.pbusa', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbusa']));
										
										?>

									</div>
									<div class="clr"></div>
								</div>
								<div class="profileLable">Address #2</div>
								<div class="fldline">
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.bus_address_2', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="profileLable">Country</div>
								<div class="fldline">
									<div class="profileFld">

										<?php echo $this->Form->input('Contact.bus_country_id', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'default'=>$this->data['Contact']['bus_country_id'],
													'empty'=>'Select one')); 
											echo ' '.$this->Form->radio('Contact.pbusc', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbusc']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">State:</div>
									<div class="profileFld">

										<?php echo $this->Form->input('Contact.bus_region_id', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'default'=>$this->data['Contact']['bus_region_id'],
													'empty'=>'Select one')); 
											echo ' '.$this->Form->radio('Contact.pbusr', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbusr']));
										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">City:</div>
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.bus_city_id', array(
													'div'=>false,
													'label'=>false,
													'class'=>'profileSlct',
													'default'=>$this->data['Contact']['bus_city_id'],
													'empty'=>'Select one'
												)); 
											echo ' '.$this->Form->radio('Contact.pbus_c', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbus_c']));
											?>								
									</div>

									<div class="clr"></div>
								</div>
							
								<div class="fldline">
									<div class="profileLable">Zip:</div>
									<div class="profileFld">
										<?php
								 			echo $this->Form->input('Contact.bus_zip', array(
								 					'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileInpt'
								 				)); 
											echo ' '.$this->Form->radio('Contact.pbusz', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbusz']));
										?>
									</div>
									<div class="clr"></div>
									</div>
								<div class="profilegryHd">Contact No: </div>
								<div class="profileLable">Residential:</div>
								<div class="fldline">
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.homephone', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
											echo ' '.$this->Form->radio('Contact.phome', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['phome']));

										?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Mobile:</div>
									<div class="profileFld">
										<?php echo $this->Form->input('Contact.mobilephone', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)'));
										
											echo ' '.$this->Form->radio('Contact.pmobi', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pmobi']));
										 ?>
									</div>
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">Business:</div>
									<div class="profileFld">
										<?php 
											echo $this->Form->input('Contact.workphone', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInptwp',
													'onblur'=>'replaceText(this)'));
											echo " - ";
											echo $this->Form->input('Contact.workextphone', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInptwep',
													'onblur'=>'replaceText(this)'));
											echo ' '.$this->Form->radio('Contact.pwork', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pwork']));
											?>

										
									</div>
									<div class="clr"></div>
								</div>
								<!-- end uprofileEditBox -->
								</div>
								<?php echo $this->Form->end(); ?>
</div>				
			
								
<<<<<<< Updated upstream
<script type="text/javascript">



											
//SCRIPT UPROFILE
var serverPath = "<?php echo $this->webroot; ?>";

	$('#dialog').hide();

	$('.savebuttons').hide();

	$('.uprofileEditBox').hide();

	$('#emailerror').hide();

	$("#UserUsername").attr("disabled",true); 

	//This is launched when the Ajax starts
	$('#dialog').ajaxStart(function() {
	  $(this).dialog();
	});
	//This is launched when the Ajax ends
	$('#dialog').ajaxStop(function() {
		  $(this).dialog('close');
		});
												
	// Uprofile
	$('.editbutton').click(function(){

		//Hide and show the education edit and view
		$('.uprofileEditBox, #uprofileListView').fadeToggle('slow');

		var text = $( this ).text();

	    $( this ).text(
	        text == "Edit Profile" ? "View Profile" : "Edit Profile");

        $('.savebuttons').fadeToggle('slow');
		
	});


	//Save User Profile through AJAX
	
	$('.savebutton').click(function(){ 

		//TODO: Validate email
		

		var emailval = $('#UserEmail').val();

		if(emailval.trim() == '' ){

			$('#emailerror').show();
			return false;
		}
		else{

			$('#emailerror').hide();
		}
		
		var formData = $(".uprofileEditBox :input").serialize();

		var formUrl = serverPath+'Users/editAjax';

		    $.ajax({
		    type: 'POST',
		    url: formUrl,
		    data: formData,
		    success: function(dataRETURN,textStatus,xhr){

                // refresh user profile //
                $.ajax({
                    type: 'POST',
                    url: serverPath+'users/getProfileView',
                    success: function(dataHTML,textStatus,xhr){

                    	$('#uprofileListView').empty();
                    	$('#uprofileListView').append(dataHTML);

                    	//Once saved the User Profile, it returns to the View
                    	$('.uprofileEditBox, #uprofileListView').fadeToggle('slow');
                    	$('.savebuttons').fadeToggle('slow');
                		var text = $('.editbutton').text();

                		$('.editbutton').text(
                	        text == "Edit Profile" ? "View Profile" : "Edit Profile");
                                    	
                        }
                    });
		            
	            
		    },
		    error: function(xhr,textStatus,error){

		            alert('The server can not be reached in this moment. Please, try later.');
		    }
		}); 
		
		
		});
	
	//END Save User Profile through AJAX
	

</script>	
		

<?php
//testing with the form
/*
$uprofiledata = $this->Js->get('#UserIndexForm')->serializeForm(array('isForm' => true,'inline' => true));

echo 'before ajax. '.$uprofiledata; 
$this->Js->get('#formsubitteduprofile')->event('click', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getEditAjax'
		), array(
		'update'=>'#uprofileframe',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $uprofiledata
		))
	);
	*/
?>

											
=======
>>>>>>> Stashed changes
<?php
$this->Js->get('#ContactBirthCountryId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByBirthRegion'
		), array(
		'update'=>'#ContactBirthRegionId',
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
$this->Js->get('#ContactBirthRegionId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByBirthCity'
		), array(
		'update'=>'#ContactBirthCityId',
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
$this->Js->get('#ContactResCountryId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByResRegion'
		), array(
		'update'=>'#ContactResRegionId',
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
$this->Js->get('#ContactResRegionId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByResCity'
		), array(
		'update'=>'#ContactResCityId',
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
$this->Js->get('#ContactBusCountryId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByBusRegion'
		), array(
		'update'=>'#ContactBusRegionId',
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
$this->Js->get('#ContactBusRegionId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByBusCity'
		), array(
		'update'=>'#ContactBusCityId',
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
// Populate the Education level element //
$this->Js->get('#EducationLevelId')->event('change', 
	$this->Js->request(array(
		'controller'=>'users',
		'action'=>'getByBirthRegion'
		), array(
		'update'=>'#EducationLevelId',
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
</div>
</div>																					
<!-- END USER PROFILE -->						
						
						
						
					<div class="eventBox"> 
								<div class="expandable"><a href="#">
									Education
								</a></div></div>
						
<<<<<<< Updated upstream
<div class="fiedls education">
<div class="editsavebuttons">	
<div class="editbuttons education"><div class="editbutton">Edit Education</div> </div></div>
<div class="educationEditBox">
<div id="educationList">
<!-- Education List -->
<?php if(count($educations) > 0){ ?>
<div class="educations index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Education Level');?></th>
			<th><?php echo __('Institute');?></th>
			<th><?php echo __('Start');?></th>
			<th><?php echo __('End');?></th>
			<th><?php echo __('Description');?></th>
			
			<th><?php echo __('Access');?></th>

			<th class="actions"><?php echo __('Actions');?></th>
	</tr>

	<?php
	
	foreach ($educations as $education): ?>
	<tr id="educationrow_<?php echo $education['Education']['id']; ?>" >

		<td class="edulevel" >
			<?php echo h($education['Edulevel']['name']); ?>
		
			<?php echo $this->Form->hidden('eduleveid_'.$education['Education']['id'],array('id'=>'eduleveid_'.$education['Education']['id'],'value'=>$education['Edulevel']['id']))?>
		</td>
		<td class="institute" >
			<?php echo h($education['Institute']['name']); ?>
			<?php echo $this->Form->hidden('instituteid_'.$education['Education']['id'],array('id'=>'instituteid_'.$education['Education']['id'],'value'=>$education['Institute']['name']))?>
		</td>
		<td class="startdate" >
			<?php echo h($education['Education']['start_date']); ?>&nbsp;
			<?php echo $this->Form->hidden('startdate_'.$education['Education']['id'],array('id'=>'startdate_'.$education['Education']['id'],'value'=>$education['Education']['start_date']))?>
		</td>
		<td  class="enddate">
			<?php $labeldate = empty($education['Education']['end_date'])? 'Present': $education['Education']['end_date']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($education['Education']['end_date'])? 'End Date':$education['Education']['end_date'];
			?>
			<?php echo $this->Form->hidden('enddate_'.$education['Education']['id'],array('id'=>'enddate_'.$education['Education']['id'],'value'=>$endDate))?>	
		</td>
		<td class="description">
			<?php echo h($education['Education']['description']); ?>&nbsp;
			<?php echo $this->Form->hidden('description_'.$education['Education']['id'],array('id'=>'description_'.$education['Education']['id'],'value'=>$education['Education']['description']))?>
		</td>

		<td class="perm">
		
		
		<?php 
			if (!$education['Education']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($education['Education']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
		?> 
		<?php echo $this->Form->hidden('perm_'.$education['Education']['id'],array('id'=>'perm_'.$education['Education']['id'],'value'=>$education['Education']['perm']))?>
		</td>


		<td class="actions">
			<div class="eduedit" id="eduid_<?php echo $education['Education']['id']; ?>"><?php echo __('Edit'); ?></div>
			<div class="deleteit" id="eduid_<?php echo $education['Education']['id']; ?>"><?php echo __('Delete'); ?></div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
<!-- END Education List -->		
</div>
		<div id="educationEditBoxInput" >	
		<?php 

		echo $this->Form->hidden('Education.user_id',array('value'=>$education_id));
		

		echo ' '.$this->Form->radio('Education.perm', 
			array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
			array('legend' => false,'value'=>0, 'id'=>'educationperm', 'class'=>'classeducationperm'));
		
		
		echo $this->Form->hidden('Education.id',array('id'=>'educationid','value'=>null));
		
		echo $this->Form->input('Education.edulevel_id', array(
													'div'=>true,
													'label'=>'Education Level',
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'empty'=>'Select one'));
		echo '<div class="diverrors" id="error_edulevel" >&#42; '.__('The Education level should be entered').'</div>';
		
		echo $this->Form->input('Education.instituteid', array(
																	'class'=>'popinpt1',
																	'div'=> true,
																	'label'=> 'Institute',
																	'empty'=> 'Enter the name',
																	'id'=>'EducationInstituteId')); 
		echo '<div class="diverrors" id="error_institute" >&#42; '.__('The Insitute should be entered').'</div>';
		
		
		echo $this->Form->input('Education.description');
		
		echo $this->Form->input('Education.start_date', array(
								'dateFormat'	=> 'yy-mm-dd',
								'type' 			=> 'text',
								'id'			=> 'startdatepicker',
								'label'			=> false,
								'class'			=> 'popinptdate',
								'minYear'		=> date('Y') -300,
								'maxYear'		=> date('Y') -13
								));

								echo '<div class="diverrors" id="error_start_date" >&#42; '.__('The Start Date should be entered').'</div>';
		echo '<div class="diverrors" id="error_start_date" >&#42; '.__('The Start Date should be smaller than the End Date').'</div>';
		
		echo $this->Form->input('Education.end_date', array(
								'dateFormat'	=> 'yy-mm-dd',
								'type' 			=> 'text',
								'id'			=> 'enddatepicker',
								'label'			=> false,
								'class'			=> 'popinptdate',
								'minYear'		=> date('Y') -300,
								'maxYear'		=> date('Y') -13
								));
								
		echo '<div class="diverrors" id="error_end_date" >&#42; '.__('The End Date should be entered').'</div>';
		
		echo $this->Form->button('Add Education', array('type'=>'button','id'=>'educationSendButton'));
		
		echo $this->Form->button('Reset Form', array('type'=>'button','id'=>'educationResetButton'));

		
		?>
										<script type="text/javascript">
										var institutes
											$(function() {
												institutes = [
												<?php
													foreach ($institutes as $id=>$elem) {
														print("\"$elem\",");
													}
													print("\" \"");
 												?>
												];
												$( "#EducationInstituteId" ).autocomplete({
													source: institutes
												});
											});
										</script>		

		</div>
<div id="dialog" title="Basic dialog" >
	<p>The information has been requested to the server...</p>
</div>
<div class="diverrors" id="deleteDialog" >Are you sure you want to delete this?</div>
<div class="diverrors" id="educationSubmitDialog" >The Education and/or Employment form hasn't been saved.<br>Do you want to ignore it?</div>
<script type="text/javascript">

//Catch submit form if the Education form is not empty //

$('#submitbutton').live('click', function(){

	if(!validationSubmit()){
		$('#educationSubmitDialog').dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Yes": function() {
	
					$('#UserEditForm').submit();
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
	
		});
	}
	else{

		$('#UserEditForm').submit();

		}
	
});

$('#submitedimage').live('click', function(){

	if(!validationSubmit()){
		$('#educationSubmitDialog').dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Yes": function() {
	
					$('#UserEditForm').submit();
					
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
	
		});
	}
	else{

		$('#UserEditForm').submit();

		}
	
});
//END Catch submit form if the Education form is not empty //

//Server Path
var serverPath = <?php echo $this->webroot; ?>

if(serverPath == null){ serverPath = ''; }

// Education form reset //
function educationFormReset(){

	$('#EducationEdulevelId').val(null);

	$('#EducationInstituteId').val('Enter the name');
	
	$('#EducationDescription').val("");

	//Set Start Date
	$( "#startdatepicker" ).val("Start Date");

	//Set End Date
	$( "#enddatepicker" ).val("End Date");

	//Set education
	$('.classeducationperm[value=0]').attr('checked', true);

	//Set Education.id
	$('#educationid').val(null);

	$('#educationSendButton').html('Add Education');

	$('.diverrors').hide();
}

// END Education form reset //

// Education & Employment Ajax Submit Validation//
// This validate if the Education & Employment form is not empty //
// When the user submit the form if the Education or Employment form is not empty a dialog is launched to ask the user is they
// wants to continue editing/adding the Education or Employment form or if they want to ignores it
function validationSubmit(){

	var validation = true;
	
	if(!($('#EducationEdulevelId').val() === '') || !($('#EducationInstituteId').val() === '' || $('#EducationInstituteId').val() === 'Enter the name') 
			|| !($('#startdatepicker').val() == '' || $('#startdatepicker').val() === "Start Date") 
			|| !($('#enddatepicker').val() == '' || $('#enddatepicker').val() === "End Date")
			 ){

		validation = false;
	} 


	if(!($('#WorkWorkplaceId').val() === '' || $('#WorkWorkplaceId').val() === 'Enter the name') || !($('#SpecialtyId').val() === '' || $('#SpecialtyId').val() === 'Enter the name') 
			|| !($('#wstartdatepicker').val() == '' || $('#wstartdatepicker').val() === "Start Date") 
			|| !($('#wenddatepicker').val() == '' || $('#wenddatepicker').val() === "End Date")
			 ){

		validation = false;
	} 

	return validation;
}
//Education Ajax Submit Validation//

// Education Ajax Submit Validation//
function validation(){

	var validation = true;
	
	if($('#EducationEdulevelId').val() === ''){

		$('#error_edulevel').show();

		validation = false;
		
	} 

	if($('#EducationInstituteId').val() === '' || $('#EducationInstituteId').val() === 'Enter the name'){

		$('#error_institute').show();

		validation = false;
	} 
	
	
	if($('#startdatepicker').val() == '' || $('#startdatepicker').val() === "Start Date"){

		$('#error_start_date').show();

		validation = false;
	} 

	//Comparing Dates//
	if($('#enddatepicker').val() != ''  || $('#enddatepicker').val() === "End Date" )
	if($('#startdatepicker').val() > $('#enddatepicker').val()){

			$('#error_start_date').show();

			validation = false;
		}

	return validation;
}
//Education Ajax Submit Validation//


// Delete a Education item//
// This launches a dialog to confirm the User request//
$('.deleteit').live("click", function(){

	var eduid = $( this ).attr('id').split('_');

	$('#educationid').val(eduid[1]);

	$("#deleteDialog").dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Yes": function() {
				var formData = $("#educationid").serialize();
				$( this ).dialog( "close" );

				$.ajax({
					type: 'POST',
					url: serverPath+'Educations/deleteAjax',
					data: formData,
					success: function(dataHTML,textStatus,xhr){ 
	                    /* refresh educationListg */
	                    $.ajax({
	                        type: 'POST',
	                        url: serverPath+'users/getEducationList',
	                        success: function(dataHTML,textStatus,xhr){

	                        	$('#educationList').empty();
	                        	$('#educationList').append(dataHTML);
	                            }
	                        });

		                    /* refresh educationListView */
		                    $.ajax({
		                        type: 'POST',
		                        url: serverPath+'users/getEducationView',
		                        success: function(dataHTML2,textStatus,xhr){
	
		                        	$('#educationListView').empty();
		                        	$('#educationListView').append(dataHTML2);
		                        	
		                        	educationFormReset();
		                            },
		                        error: function(xhr,textStatus,error){ alert("The server can not be reached in this moment. Please, try later."); }
		                        });
	                        
						},

		            error: function(xhr,textStatus,error){

		            	alert('The server can not be reached in this moment. Please, try later.');
	            	}
				
					});

			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});	
	
});

// END Delete a Education item //

//Editing a Education item//

$('.eduedit').live("click", function(){

	//Showing the Reset button //
	$('#educationResetButton').show();

	$('#educationSendButton').html('Update Education');

	//Hidding the error messages when the page is loaded //
	$('.diverrors').hide();

	var eduid = $(this).attr('id').split('_');

	//Set the perm
	$('.classeducationperm[value="'+$('#perm_'+eduid[1]).val()+'"]').attr('checked', true);

	$('#EducationEdulevelId').val($('#eduleveid_'+eduid[1]).val());

	
	$('#EducationInstituteId').val($('#instituteid_'+eduid[1]).val());
	//$('#EducationInstituteId').val($('#instituteid_'+eduid[1]).val());

	
	$('#EducationDescription').val($('#description_'+eduid[1]).val());

	var startDate = $('#startdate_'+eduid[1]).val().split('-');
	var endDate = $('#enddate_'+eduid[1]).val().split('-');

	//Set Start Date
	$('#startdatepicker').val($('#startdate_'+eduid[1]).val());

	//Set End Date
	$('#enddatepicker').val($('#enddate_'+eduid[1]).val());

	//Set Education.id
	$('#educationid').val(eduid[1]);
	
});
//END Editing a Education item//


$(function(){
	//setting the Date controls: start and end //
	//Startdate
	$( "#startdatepicker" ).datepicker({ altFormat: "yy-mm-dd" });
	$( "#startdatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#startdatepicker" ).datepicker( "option", "maxDate", new Date() );

	//Enddate
	$( "#enddatepicker" ).datepicker({ altFormat: "yy-mm-dd" });
	$( "#enddatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#enddatepicker" ).datepicker( "option", "maxDate", new Date() );

	//Startdate
	$( "#wstartdatepicker" ).datepicker({ altFormat: "yy-mm-dd" });
	$( "#wstartdatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#wstartdatepicker" ).datepicker( "option", "maxDate", new Date() );

	//Enddate
	$( "#wenddatepicker" ).datepicker({ altFormat: "yy-mm-dd" });
	$( "#wenddatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#wenddatepicker" ).datepicker( "option", "maxDate", new Date() );
	
	
});
	
//This is the Modal dialog, it's used when the ajax is working
$('#dialog').hide();
$('#deleteDialog').hide();

//This is launched when the Ajax starts
$('#dialog').ajaxStart(function() {
  $(this).dialog();
});
//This is launched when the Ajax ends
$('#dialog').ajaxStop(function() {
	  $(this).dialog('close');
	});

//This reset the education form when the Reset button is clicked
$('#educationResetButton').click(function(){

	educationFormReset();	

});

//This reset the default text with the Institute is on focus//
$('#EducationInstituteId').focus(function(){

	if($( this ).val() === 'Enter the name'){

		$( this ).val(null);
	}
	
});

//This is for Add and Edit 
$(document).ready(function () {

	//Hidding the error messages when the page is loaded //
	$('.diverrors').hide();

	//Hidding the error messages //
	$("#educationEditBoxInput :input").change(function(){  $('.diverrors').hide();});

	//Reset the Education Form//
	educationFormReset();

});

//This launches the EducationAddAjax: add a new education row
//the EducationList: refresh the education list
$('#educationSendButton').click(function(){

	if(!validation()){

		return false;
    	}

	if($('#enddatepicker').val() === 'End Date'){ $('#enddatepicker').val('');}
    //serialize form data
    var formData = $("#educationEditBoxInput :input").serialize();

    var userId = $('#EducationUserId').val();

    var formUrl = serverPath+'Educations/addEditAjax';
=======
>>>>>>> Stashed changes

					<div class="eventBox"> 
								<div class="expandable"><a href="#">
									Employment
								</a></div></div>

<<<<<<< Updated upstream
<div class="fiedls employment">
<div class="editsavebuttons">	
<div class="editbuttons employment"><div class="editbutton">Edit Employment</div> </div></div>

<div class ="employmentEditBox">
<div id="employmentList">

<?php if(count($works) > 0){ ?>
<div class="educations index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Specialty');?></th>
			<th><?php echo __('Workplace');?></th>
			<th><?php echo __('Start');?></th>
			<th><?php echo __('End');?></th>
			<th><?php echo __('Location');?></th>
			
			<th><?php echo __('Access');?></th>

			<th class="actions"><?php echo __('Actions');?></th>
	</tr>

	<?php
	
	foreach ($works as $work): ?>
	<tr id="workrow_<?php echo $work['Work']['id']; ?>" >

		<td class="specialty" >
			<?php echo h($work['Specialty']['name']); ?>
		
			<?php echo $this->Form->hidden('specaltyid_'.$work['Work']['id'],array('id'=>'specialtyid_'.$work['Work']['id'],'value'=>$work['Specialty']['name']))?>
		</td>
		<td class="workplace" >
			<?php echo h($work['Workplace']['name']); ?>
			<?php echo $this->Form->hidden('workplaceid_'.$work['Work']['id'],array('id'=>'workplaceid_'.$work['Work']['id'],'value'=>$work['Workplace']['name']))?>
		</td>
		<td class="startdate" >
			<?php echo h($work['Work']['start_date']); ?>&nbsp;
			<?php echo $this->Form->hidden('startdate_'.$work['Work']['id'],array('id'=>'wstartdate_'.$work['Work']['id'],'value'=>$work['Work']['start_date']))?>
		</td>
		<td  class="enddate"">
			<?php $labeldate = empty($education['Education']['end_date'])? 'Present': $education['Education']['end_date']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($work['Work']['end_date'])? 'End Date':$work['Work']['end_date'];
			?>
			<?php echo $this->Form->hidden('enddate_'.$work['Work']['id'],array('id'=>'wenddate_'.$work['Work']['id'],'value'=>$endDate))?>	
		</td>
		<td class="description">
			<?php echo h($work['Work']['location']); ?>&nbsp;
			<?php echo $this->Form->hidden('location_'.$work['Work']['id'],array('id'=>'wlocation_'.$work['Work']['id'],'value'=>$work['Work']['location']))?>
			<?php echo $this->Form->hidden('description_'.$work['Work']['id'],array('id'=>'wdescription_'.$work['Work']['id'],'value'=>$work['Work']['description']))?>
		</td>

		<td class="perm">
		
		
		<?php 
		
			if (!$work['Work']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($work['Work']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')); 
		 
		 	echo $this->Form->hidden('wperm_'.$work['Work']['id'],array('id'=>'perm_'.$work['Work']['id'],'value'=>$work['Work']['perm']));
		
		 ?>
		</td>


		<td class="actions">
			<div class="employmentit" id="workid_<?php echo $work['Work']['id']; ?>"><?php echo __('Edit'); ?></div>
			<div class="wdeleteit" id="deleteworkid_<?php echo $work['Work']['id']; ?>"><?php echo __('Delete'); ?></div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
</div>			

<div id="employmentEditBoxInput" >	
		<?php 
		
		echo $this->Form->hidden('Work.user_id',array('value'=>$work_id));
		

		echo ' '.$this->Form->radio('Work.perm', 
			array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
			array('legend' => false,'value'=>0, 'id'=>'employmentperm', 'class'=>'classemploymentperm'));
		
		
		echo $this->Form->hidden('Work.id',array('id'=>'employmentid','value'=>null));
		
		echo $this->Form->input('Work.specialtyid', array(
													'class'=>'popinpt1',
													'div'=> true,
													'label'=> 'Specialty',
													'empty'=> 'Enter the name',
													'id'=>'SpecialtyId')); 
		
		
		echo '<div class="wdiverrors" id="werror_specialty" >&#42; '.__('The Education level should be entered').'</div>';
		
		echo $this->Form->input('Work.workplaceid', array(
																	'class'=>'popinpt1',
																	'div'=> true,
																	'label'=> 'Workplace',
																	'empty'=> 'Enter the name',
																	'id'=>'WorkWorkplaceId')); 
		echo '<div class="wdiverrors" id="werror_institute" >&#42; '.__('The Insitute should be entered').'</div>';
?>		
								<div class="popformLine">
									<div class="poplabel">Location <span class="mendatorytxt">*</span></div>
									<div class="popfilds">
										<?php 
										
										echo $this->Form->input('Work.location', array(
																'class'=>'popinpt1',
																'div'=> false,
																'label'=> false,
																'id'=>'wlocation'
																)); 
										 ?>
									</div>
										<script type="text/javascript">
											$(function() {
												var cities = [
												<?php
													foreach ($cities as $id=>$elem) {
														print("\"$elem\",");
													}
													print("\" \"");
 												?>
												];
												$( "#wlocation" ).autocomplete({
													source: cities,
													minLength: 2
												});
											});
										</script>
								
									<div class="clr"></div>
								</div>
<?php 		
		echo $this->Form->input('Work.description');
		
		echo $this->Form->input('Work.start_date', array(
								'dateFormat'	=> 'yy-mm-dd',
								'type' 			=> 'text',
								'id'			=> 'wstartdatepicker',
								'label'			=> false,
								'class'			=> 'popinptdate',
								'minYear'		=> date('Y') -300,
								'maxYear'		=> date('Y') -13
								));

		echo '<div class="wdiverrors" id="werror_start_date" >&#42; '.__('The Start Date should be entered').'</div>';
		echo '<div class="wdiverrors" id="werror_start_date" >&#42; '.__('The Start Date should be smaller than the End Date').'</div>';
		
		echo $this->Form->input('Work.end_date', array(
								'dateFormat'	=> 'yy-mm-dd',
								'type' 			=> 'text',
								'id'			=> 'wenddatepicker',
								'label'			=> false,
								'class'			=> 'popinptdate',
								'minYear'		=> date('Y') -300,
								'maxYear'		=> date('Y') -13
								));
								
								

		echo '<div class="wdiverrors" id="werror_end_date" >&#42; '.__('The End Date should be entered').'</div>';
		
		echo $this->Form->button('Add Employment', array('type'=>'button','id'=>'employmentSendButton'));
		
		echo $this->Form->button('Reset Form', array('type'=>'button','id'=>'employmentResetButton'));
		
		?>
										<script type="text/javascript">
										var specialities
											$(function() {
												specialities = [
												<?php
													foreach ($specialities as $id=>$elem) {
														print("\"$elem\",");
													}
													print("\" \"");
 												?>
												];
												$( "#SpecialtyId" ).autocomplete({
													source: specialities
												});
											});

										var workplaces
										$(function() {
											workplaces = [
											<?php
												foreach ($workplaces as $id=>$elem) {
													print("\"$elem\",");
												}
												print("\" \"");
												?>
											];
											$( "#WorkWorkplaceId" ).autocomplete({
												source: workplaces
											});
										});
										
										
										</script>		

		</div>
		
		<script type="text/javascript">


//This reset the default text with the Specialty is on focus//
$('#SpecialtyId').focus(function(){

	if($( this ).val() === 'Enter the name'){

		$( this ).val(null);
	}
	
});

//This reset the default text with the Specialty is on focus//
$('#WorkWorkplaceId').focus(function(){

	if($( this ).val() === 'Enter the name'){

		$( this ).val(null);
	}
	
});

//This reset the default text with the Location is on focus//
$('#wlocation').focus(function(){

	if($( this ).val() === 'Enter location'){

		$( this ).val(null);
	}
	
});

//Employment Ajax  Validation//
function wvalidation(){

	var validation = true;
	
	if($('#SpecialtyId').val() === '' || $('#SpecialtyId').val() === 'Enter the name'){

		$('#werror_specialty').show();

		validation = false;
	} 

	if($('#WorkWorkplaceId').val() === '' || $('#WorkWorkplaceId').val() === 'Enter the name'){

		$('#werror_institute').show();

		validation = false;
	} 
	
	
	if($('#wstartdatepicker').val() == '' || $('#wstartdatepicker').val() === "Start Date"){

		$('#werror_start_date').show();

		validation = false;
	} 

	//Comparing Dates//
	if($('#wenddatepicker').val() != ''  || $('#wenddatepicker').val() === "End Date" )
	if($('#wstartdatepicker').val() > $('#wenddatepicker').val()){

			$('#werror_start_date').show();

			validation = false;
		}

	return validation;
}
//END Employment Ajax Submit Validation//

//Delete a Employment item//
//This launches a dialog to confirm the User request//
$('.wdeleteit').live("click", function(){

	var workid = $( this ).attr('id').split('_');

	$('#employmentid').val(workid[1]);

	$("#deleteDialog").dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Yes": function() {
				var formData = $("#employmentid").serialize();
				$( this ).dialog( "close" );

				$.ajax({
					type: 'POST',
					url: serverPath+'Works/deleteAjax',
					data: formData,
					success: function(dataHTML,textStatus,xhr){ 
=======
>>>>>>> Stashed changes

							<div class="clr"></div>									
						</div>
					</div>
					<?php echo $this->element('profile/profile_right_column_2'); ?>	
					<!--End profileform -->																													
				</div>
				
				
		</div>																								

	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->	
<<<<<<< Updated upstream
<script type="text/javascript">


// Loading the functions and behaviours //
$(function(){

	//Hide the Education Edit
	$('.educationEditBox').hide();

	// Education
	$('.editbuttons.education').click(function(){

		//Hide and show the education edit and view
		$('.educationEditBox, #educationListView').slideToggle('slow');

		var text = $( this ).text();
	    $( this ).text(
	        text == "Edit Education " ? "View Education" : "Edit Education ");
		
	});
	//End Education 
	
	//Overmouse as a cursor:hand
	$('.editbuttons, .savebuttons').mouseover(function(){

		$( this ).css( 'cursor', 'pointer' );
		});


	//Hide the Employment Edit
	$('.employmentEditBox').hide();

	// Employment
	$('.editbuttons.employment').click(function(){

		//Hide and show the education edit and view
		$('.employmentEditBox, #employmentListView').fadeToggle('fast');

		var text = $( this ).text();
	    $( this ).text(
	        text == "Edit Employment " ? "View Employment" : "Edit Employment ");
		
	});
	//End Employment 

	//Ajax form Uprofile //


	//END Ajax form Uprofile //
	
});
// END Loading the functions and behaviours //

// Toggle the User profile, education and employment //		 



//END Toggle the User profile, education and employment //	
</script>	

=======
>>>>>>> Stashed changes
