<div class="countries view">
<h2><?php  echo __('Country');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($country['Country']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($country['Country']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fips104'); ?></dt>
		<dd>
			<?php echo h($country['Country']['fips104']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso2'); ?></dt>
		<dd>
			<?php echo h($country['Country']['iso2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso3'); ?></dt>
		<dd>
			<?php echo h($country['Country']['iso3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ison'); ?></dt>
		<dd>
			<?php echo h($country['Country']['ison']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capital'); ?></dt>
		<dd>
			<?php echo h($country['Country']['capital']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationalitysingular'); ?></dt>
		<dd>
			<?php echo h($country['Country']['nationalitysingular']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nationalityplural'); ?></dt>
		<dd>
			<?php echo h($country['Country']['nationalityplural']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($country['Country']['currency']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currencycode'); ?></dt>
		<dd>
			<?php echo h($country['Country']['currencycode']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Country'), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Country'), array('action' => 'delete', $country['Country']['id']), null, __('Are you sure you want to delete # %s?', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country Res'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regions'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Regions');?></h3>
	<?php if (!empty($country['Regions'])):?>
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
		foreach ($country['Regions'] as $regions): ?>
		<tr>
			<td><?php echo $regions['id'];?></td>
			<td><?php echo $regions['country_id'];?></td>
			<td><?php echo $regions['region'];?></td>
			<td><?php echo $regions['code'];?></td>
			<td><?php echo $regions['adm1code'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'regions', 'action' => 'view', $regions['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'regions', 'action' => 'edit', $regions['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'regions', 'action' => 'delete', $regions['id']), null, __('Are you sure you want to delete # %s?', $regions['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Regions'), array('controller' => 'regions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Contacts');?></h3>
	<?php if (!empty($country['Contact'])):?>
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
		foreach ($country['Contact'] as $contact): ?>
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
