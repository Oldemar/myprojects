<?php
				if ($journals['Journal']['user_id'] == AuthComponent::user('id') && isset($journalId)) {
				?>
				<div class="rgtCntrright">

					<?php echo $this->element('Users/share_journal'); ?>	

				</div>			
				<div class="clr"></div>
				<?php } ?>
