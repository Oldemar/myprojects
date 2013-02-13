<div class="institutes view">
<h2><?php  echo __('Institute');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($institute['User']['username'], array('controller' => 'users', 'action' => 'view', $institute['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($institute['Institute']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Institute'), array('action' => 'edit', $institute['Institute']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Institute'), array('action' => 'delete', $institute['Institute']['id']), null, __('Are you sure you want to delete # %s?', $institute['Institute']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Institutes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Institute'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Educations'), array('controller' => 'educations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education'), array('controller' => 'educations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Educations');?></h3>
	<?php if (!empty($institute['Education'])):?>
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
		foreach ($institute['Education'] as $education): ?>
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
