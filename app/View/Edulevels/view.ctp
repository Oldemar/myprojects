<div class="edulevels view">
<h2><?php  echo __('Edulevel');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($edulevel['Edulevel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($edulevel['Edulevel']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($edulevel['User']['username'], array('controller' => 'users', 'action' => 'view', $edulevel['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($edulevel['Edulevel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($edulevel['Edulevel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Edulevel'), array('action' => 'edit', $edulevel['Edulevel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Edulevel'), array('action' => 'delete', $edulevel['Edulevel']['id']), null, __('Are you sure you want to delete # %s?', $edulevel['Edulevel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Edulevels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Edulevel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Educations'), array('controller' => 'educations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education'), array('controller' => 'educations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Educations');?></h3>
	<?php if (!empty($edulevel['Education'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Edulevel Id'); ?></th>
		<th><?php echo __('Institute Id'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Perm'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($edulevel['Education'] as $education): ?>
		<tr>
			<td><?php echo $education['id'];?></td>
			<td><?php echo $education['user_id'];?></td>
			<td><?php echo $education['edulevel_id'];?></td>
			<td><?php echo $education['institute_id'];?></td>
			<td><?php echo $education['start_date'];?></td>
			<td><?php echo $education['end_date'];?></td>
			<td><?php echo $education['description'];?></td>
			<td><?php echo $education['perm'];?></td>
			<td><?php echo $education['created'];?></td>
			<td><?php echo $education['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'educations', 'action' => 'view', $education['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'educations', 'action' => 'edit', $education['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'educations', 'action' => 'delete', $education['id']), null, __('Are you sure you want to delete # %s?', $education['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Education'), array('controller' => 'educations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
