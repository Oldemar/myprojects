<div id="userImgContainer">
	<div class="userImgbg">

		<?php 

		$usrimg = $users['picture_id'] == 0 ? 'nopicavble.jpg' : $journals['User']['Picture']['name'] ;
		echo $this->Html->image($usrimg, array('width' => '190')); 
		?>
	</div>
</div>


