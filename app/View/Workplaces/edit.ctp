<div class="workplaces form">
<?php echo $this->Form->create('Workplace');?>
	<fieldset>
		<legend><?php echo __('Edit Workplace'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('location');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Workplace.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Workplace.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Workplaces'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Works'), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work'), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>
