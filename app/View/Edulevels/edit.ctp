<div class="edulevels form">
<?php echo $this->Form->create('Edulevel');?>
	<fieldset>
		<legend><?php echo __('Edit Edulevel'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Edulevel.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Edulevel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Edulevels'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Educations'), array('controller' => 'educations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education'), array('controller' => 'educations', 'action' => 'add')); ?> </li>
	</ul>
</div>