<div class="works form">
<?php echo $this->Form->create('Work');?>
	<fieldset>
		<legend><?php echo __('Edit Work'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('specialty_id');
		echo $this->Form->input('workplace_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Work.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Work.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Works'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Specialties'), array('controller' => 'specialties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Specialty'), array('controller' => 'specialties', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workplaces'), array('controller' => 'workplaces', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workplace'), array('controller' => 'workplaces', 'action' => 'add')); ?> </li>
	</ul>
</div>
