<div class="regions view">
<h2><?php  echo __('Region');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($region['Region']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Id'); ?></dt>
		<dd>
			<?php echo h($region['Region']['country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region'); ?></dt>
		<dd>
			<?php echo h($region['Region']['region']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($region['Region']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Adm1code'); ?></dt>
		<dd>
			<?php echo h($region['Region']['adm1code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Region'), array('action' => 'edit', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Region'), array('action' => 'delete', $region['Region']['id']), null, __('Are you sure you want to delete # %s?', $region['Region']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region Res'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cities');?></h3>
	<?php if (!empty($region['City'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Region Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Latitude'); ?></th>
		<th><?php echo __('Longitude'); ?></th>
		<th><?php echo __('Timezone'); ?></th>
		<th><?php echo __('Dmaid'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($region['City'] as $city): ?>
		<tr>
			<td><?php echo $city['id'];?></td>
			<td><?php echo $city['country_id'];?></td>
			<td><?php echo $city['region_id'];?></td>
			<td><?php echo $city['name'];?></td>
			<td><?php echo $city['latitude'];?></td>
			<td><?php echo $city['longitude'];?></td>
			<td><?php echo $city['timezone'];?></td>
			<td><?php echo $city['dmaid'];?></td>
			<td><?php echo $city['code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cities', 'action' => 'delete', $city['id']), null, __('Are you sure you want to delete # %s?', $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Contacts');?></h3>
	<?php if (!empty($region['Contact'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Res Country Id'); ?></th>
		<th><?php echo __('Res Region Id'); ?></th>
		<th><?php echo __('Res City Id'); ?></th>
		<th><?php echo __('Res Address 1'); ?></th>
		<th><?php echo __('Res Address 2'); ?></th>
		<th><?php echo __('Res Zip'); ?></th>
		<th><?php echo __('Mobilephone'); ?></th>
		<th><?php echo __('Homephone'); ?></th>
		<th><?php echo __('Workphone'); ?></th>
		<th><?php echo __('Bus Country Id'); ?></th>
		<th><?php echo __('Bus Region Id'); ?></th>
		<th><?php echo __('Bus City Id'); ?></th>
		<th><?php echo __('Bus Address 1'); ?></th>
		<th><?php echo __('Bus Address 2'); ?></th>
		<th><?php echo __('Bus Zip'); ?></th>
		<th><?php echo __('Birth Country Id'); ?></th>
		<th><?php echo __('Birth Region Id'); ?></th>
		<th><?php echo __('Birth City Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($region['Contact'] as $contact): ?>
		<tr>
			<td><?php echo $contact['id'];?></td>
			<td><?php echo $contact['user_id'];?></td>
			<td><?php echo $contact['res_country_id'];?></td>
			<td><?php echo $contact['res_region_id'];?></td>
			<td><?php echo $contact['res_city_id'];?></td>
			<td><?php echo $contact['res_address_1'];?></td>
			<td><?php echo $contact['res_address_2'];?></td>
			<td><?php echo $contact['res_zip'];?></td>
			<td><?php echo $contact['mobilephone'];?></td>
			<td><?php echo $contact['homephone'];?></td>
			<td><?php echo $contact['workphone'];?></td>
			<td><?php echo $contact['bus_country_id'];?></td>
			<td><?php echo $contact['bus_region_id'];?></td>
			<td><?php echo $contact['bus_city_id'];?></td>
			<td><?php echo $contact['bus_address_1'];?></td>
			<td><?php echo $contact['bus_address_2'];?></td>
			<td><?php echo $contact['bus_zip'];?></td>
			<td><?php echo $contact['birth_country_id'];?></td>
			<td><?php echo $contact['birth_region_id'];?></td>
			<td><?php echo $contact['birth_city_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contacts', 'action' => 'view', $contact['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contacts', 'action' => 'edit', $contact['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contacts', 'action' => 'delete', $contact['id']), null, __('Are you sure you want to delete # %s?', $contact['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
