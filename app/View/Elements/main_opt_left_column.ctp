<!-- Start lftlink Box -->
<div class="lftlinkBox">
	<ul>
						
	
	
		<li><?php
				if ($sel == 'Privacy') { 
					echo $this->Html->link('Privacy', array('controller'=>'index', 'action'=>'privacy'),array('class'=>'sel')); 
				} else {
					echo $this->Html->link('Privacy', array('controller'=>'index', 'action'=>'privacy')); 
				}					
			?>
		</li>

	
		<li><?php
				if ($sel == 'Contact Us') { 
					echo $this->Html->link('Contact Us', array('controller'=>'messages', 'action'=>'index','contact_us'),array('class'=>'sel')); 
				} else {
					echo $this->Html->link('Contact Us', array('controller'=>'messages', 'action'=>'index','contact_us')); 
				}					
			?>
		</li>				
	</ul>
</div>

<!-- End lftlink Box -->

