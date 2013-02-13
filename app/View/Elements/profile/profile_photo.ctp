<div id="userImgContainer">
	<div class="userImgbg">
		<?php 
		
		if($users['User']['picture_id']){
			$usrimg = $users['Picture']['url'].$users['Picture']['w190'] ;
		}else{
			$usrimg = 'nopicavble.jpg';
		}
		
		echo $this->Html->image($usrimg, array('width' => '190')); 
		?>
	</div>
</div>
