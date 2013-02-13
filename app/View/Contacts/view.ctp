<div class="contacts view">
<h2><?php  echo __('Contact');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contact['User']['username'], array('controller' => 'users', 'action' => 'view', $contact['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res Country Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res Region Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_region_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res City Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_city_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res Address 1'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_address_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res Address 2'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_address_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res Zip'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['res_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobilephone'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['mobilephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Homephone'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['homephone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Workphone'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['workphone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus Country Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus Region Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_region_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus City Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_city_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus Address 1'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_address_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus Address 2'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_address_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bus Zip'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['bus_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birth Country Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['birth_country_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birth Region Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['birth_region_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birth City Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['birth_city_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contact'), array('action' => 'edit', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contact'), array('action' => 'delete', $contact['Contact']['id']), null, __('Are you sure you want to delete # %s?', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?> </li>
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
	<div class="related">
		<h3><?php echo __('Related Countries');?></h3>
	<?php if (!empty($contact['ResCountry'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Fips104');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['fips104'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso2');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['iso2'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso3');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['iso3'];?>
&nbsp;</dd>
		<dt><?php echo __('Ison');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['ison'];?>
&nbsp;</dd>
		<dt><?php echo __('Capital');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['capital'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalitysingular');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['nationalitysingular'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalityplural');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['nationalityplural'];?>
&nbsp;</dd>
		<dt><?php echo __('Currency');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['currency'];?>
&nbsp;</dd>
		<dt><?php echo __('Currencycode');?></dt>
		<dd>
	<?php echo $contact['ResCountry']['currencycode'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Res Country'), array('controller' => 'countries', 'action' => 'edit', $contact['ResCountry']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Countries');?></h3>
	<?php if (!empty($contact['BusCountry'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Fips104');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['fips104'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso2');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['iso2'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso3');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['iso3'];?>
&nbsp;</dd>
		<dt><?php echo __('Ison');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['ison'];?>
&nbsp;</dd>
		<dt><?php echo __('Capital');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['capital'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalitysingular');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['nationalitysingular'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalityplural');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['nationalityplural'];?>
&nbsp;</dd>
		<dt><?php echo __('Currency');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['currency'];?>
&nbsp;</dd>
		<dt><?php echo __('Currencycode');?></dt>
		<dd>
	<?php echo $contact['BusCountry']['currencycode'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Bus Country'), array('controller' => 'countries', 'action' => 'edit', $contact['BusCountry']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Countries');?></h3>
	<?php if (!empty($contact['BirthCountry'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Fips104');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['fips104'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso2');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['iso2'];?>
&nbsp;</dd>
		<dt><?php echo __('Iso3');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['iso3'];?>
&nbsp;</dd>
		<dt><?php echo __('Ison');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['ison'];?>
&nbsp;</dd>
		<dt><?php echo __('Capital');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['capital'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalitysingular');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['nationalitysingular'];?>
&nbsp;</dd>
		<dt><?php echo __('Nationalityplural');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['nationalityplural'];?>
&nbsp;</dd>
		<dt><?php echo __('Currency');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['currency'];?>
&nbsp;</dd>
		<dt><?php echo __('Currencycode');?></dt>
		<dd>
	<?php echo $contact['BirthCountry']['currencycode'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Birth Country'), array('controller' => 'countries', 'action' => 'edit', $contact['BirthCountry']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Regions');?></h3>
	<?php if (!empty($contact['ResRegion'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['ResRegion']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['ResRegion']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region');?></dt>
		<dd>
	<?php echo $contact['ResRegion']['region'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['ResRegion']['code'];?>
&nbsp;</dd>
		<dt><?php echo __('Adm1code');?></dt>
		<dd>
	<?php echo $contact['ResRegion']['adm1code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Res Region'), array('controller' => 'regions', 'action' => 'edit', $contact['ResRegion']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Regions');?></h3>
	<?php if (!empty($contact['BusRegion'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BusRegion']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['BusRegion']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region');?></dt>
		<dd>
	<?php echo $contact['BusRegion']['region'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['BusRegion']['code'];?>
&nbsp;</dd>
		<dt><?php echo __('Adm1code');?></dt>
		<dd>
	<?php echo $contact['BusRegion']['adm1code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Bus Region'), array('controller' => 'regions', 'action' => 'edit', $contact['BusRegion']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Regions');?></h3>
	<?php if (!empty($contact['BirthRegion'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BirthRegion']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['BirthRegion']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region');?></dt>
		<dd>
	<?php echo $contact['BirthRegion']['region'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['BirthRegion']['code'];?>
&nbsp;</dd>
		<dt><?php echo __('Adm1code');?></dt>
		<dd>
	<?php echo $contact['BirthRegion']['adm1code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Birth Region'), array('controller' => 'regions', 'action' => 'edit', $contact['BirthRegion']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Cities');?></h3>
	<?php if (!empty($contact['ResCity'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['ResCity']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['ResCity']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region Id');?></dt>
		<dd>
	<?php echo $contact['ResCity']['region_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['ResCity']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Latitude');?></dt>
		<dd>
	<?php echo $contact['ResCity']['latitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Longitude');?></dt>
		<dd>
	<?php echo $contact['ResCity']['longitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Timezone');?></dt>
		<dd>
	<?php echo $contact['ResCity']['timezone'];?>
&nbsp;</dd>
		<dt><?php echo __('Dmaid');?></dt>
		<dd>
	<?php echo $contact['ResCity']['dmaid'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['ResCity']['code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Res City'), array('controller' => 'cities', 'action' => 'edit', $contact['ResCity']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Cities');?></h3>
	<?php if (!empty($contact['BusCity'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BusCity']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['BusCity']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region Id');?></dt>
		<dd>
	<?php echo $contact['BusCity']['region_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['BusCity']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Latitude');?></dt>
		<dd>
	<?php echo $contact['BusCity']['latitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Longitude');?></dt>
		<dd>
	<?php echo $contact['BusCity']['longitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Timezone');?></dt>
		<dd>
	<?php echo $contact['BusCity']['timezone'];?>
&nbsp;</dd>
		<dt><?php echo __('Dmaid');?></dt>
		<dd>
	<?php echo $contact['BusCity']['dmaid'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['BusCity']['code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Bus City'), array('controller' => 'cities', 'action' => 'edit', $contact['BusCity']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Cities');?></h3>
	<?php if (!empty($contact['BirthCity'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Country Id');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['country_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Region Id');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['region_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Name');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['name'];?>
&nbsp;</dd>
		<dt><?php echo __('Latitude');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['latitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Longitude');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['longitude'];?>
&nbsp;</dd>
		<dt><?php echo __('Timezone');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['timezone'];?>
&nbsp;</dd>
		<dt><?php echo __('Dmaid');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['dmaid'];?>
&nbsp;</dd>
		<dt><?php echo __('Code');?></dt>
		<dd>
	<?php echo $contact['BirthCity']['code'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Birth City'), array('controller' => 'cities', 'action' => 'edit', $contact['BirthCity']['id'])); ?></li>
			</ul>
		</div>
	</div>
	