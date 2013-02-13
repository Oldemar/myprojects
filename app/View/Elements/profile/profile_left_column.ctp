<!-- Start left container -->
<div id="leftCntr">
	<?php echo $this->element('profile/user_image'); ?>
	
	<?php echo $this->element('profile/alphaworldmap'); ?>
	
	<?php 
		if (count($friendReqs)) { ?>
			<br>
			<div>
				<hr><h2 style='margin:0px'>Friend Requests</h2><hr>
				<?php foreach ($friendReqs AS $req) { //print('<pre>'.print_r($req,true).'</pre>');?>
				<a onclick="return confirm('for real? <?php print($req[0]['name']); ?>')" href='users/acceptFriendship/<?php print($req['r']['id']); ?>'><?php print($req[0]['name']); ?></a>
				<?php } ?>
			</div>
	<?php	} ?>
	
	
	<?php echo $this->element('profile/side_navigation'); ?>
	

	<!-- <div class="alphavideoBtn"><a href="#"><img src="<?php echo $this->webroot ; ?>img/view_alpha_videos_inactive.png" alt="" /></a></div> -->
</div>
<!-- End left container -->