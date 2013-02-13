								<?php echo $this->Form->create('User'); ?>
								<?php 
								
								echo $this->Form->button('Save', array('type'=>'button','id'=>'psaveButton', 'class' => 'buttons psaveButton'));
								
								?>
								
								<div class="uprofileEditBox">
								<div id="divErrors" class="alert alert-error" style="display:none;"></div>
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
													'onblur'=>'replaceText(this)',
													'disabled' => true
													));
											/*echo ' '.$this->Form->radio('pusername', 
													array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
													 
														array('legend' => false,'value'=>$user['User']['pusername']));*/
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
													'minYear'=>date('Y')-13, 
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
										<?php
											echo '<span id="birthCity">';
											echo $this->Form->input('Contact.birth_city_id', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileSlct',
													'onblur'=>'replaceText(this)',
													'empty'=>'Select one'));
											echo '</span>';
											echo ' '.$this->Form->radio('Contact.pbir_c', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pbir_c']));
										?>
										<br><a href="javascript:;" id='linkNoBirthCity' onClick="fnNoBirthCity(this)">Didn't find your city? Click here.</a>
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
											echo '<span id="resCity">';
								 			echo $this->Form->input('Contact.res_city_id', array(
								 					'div'=>false,
								 					'label'=>false,
								 					'class'=>'profileSlct',
													'empty'=>'Select one'
								 				)); 
								 			echo '</span>';
											echo ' '.$this->Form->radio('Contact.pres_c', 
														 array('0'=>$this->Html->image('P.jpg'), '1'=>$this->Html->image('F.jpg'),'2'=>$this->Html->image('G.jpg')), 
														array('legend' => false,'value'=>$user['Contact']['pres_c']));
								 				?>
								 			<br><a href="javascript:;" id='linkNoResCity' onClick="fnNoResCity(this)">Didn't find your city? Click here.</a>
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
								<?php 
								
								echo $this->Form->button('Save', array('type'=>'button','id'=>'psaveButton', 'class' => 'buttons psaveButton'));
								
								echo $this->Form->end();

								?>
								
<script>
	
	$('#ContactBirthCountryId').change(function(){
		
		$('#ContactBirthCityId').val(0);
		$('#ContactBirthRegionId').val(0);
	});
	
	$('#ContactResCountryId').change(function(){
		
		$('#ContactResRegionId').val(0);
		$('#ContactResCityId').val(0);
	});

	
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

<script>

function fnNoResCity(){
	$('#resCity').html('<font color=red>Please enter bellow your city name:</font><input type="text" name="Contact[newResCity]" class="profileInpt">');
	$('#linkNoResCity').hide();
}

function fnNoBirthCity(){
	$('#birthCity').html('<font color=red>Please enter bellow your city name:</font><input type="text" name="Contact[newBirthCity]" class="profileInpt">');
	$('#linkNoBirthCity').hide();
}


$('#emailError').hide();
$(".psaveButton").click(function(){

	var formData = $("#UserProfileEditForm :input").serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "<?php echo $this->Form->url('/users/profileEdit/'.$userId)?>",
        data: formData,
        success: function(ajaxReturn,textStatus,xhr){
			if(ajaxReturn.boolError){
				$('#add_new_profile').html(ajaxReturn.content);
				
				$('#divErrors').html(ajaxReturn.strErrors);
				$('#divErrors').show();
			}else{
				$('#profile_list').html(ajaxReturn.content);
				$('#myTab3 a[href="#profile_list"]').tab('show');
				$('#divErrors').hide();
			}		
                
        },
        error: function(xhr,textStatus,error){

                alert('The server can not be reached in this moment. Please, try later.');
        },
        beforeSend: function(){

        	$('#add_new_profile').html('<?php echo $this->Html->image('loading.gif');?>');
        	$('#myTab3 a[href="#add_new_profile"]').tab('show');
	
	    }
    }); 
	
	
});


</script>    						
					
