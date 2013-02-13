<?php
$cakeDescription = __d('cake_dev', 'Living Alpha - Prototype V.0.1');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
echo $this->Facebook->html();

?>
<head>
<?php  
#Removed because we're going to user the FB
#echo $this->Html->charset(); ?>

<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>

<?php
echo $this->Html->meta('icon');



echo $this->Html->css(array(
		'style',
		'scrollbar',
		'colorbox',
		'calendar',
		'jquery-ui-1.8.20.custom',
		'uploadifive',
		'bootstrap.scaffolding',
		'uploadify'
));

/**
*
*/

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('functions');


?>


</head>
<body >
	<div id="mainCntr">
		<!-- Start header container -->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr22">
		<div class="cntrCntr22">
			<!-- Start left container -->
			<div id="leftCntr">
			</div>
			<!-- End left container -->
			<!-- Start right container -->
			<div class="regform">
						<div class="topPart">

							<div class="bottomPart">
								<div class="strachbar">
									<div class="ltside">
										<div class="rtside">Registration</div>
									</div>
								</div>
								<!--	<div class="regformtxt"></div> -->
 
								<div class="mendatorybox">Please fill the following form marked as  *</div>	
								<!-- start form Box -->
								<div class="formBox">
									<?php echo $this->Form->create('User');?>
									
									
									<div class="line">
										<div class="lableTxt">Username: <span class="mendatory">*</span></div>
										<div class="inputFlds"><?php echo $this->Form->input('username', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
										</div>
										<div class="clr"></div>

									</div>
									<div class="line">
										<div class="lableTxt">First name: <span class="mendatory">*</span></div>
										<div class="inputFlds"><?php echo $this->Form->input('firstname', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
										</div>
										<div class="clr"></div>

									</div>
									<div class="line">
										<div class="lableTxt">Last name: <span class="mendatory">*</span></div>
										<div class="inputFlds"><?php echo $this->Form->input('lastname', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
										</div>
										<div class="clr"></div>

									</div>
									
									<div class="line">
										<div class="lableTxt">Gender:  <span class="mendatory">*</span></div>
										<div class="inputFlds"><?php echo $this->Form->input('gender', array('div'=>false,'label'=>false,'options'=>array(
																		'0' => 'Not specified',
																		'1' => 'Male',
																		'2' => 'Female'
																	) )); ?>
										</div>
										<div class="clr"></div>

									</div>										
									<div class="line">
										<div class="lableTxt">Birthday: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php 
												echo $this->Form->input('dob', array(
														'div'=>false,
														'label'=>false,
														'minYear' => date('Y') -300,
														'maxYear' => date('Y') -13
											));?>
										</div>
										<div class="clr"></div>
									</div>
									<div class="line">
										<div class="lableTxt">E-mail address: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php echo $this->Form->input('email', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
										</div>
										<div class="clr"></div>
									</div>

									<div class="line">
										<div class="lableTxt">Password: <span class="mendatory">*</span></div>
										<div class="inputFlds">
											<?php echo $this->Form->input('password', array('div' => false, 'label' => false,'class' =>'inpt')); ?>
										</div>
										<div class="clr"></div>
									</div>
									<div class="line">
										<div class="lableTxt">Confirm Password: <span class="mendatory">*</span></div>

										<div class="inputFlds">
											<?php echo $this->Form->input('password_confirm', array('type'=>'password','div' => false, 'label' => false,'class' =>'inpt'));?>
										</div>
										<div class="clr"></div>
									</div>																																								

									<div class="line">
									<div class="lableTxt">Captcha<span class="mendatory">*</span></div>
											<?php echo $this->Form->input('captcha', array('label' => 'Calculate this: '.$captcha)); ?>
										<div class="clr"></div>
									</div>																																								
									
									<div class="line">
																								
											<div class="termsCondition">
												<?php
													echo $this->Form->input('agreement', array(
															'value' => 'Y',
															'hiddenField' => 'N',
															'type' => 'checkbox',
															'label' => " I have read and agreed to the <a href='javascript:;' id='aTerms'>Terms & Conditions</a>, and <a href='javascript:;' id='aPrivacy'>Privacy Policy</a>"  	
													));
												?>
											</div>
									<?php echo $this->Modal->displayAction('aTerms', array('controller'=>'index','action'=>'termsAjax'));?>
									<?php echo $this->Modal->displayAction('aPrivacy', array('controller'=>'index','action'=>'privacyAjax'));?>
									<div class="inputFlds">
										
									</div>
										

									</div>											
									<div class="line">
										<div class="lableTxt">&nbsp;</div>
										<div class="inputFlds"><input type="image" src="<?php echo $this->webroot ; ?>img/submitform.jpg"/> &nbsp;&nbsp;&nbsp;<input type="image" src="<?php echo $this->webroot ; ?>img/cancelform.jpg"/></div>
										<div class="clr"></div>
									</div>											
								</div>
								<!-- End form Box -->
							</div>

						</div>
					</div>	
			<!-- End right container -->
			<div class="clr"></div>	
		</div>																								
	</div>
	<!-- End content container -->
</div>
</body>
<?php echo $this->Facebook->init(); ?>
	
<script type="text/javascript"> 

window.resizeTo(700, 700);


<?php 
 if($isLogged){ 
?>	
	window.opener.location = '<?php echo $redirectURL; ?>';
	window.close();
<?php
}
?>
</script>
</html>	
