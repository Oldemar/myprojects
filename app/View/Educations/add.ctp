<div class="educations form">
<?php echo $this->Form->create('Education');?>
	<fieldset>
		<legend><?php echo __('Add Education'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('edulevel_id');
		echo $this->Form->input('institute_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('description');
		echo $this->Form->input('perm');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Educations'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Edulevels'), array('controller' => 'edulevels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Edulevel'), array('controller' => 'edulevels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutes'), array('controller' => 'institutes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institute'), array('controller' => 'institutes', 'action' => 'add')); ?> </li>
	</ul>
</div>
