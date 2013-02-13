<div class="workplaces view">
<h2><?php  echo __('Workplace');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workplace['Workplace']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($workplace['Workplace']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($workplace['Workplace']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($workplace['Workplace']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($workplace['Workplace']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workplace'), array('action' => 'edit', $workplace['Workplace']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workplace'), array('action' => 'delete', $workplace['Workplace']['id']), null, __('Are you sure you want to delete # %s?', $workplace['Workplace']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Workplaces'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workplace'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Works'), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work'), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Works');?></h3>
	<?php if (!empty($workplace['Work'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Specialty Id'); ?></th>
		<th><?php echo __('Workplace Id'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($workplace['Work'] as $work): ?>
		<tr>
			<td><?php echo $work['id'];?></td>
			<td><?php echo $work['user_id'];?></td>
			<td><?php echo $work['specialty_id'];?></td>
			<td><?php echo $work['workplace_id'];?></td>
			<td><?php echo $work['start_date'];?></td>
			<td><?php echo $work['end_date'];?></td>
			<td><?php echo $work['description'];?></td>
			<td><?php echo $work['created'];?></td>
			<td><?php echo $work['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'works', 'action' => 'view', $work['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'works', 'action' => 'edit', $work['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'works', 'action' => 'delete', $work['id']), null, __('Are you sure you want to delete # %s?', $work['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Work'), array('controller' => 'works', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
