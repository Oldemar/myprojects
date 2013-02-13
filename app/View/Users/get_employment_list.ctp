<div id="employmentList">

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

			<th class="actions"><?php echo __('Actions');?></th>
	</tr>

	<?php
	
	foreach ($works as $work): ?>
	<tr id="workrow_<?php echo $work['Work']['id']; ?>" >

		<td class="specialty" >
			<?php echo h($work['Specialty']['name']); ?>
		
			<?php echo $this->Form->hidden('specaltyid_'.$work['Work']['id'],array('id'=>'specialtyid_'.$work['Work']['id'],'value'=>$work['Specialty']['name']))?>
		</td>
		<td class="workplace" >
			<?php echo h($work['Workplace']['name']); ?>
			<?php echo $this->Form->hidden('workplaceid_'.$work['Work']['id'],array('id'=>'workplaceid_'.$work['Work']['id'],'value'=>$work['Workplace']['name']))?>
		</td>
		<td class="startdate" >
			<?php echo h($work['Work']['startdate']); ?>&nbsp;
			<?php echo $this->Form->hidden('startdate_'.$work['Work']['id'],array('id'=>'wstartdate_'.$work['Work']['id'],'value'=>$work['Work']['startdate']))?>
		</td>
		<td  class="enddate"">
			<?php $labeldate = ($work['Work']['enddate'] == '999-99-99')? 'Present': $work['Work']['enddate']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($work['Work']['enddate'])? 'End Date':$work['Work']['enddate'];
			?>
			<?php echo $this->Form->hidden('enddate_'.$work['Work']['id'],array('id'=>'wenddate_'.$work['Work']['id'],'value'=>$endDate))?>	
		</td>
		<td class="description">
			<?php echo h($work['Workplace']['location']); ?>&nbsp;
			<?php echo $this->Form->hidden('location_'.$work['Work']['id'],array('id'=>'wlocation_'.$work['Work']['id'],'value'=>$work['Workplace']['location']))?>
			<?php echo $this->Form->hidden('description_'.$work['Work']['id'],array('id'=>'wdescription_'.$work['Work']['id'],'value'=>$work['Work']['description']))?>
		</td>

		<td class="perm">
		
		
		<?php 
		
			if (!$work['Work']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($work['Work']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')); 
		 
		 	echo $this->Form->hidden('wperm_'.$work['Work']['id'],array('id'=>'perm_'.$work['Work']['id'],'value'=>$work['Work']['perm']));
		
		 ?>
		</td>


		<td class="actions">
			<div class="employmentit" id="workid_<?php echo $work['Work']['id']; ?>"><?php echo __('Edit'); ?></div>
			<div class="wdeleteit" id="deleteworkid_<?php echo $work['Work']['id']; ?>"><?php echo __('Delete'); ?></div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
</div>			