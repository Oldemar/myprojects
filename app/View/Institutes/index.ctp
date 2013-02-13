<div class="institutes index">
	<h2><?php echo __('Institutes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($institutes as $institute): ?>
	<tr>
		<td><?php echo h($institute['Institute']['id']); ?>&nbsp;</td>
		<td><?php echo h($institute['Institute']['name']); ?>&nbsp;</td>
		<td><?php echo h($institute['Institute']['image']); ?>&nbsp;</td>
		<td><?php echo h($institute['Institute']['location']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($institute['User']['username'], array('controller' => 'users', 'action' => 'view', $institute['User']['id'])); ?>
		</td>
		<td><?php echo h($institute['Institute']['created']); ?>&nbsp;</td>
		<td><?php echo h($institute['Institute']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $institute['Institute']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $institute['Institute']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $institute['Institute']['id']), null, __('Are you sure you want to delete # %s?', $institute['Institute']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Institute'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Educations'), array('controller' => 'educations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education'), array('controller' => 'educations', 'action' => 'add')); ?> </li>
	</ul>
</div>
