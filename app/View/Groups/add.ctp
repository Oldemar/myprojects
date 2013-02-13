<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
				
		<div class="cntrCntr">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>


			</div>
			<!-- End of Profile Left bar -->	
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft">
					<div class="eventBox">	
					<div class="bluBar">Add Group</div>			
					<!--Start event Box-->

						<?php 
							echo $this->Form->create('Group', array('type'=>'file'));
						
								echo $this->Form->input('user_id', array(
											'type'=>'hidden',
											'value'=>Authcomponent::user('id')));
						?>
						

<style>
.row.rwidth{
	margin-left: 2px;
}

.span2.swidth{
	width: 100px;
	margin-top: 0.5em;
}
.span3 {
	margin-top: 0.5em;
}

.inputWidth{
	width: 200px;
}
	
</style>
							<div class="friendYellowbar gadd">
								<div class="row rwidth" >
							    <div class="span2 swidth" >Group Name</div>
							    <div class="span3"><?php 
											echo $this->Form->input('name', array(
																	'div'=>false,
																	'label'=>false,
																	'class' =>'profileInpt',
																	'placeholder' => 'e.g. My closer friends',
																	'class' => 'inputWidth',
																	'onblur'=>'replaceText(this)')); 
									?></div>
								<div class="span1"><?php echo $this->Form->submit(__('Save')); ?></div>
							    </div>
							</div>
							<?php
							/*
							 *  Params to be passed
							 *  usertobeshow => An array that contains the users to be shown
							 *  elementactions => the element that contains the actions to be shown
							 */ 
							$this->set('isins','');
							$this->set('isdel','');
							$this->set('isedt','');
							$this->set('ischk',1);
							$this->set('isspec','');
							
							?>

							<div class="flist">
								
									<?php
									
									//echo $this->element('Groups/list_friend', array('arrayObjFriend'=>$arrayObjFriend));
									?>
							</div>
							<?php
							
							/*
							echo $this->element('usersmlbox', array(
												'usertobeshow'=>$friendlist,
												'elementactions'=>'addfriendgroup'
												));
							 
							 * 
							 */
							 
						?>										
						
					<?php 				
						echo $this->Form->end();
					?>
					</div>	
					<!-- End event Box -->																						
				</div>
				<div class="rgtCntrright"  style="padding-top: 15px;">
					<div class="groupbutton" style="margin-left: 70px;">
						<a class="btn btn-success" href="/groups/"><i class="icon-plus icon-white"></i>Your Groups</a>
					</div>
				</div>
				<!-- Start rgtCntrright -->
					<?php echo $this->element('profile/profile_right_column'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<div class="clr"></div>
			<!-- End right container -->

	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->		
<?php 

$this->Js->get('#group_id')->event('change', 
	$this->Js->request(array(
		'controller'=>'groups',
		'action'=>'getByGroup',
		), array(
		'update'=>'#userbygroup',
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
