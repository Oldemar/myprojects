<div class="educations index">
	<h2><?php echo __('Educations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Education Level');?></th>
			<th><?php echo __('Institute');?></th>
			<th><?php echo __('Start');?></th>
			<th><?php echo __('End');?></th>
			<th><?php echo __('Description');?></th>
			<th><?php echo __('Access');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>

	<?php
	
	foreach ($educations as $education): ?>
	<tr>

		<td>
			<?php echo $this->Html->link($education['Edulevel']['name'], array('controller' => 'edulevels', 'action' => 'view', $education['Edulevel']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($education['Institute']['name'], array('controller' => 'institutes', 'action' => 'view', $education['Institute']['id'])); ?>
		</td>
		<td><?php echo h($education['Education']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($education['Education']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($education['Education']['description']); ?>&nbsp;</td>
		<td><?php echo h($education['Education']['perm']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $education['Education']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $education['Education']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $education['Education']['id']), null, __('Are you sure you want to delete # %s?', $education['Education']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>