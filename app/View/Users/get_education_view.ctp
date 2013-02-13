
<!-- Education List -->
<?php if(count($educations) > 0){ ?>
<div class="educations index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Education Level');?></th>
			<th><?php echo __('Institute');?></th>
			<th><?php echo __('Start');?></th>
			<th><?php echo __('End');?></th>
			<th><?php echo __('Description');?></th>
			
			<th><?php echo __('Access');?></th>

	</tr>

	<?php
	
	foreach ($educations as $education): ?>
	<tr id="educationrow_<?php echo $education['Education']['id']; ?>" >

		<td class="edulevel" >
			<?php echo h($education['Edulevel']['name']); ?>
		
		</td>
		<td class="institute" >
			<?php echo h($education['Institute']['name']); ?>
		</td>
		<td class="startdate" >
			<?php echo h($education['Education']['start_date']); ?>&nbsp;
		</td>
		<td  class="enddate"">
			<?php $labeldate = empty($education['Education']['end_date'])? 'Present': $education['Education']['end_date']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($education['Education']['end_date'])? 'End Date':$education['Education']['end_date'];
			?>
		</td>
		<td class="description">
			<?php echo h($education['Education']['description']); ?>&nbsp;
		</td>

		<td class="perm">
		
		
		<?php 
			if (!$education['Education']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($education['Education']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
		?> 
		</td>


	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
<!-- END Education List -->		
