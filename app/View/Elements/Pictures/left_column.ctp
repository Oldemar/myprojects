<!-- Start left container -->
<div id="leftCntr">
	<div id="userImgContainer">
		<div class="userImgbg">
	
		<?php 
			ClassRegistry::init('Picture');
			ClassRegistry::init('User');
			
			echo $this->CachedElement->userProfileImage($objLoggedUser->getAttr('id'),'w190',array('width' => '190')); 
			
		?>
		</div>
	
	</div>
	
	<?php echo $this->element('profile/alphaworldmap'); ?>
	
	<?php echo $this->element('profile/side_navigation'); ?>
	

	<!-- <div class="alphavideoBtn"><a href="#"><img src="<?php echo $this->webroot ; ?>img/view_alpha_videos_inactive.png" alt="" /></a></div>-->
</div>
<!-- End left container -->