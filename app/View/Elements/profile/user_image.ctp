<div id="userImgContainer">
	<div class="userImgbg">
		<?php 
		
		if(!isset($journals['User']['id'])){
			$journals['User']['id'] = $userId;
		}

		echo $this->CachedElement->userProfileImage($journals['User']['id'],'w190',array('width' => '190')); 
		?>
	</div>
</div>
