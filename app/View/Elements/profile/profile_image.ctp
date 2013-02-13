<div id="userImgContainer">
	<div class="userImgbg">
	<?php 
	
		if ($users['User']['id'] == Authcomponent::user('id')) { 
			echo $this->Html->link($this->CachedElement->userProfileImage($users['User']['id'],'w190',array('width' => '190')), 
									array('controller'=>'pictures','action'=>'index'), 
									array('escape'=>false)); 
		} else {
			if ($users['User']['tutor_id'] == Authcomponent::user('id')) {
				echo $this->Html->link($this->CachedElement->userProfileImage($users['User']['id'],'w190',array('width' => '190')), 
										array('controller'=>'pictures','action'=>'relatedpics',$users['User']['id']), 
										array('escape'=>false)); 
			} else {
				echo $this->Html->image($usrimg, array('width' => '200')); 
			}
		}
			?>
	</div>
</div>
<br />