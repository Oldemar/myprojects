<div class="modal-body" id="invitebody">
	<?php echo $this->Session->flash('inviteFriends'); ?>
		<div class="row-fluid employmentrow smallMarginRow">
			<div class="span12">
				<?php 
				echo $this->Form->input('User.emailaddress.0', array('class'=>'bodymessage', 'label'=>'Email Address 1','type'=>'text'));
				?>
			</div>
		</div>	
		<div class="row-fluid employmentrow smallMarginRow">
			<div class="span12">
				<?php 
				echo $this->Form->input('User.emailaddress.1', array('class'=>'bodymessage', 'label'=>'Email Address 2','type'=>'text'));
				?>
			</div>
		</div>	
		<div class="row-fluid employmentrow smallMarginRow">
			<div class="span12">
				<?php 
				echo $this->Form->input('User.emailaddress.3', array('class'=>'bodymessage', 'label'=>'Email Address 3','type'=>'text'));
				?>
			</div>
		</div>	
		<div class="row-fluid employmentrow smallMarginRow">
			<div class="span12">
				<?php 
				echo $this->Form->input('User.emailaddress.4', array('class'=>'bodymessage', 'label'=>'Email Address 4','type'=>'text'));
				?>
			</div>
		</div>	
		<div class="row-fluid employmentrow smallMarginRow">
			<div class="span12">
				<?php 
				echo $this->Form->input('User.emailaddress.5', array('class'=>'bodymessage', 'label'=>'Email Address 5','type'=>'text'));
				?>
			</div>
		</div>	
		
</div>