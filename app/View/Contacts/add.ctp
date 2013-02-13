<div class="contacts form">
<?php echo $this->Form->create('Contact');?>
	<fieldset>
		<legend><?php echo __('Add Contact'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('res_country_id');
		echo $this->Form->input('res_region_id');
		echo $this->Form->input('res_city_id');
		echo $this->Form->input('res_address_1');
		echo $this->Form->input('res_address_2');
		echo $this->Form->input('res_zip');
		echo $this->Form->input('mobilephone');
		echo $this->Form->input('homephone');
		echo $this->Form->input('workphone');
		echo $this->Form->input('bus_country_id');
		echo $this->Form->input('bus_region_id');
		echo $this->Form->input('bus_city_id');
		echo $this->Form->input('bus_address_1');
		echo $this->Form->input('bus_address_2');
		echo $this->Form->input('bus_zip');
		echo $this->Form->input('birth_country_id');
		echo $this->Form->input('birth_region_id');
		echo $this->Form->input('birth_city_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contacts'), array('action' => 'index'));?></li>
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
<?php
$this->Js->get('#ContactResRegionId')->event('change', 
	$this->Js->request(array(
		'controller'=>'cities',
		'action'=>'getByRegion'
		), array(
		'update'=>'#ContactResCityId',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
?>