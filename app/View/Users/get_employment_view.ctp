
<?php if(count($works) > 0){ ?>
<div class="educations index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Specialty');?></th>
			<th><?php echo __('Workplace');?></th>
			<th><?php echo __('Start');?></th>
			<th><?php echo __('End');?></th>
			<th><?php echo __('Location');?></th>
			
			<th><?php echo __('Access');?></th>

	</tr>

	<?php
	
	foreach ($works as $work): ?>
	<tr id="workrow_<?php echo $work['Work']['id']; ?>" >

		<td class="specialty" >
			<?php echo h($work['Specialty']['name']); ?>
		
		</td>
		<td class="workplace" >
			<?php echo h($work['Workplace']['name']); ?>
		</td>
		<td class="startdate" >
			<?php echo h($work['Work']['start_date']); ?>&nbsp;
		</td>
		<td  class="enddate"">
			<?php $labeldate = empty($education['Education']['end_date'])? 'Present': $education['Education']['end_date']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($work['Work']['end_date'])? 'End Date':$work['Work']['end_date'];
			?>
		</td>
		<td class="description">
			<?php echo h($work['Workplace']['location']); ?>&nbsp;
		</td>
		<td class="perm">
		
		<?php 
		
			if (!$work['Work']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($work['Work']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')); 
		 
		
		 ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
