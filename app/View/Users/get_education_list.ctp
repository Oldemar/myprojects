<div id="educationList">
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

			<th class="actions"><?php echo __('Actions');?></th>
	</tr>

	<?php
	
	foreach ($educations as $education): ?>
	<tr id="educationrow_<?php echo $education['Education']['id']; ?>" >

		<td class="edulevel" >
			<?php echo h($education['Edulevel']['name']); ?>
		
			<?php echo $this->Form->hidden('eduleveid_'.$education['Education']['id'],array('id'=>'eduleveid_'.$education['Education']['id'],'value'=>$education['Edulevel']['id']))?>
		</td>
		<td class="institute" >
			<?php echo h($education['Institute']['name']); ?>
			<?php echo $this->Form->hidden('instituteid_'.$education['Education']['id'],array('id'=>'instituteid_'.$education['Education']['id'],'value'=>$education['Institute']['name']))?>
		</td>
		<td class="startdate" >
			<?php echo h($education['Education']['start_date']); ?>&nbsp;
			<?php echo $this->Form->hidden('startdate_'.$education['Education']['id'],array('id'=>'startdate_'.$education['Education']['id'],'value'=>$education['Education']['start_date']))?>
		</td>
		<td  class="enddate"">
			<?php $labeldate = empty($education['Education']['end_date'])? 'Present': $education['Education']['end_date']; ?>
			<?php echo h($labeldate); ?>&nbsp;
			<?php 
			//if the End_date is not defined, then it's will be the current date by default
			$endDate = empty($education['Education']['end_date'])? 'End Date':$education['Education']['end_date'];
			?>
			<?php echo $this->Form->hidden('enddate_'.$education['Education']['id'],array('id'=>'enddate_'.$education['Education']['id'],'value'=>$endDate))?>	
		</td>
		<td class="description">
			<?php echo h($education['Education']['description']); ?>&nbsp;
			<?php echo $this->Form->hidden('description_'.$education['Education']['id'],array('id'=>'description_'.$education['Education']['id'],'value'=>$education['Education']['description']))?>
		</td>

		<td class="perm">
		
		
		<?php 
			if (!$education['Education']['perm']) echo $this->Html->image('P.jpg');
			else echo $this->Html->image($cl_i = ($education['Education']['perm'] == 1 ? $cl_i = 'F.jpg' : $cl_i = 'G.jpg')) 
		?> 
		<?php echo $this->Form->hidden('perm_'.$education['Education']['id'],array('id'=>'perm_'.$education['Education']['id'],'value'=>$education['Education']['perm']))?>
		</td>


		<td class="actions">
			<div class="eduedit" id="eduid_<?php echo $education['Education']['id']; ?>"><?php echo __('Edit'); ?></div>
			<div class="deleteit" id="eduid_<?php echo $education['Education']['id']; ?>"><?php echo __('Delete'); ?></div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php } ?>
<!-- END Education List -->		
</div>