<?php 
foreach ($journals['Comment'] as $comment) :
	if ($comment['sharing_level'] == CakeSession::read('shrlev')) {
?>
<div class="line">
	<div class="icon">
		<?php 
			if ($comment['User']['picture_id'] != 0 ) {
				echo $this->Html->image(Configure::read('UUI').$comment['User']['Picture']['url'].$comment['User']['Picture']['w40'],array('url' => array('controller'=>'users','action'=>'profile',$comment['user_id'])));
			} else {
			 if ($comment['User']['gender'] == '0') 
					echo $this->Html->image('nopicavble.jpg',array('width' => '40', 'url' => array('controller'=>'users','action'=>'profile',$comment['user_id'])));
			 if ($comment['User']['gender'] == '1') 
				echo $this->Html->image('maleprofile.png',array('width' => '40', 'url' => array('controller'=>'users','action'=>'profile',$comment['user_id'])));
			 if ($comment['User']['gender'] == '2') 
				echo $this->Html->image('femaleprofile.png',array('width' => '40', 'url' => array('controller'=>'users','action'=>'profile',$comment['user_id'])));
			}	
		?>
	</div>
	<div class="midtxt">
		<?php 
			echo $this->Html->link($comment['User']['username'], array('controller'=>'users','action'=>'profile',$comment['user_id'])) ; 
		?>,
		<span>
		<?php
			if (CakeTime::isToday($comment['created'])) {
				echo CakeTime::timeAgoInWords($comment['created']);
			} else {
				if (CakeTime::wasYesterday($comment['created'])) {
					echo 'Yesterday';
				} else {
					echo CakeTime::format('h:i | F d, Y', $comment['created']) ;
				}
			}
			if (($comment['user_id'] == Authcomponent::user('id')) || ($journals['Journal']['user_id'] == Authcomponent::user('id')))
				echo "<span style=\"float:right;\">".$this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')),array('controller' => 'comments' ,'action' => 'delete', $comment['id'], $journals['Journal']['id']),array('escape'=> false),__('Are you sure you want to delete this comment?'))."</span>";
		?>
		</span><br>
		<?php echo $comment['comment'] ; ?>
	</div>
	<div class="clr"></div>
</div>
<?php 
	}
	endforeach; 
?>
