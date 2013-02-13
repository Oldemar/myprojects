<div class="communities view">
<h2><?php  echo __('Community');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($community['Community']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($community['Community']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($community['User']['username'], array('controller' => 'users', 'action' => 'view', $community['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($community['Community']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($community['Community']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($community['Community']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Community'), array('action' => 'edit', $community['Community']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Community'), array('action' => 'delete', $community['Community']['id']), null, __('Are you sure you want to delete # %s?', $community['Community']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Communities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Community'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users');?></h3>
	<?php if (!empty($community['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Lastname'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Dob'); ?></th>
		<th><?php echo __('Signup'); ?></th>
		<th><?php echo __('Activate'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Tutor User'); ?></th>
		<th><?php echo __('Online'); ?></th>
		<th><?php echo __('About Me'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th><?php echo __('Picture Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($community['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['firstname'];?></td>
			<td><?php echo $user['lastname'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['dob'];?></td>
			<td><?php echo $user['signup'];?></td>
			<td><?php echo $user['activate'];?></td>
			<td><?php echo $user['active'];?></td>
			<td><?php echo $user['gender'];?></td>
			<td><?php echo $user['tutor_user'];?></td>
			<td><?php echo $user['online'];?></td>
			<td><?php echo $user['about_me'];?></td>
			<td><?php echo $user['ip'];?></td>
			<td><?php echo $user['facebook_id'];?></td>
			<td><?php echo $user['picture_id'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
