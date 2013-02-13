<div class="friendboxbar">
	<div class="headtxtBg">Friends</div>							

	<?php
	foreach ($usertobeshow as $usr) :
	?>

			<div class="row-fluid">
				<div class="span1">
					<?php 
						/*
						 *  Params to be passed
						 *  isdel => an array that could contains: the controller, the action and the ID 
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
				<div class="span2">
					<?php 
						if ( isset( $usr['User']['Picture']['w40'] ) && ( $usr['User']['Picture']['w40'] != null ) ) {
							echo $this->Html->image(Picture::getPathToUploadFolder().$usr['User']['Picture']['url'].$usr['User']['Picture']['w40'], 
											array('width'=>'40', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ; 
						} else {
							echo $this->Html->image('nopicture.gif', 
											array('width'=>'40', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ;
						}
					?>
				</div>
				<div class="span5">
				<?php 
					echo $this->Html->link($usr['User']['firstname']. " " .$usr['User']['lastname'], 
										array('controller' => 'users', 'action' => 'profile', $usr['User']['id'])) ; 
				?>
				</div>
			
			</div>											
																	
<?php 
		endforeach;
?>
</div>
