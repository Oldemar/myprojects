<div class="jfriendboxbar">
	<div class="headtxtBg">Friends</div>							

	<?php
		foreach ($usertobeshow as $usr) :
			if ($usr['User']['allowed']) {
	?>
	<div id="addJuserImgContainer">
		<div class="addJuserImgbg">oldemar
			<?php 
				if ( isset( $usr['User']['Picture']['name'] ) && ( $usr['User']['Picture']['name'] != null ) ) {
					echo $this->Html->image($usr['User']['Picture']['name'], 
										array('width'=>'65', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ; 
				} else {
					echo $this->Html->image('nopicture.gif', 
										array('width'=>'65', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ;
				}
			?>
		</div>
		<?php 
				echo $this->Html->link($usr['User']['firstname']. " " .$usr['User']['lastname'], 
										array('controller' => 'users', 'action' => 'profile', $usr['User']['id'])) ; 
		?>
		<?php 
			/*
			 *  Params to be passed
			 *  isdel => an array that could contains: the controller, the action and theID 
			 *  isins => an array that could contains:  the controller and the action
			 *  isedt => an array that could contains: the controller, the action and ID
			 *  ischk => an array that could contains: the controller, the action, the ID and
			 *  				an array that could contains params
			 *  isspecX => an array that could contains: icon to be shown, the controller the action and
			 *  				 an array with the params, where the 'X' could be a sequential #
			 */ 
			$this->set('usr',$usr);
			if (isset($elementactions) && $elementactions != null)
				echo $this->element($elementactions, array(
										'isins'=>$isins,
										'isdel'=>$isdel,
										'isedt'=>$isedt,
										'ischk'=>$ischk,
										'isspec'=>$isspec
										));
		?>
	</div>											
																	
	<?php 
			}
		endforeach;
	?>
</div>
