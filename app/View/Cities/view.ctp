<div class="cities view">
<h2><?php  echo __('City');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['region_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($city['City']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($city['City']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timezone'); ?></dt>
		<dd>
			<?php echo h($city['City']['timezone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dmaid'); ?></dt>
		<dd>
			<?php echo h($city['City']['dmaid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($city['City']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City'), array('action' => 'delete', $city['City']['id']), null, __('Are you sure you want to delete # %s?', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City Res'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Regions');?></h3>
	<?php if (!empty($city['Region'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Region'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Adm1code'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Region'] as $region): ?>
		<tr>
			<td><?php echo $region['id'];?></td>
			<td><?php echo $region['country_id'];?></td>
			<td><?php echo $region['region'];?></td>
			<td><?php echo $region['code'];?></td>
			<td><?php echo $region['adm1code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'regions', 'action' => 'view', $region['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'regions', 'action' => 'edit', $region['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'regions', 'action' => 'delete', $region['id']), null, __('Are you sure you want to delete # %s?', $region['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Contacts');?></h3>
	<?php if (!empty($city['Contact'])):?>
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
		foreach ($city['Contact'] as $contact): ?>
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
