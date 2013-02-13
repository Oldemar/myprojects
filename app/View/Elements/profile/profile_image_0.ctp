<div id="userImgContainer">
	<div class="userImgbg">
	<?php 
		
		echo $this->Html->link($this->CachedElement->userProfileImage($user['User']['id'],'w190',array('width' => '190')), array('controller'=>'pictures','action'=>'index'), array('escape'=>false)) . "<br>"; 
	?>
	</div>
</div>
