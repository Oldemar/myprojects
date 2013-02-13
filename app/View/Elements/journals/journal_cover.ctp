<div id="userImgContainer">
	<div class="userImgbg">
		<?php
			if ( $journals['Journal']['photo_id'] != 0 ) {
				foreach ($journals['Photo'] as $photo):
					if ($photo['id'] == $journals['Journal']['photo_id']) 
					{
						echo $this->Html->image($photo['name'], array('width' => '190'));
						break ;
					}
				endforeach;
			} else {
				echo $this->Html->image($journals['Area']['image'] != null ? $journals['Area']['image'] : 'nocover.jpg', array('width' => '190', 'height' => '190'));
			}
			
				
		 ?>
	</div>
</div>