<div class="invitations form">
<?php echo $this->Form->create('Invitation');?>
	<fieldset>
		<legend><?php echo __('Add Invitation'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('tablename_id');
		echo $this->Form->input('id_value');
		echo $this->Form->input('invited');
		echo $this->Form->input('invitation');
		echo $this->Form->input('accepted');
		echo $this->Form->input('lastinvitation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Invitations'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tablenames'), array('controller' => 'tablenames', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tablename'), array('controller' => 'tablenames', 'action' => 'add')); ?> </li>
	</ul>
</div>
