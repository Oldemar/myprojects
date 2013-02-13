<div class="invitations view">
<h2><?php  echo __('Invitation');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invitation['User']['username'], array('controller' => 'users', 'action' => 'view', $invitation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tablename'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invitation['Tablename']['id'], array('controller' => 'tablenames', 'action' => 'view', $invitation['Tablename']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Value'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['id_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invited'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['invited']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invitation'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['invitation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accepted'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['accepted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastinvitation'); ?></dt>
		<dd>
			<?php echo h($invitation['Invitation']['lastinvitation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invitation'), array('action' => 'edit', $invitation['Invitation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invitation'), array('action' => 'delete', $invitation['Invitation']['id']), null, __('Are you sure you want to delete # %s?', $invitation['Invitation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Invitations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invitation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tablenames'), array('controller' => 'tablenames', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tablename'), array('controller' => 'tablenames', 'action' => 'add')); ?> </li>
	</ul>
</div>
