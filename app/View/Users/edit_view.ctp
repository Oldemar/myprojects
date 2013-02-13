<div id="dialog" title="Basic dialog" >
	<p>The information has been requested to the server...</p>
</div>

<div class="fiedls uprofile">							
<div class="editbuttons uprofile"><div class="editbutton">Edit Profile</div>  </div>		
<div class="savebuttons uprofile">
<div class="savebutton">Save Profile</div></div>

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
								<?php echo CakeTime::format('F jS, Y ', h($users['User']['dob'])); ?>
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
								
								
<div id="uprofileEditBox">
								<?php echo $this->Form->create('User'); ?>
								<div class="borderHd">
									<div class="fl" style="padding-top:10px;">Basic Information</div>
									<div class="clr"></div>
								</div>
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
</div>				
								
<script>

var serverPath = <?php echo $this->webroot; ?>

$('#dialog').hide();

	$('.uprofileEditBox').hide();

	//This is launched when the Ajax starts
	$('#dialog').ajaxStart(function() {
	  $(this).dialog();
	});
	//This is launched when the Ajax ends
	$('#dialog').ajaxStop(function() {
		  $(this).dialog('close');
		});
												
	// Employment
	$('.editbuttons.uprofile').click(function(){

		//Hide and show the education edit and view
		$('.uprofileEditBox, #uprofileListView').fadeToggle('slow');

		var text = $( this ).text();
	    $( this ).text(
	        text == "Edit Profile " ? "View Profile" : "Edit Profile ");
		
	});


	//Save data through AJAX
	$('.savebutton').click(function(){ 

		var formData = $(".uprofileEditBox :input").serialize();

		var formUrl = serverPath+'Users/editAjax';

		    $.ajax({
		    type: 'POST',
		    url: formUrl,
		    data: formData,
		    success: function(dataRETURN,textStatus,xhr){

		            //Refresh uprofile list
	            
		    },
		    error: function(xhr,textStatus,error){

		            alert('The server can not be reached in this moment. Please, try later.');
		    }
		}); 
		
		
		});

	
//testing
$('#ContactBusCountryId').change(function(){ alert("estoy aca");});

alert('comenzando');
</script>	
		


											
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