<?php 
//	die("<pre>".print_r($contacts,true)."</pre>");
?>

<div class="contacts index">
	<h2><?php echo __('Contacts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('res_country_id');?></th>
			<th><?php echo $this->Paginator->sort('res_region_id');?></th>
			<th><?php echo $this->Paginator->sort('res_city_id');?></th>
			<th><?php echo $this->Paginator->sort('res_address_1');?></th>
			<th><?php echo $this->Paginator->sort('res_address_2');?></th>
			<th><?php echo $this->Paginator->sort('res_zip');?></th>
			<th><?php echo $this->Paginator->sort('mobilephone');?></th>
			<th><?php echo $this->Paginator->sort('homephone');?></th>
			<th><?php echo $this->Paginator->sort('workphone');?></th>
			<th><?php echo $this->Paginator->sort('bus_country_id');?></th>
			<th><?php echo $this->Paginator->sort('bus_region_id');?></th>
			<th><?php echo $this->Paginator->sort('bus_city_id');?></th>
			<th><?php echo $this->Paginator->sort('bus_address_1');?></th>
			<th><?php echo $this->Paginator->sort('bus_address_2');?></th>
			<th><?php echo $this->Paginator->sort('bus_zip');?></th>
			<th><?php echo $this->Paginator->sort('birth_country_id');?></th>
			<th><?php echo $this->Paginator->sort('birth_region_id');?></th>
			<th><?php echo $this->Paginator->sort('birth_city_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($contacts as $contact): ?>
	<tr>
		<td><?php echo h($contact['Contact']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($contact['User']['username'], array('controller' => 'users', 'action' => 'view', $contact['User']['id'])); ?>
		</td>
		<td><?php echo h($contact['ResCountry']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['ResRegion']['region']); ?>&nbsp;</td>
		<td><?php echo h($contact['ResCity']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['res_address_1']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['res_address_2']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['res_zip']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['mobilephone']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['homephone']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['workphone']); ?>&nbsp;</td>
		<td><?php echo h($contact['BusCountry']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['BusRegion']['region']); ?>&nbsp;</td>
		<td><?php echo h($contact['BusCity']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['bus_address_1']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['bus_address_2']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['bus_zip']); ?>&nbsp;</td>
		<td><?php echo h($contact['BirthCountry']['name']); ?>&nbsp;</td>
		<td><?php echo h($contact['BirthRegion']['region']); ?>&nbsp;</td>
		<td><?php echo h($contact['BirthCity']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), null, __('Are you sure you want to delete # %s?', $contact['Contact']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Res Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Res Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Res City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
