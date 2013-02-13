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
