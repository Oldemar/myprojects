<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt" style="padding-top:11px;">
					<?php echo $userFullName . '\'s Groups'; ?>
					<div class="addjournalbtn">
						<?php echo $this->Html->link('Your Groups', array('controller' => 'groups', 'action'=> 'index')) ?>
					</div>
				</div>
			</div>		
		</div>				
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
				<?php echo $this->Form->create('Group', array('type'=>'file')); ?>					
					<!--Start event Box-->
					<div class="eventBox">
						<?php
							
							echo $this->Form->input('id', array('type'=>'hidden'));
						?>
						<div class="bluBar">
							Edit Group <?php echo $this->data['Group']['name'] ?>
						</div>
						<div class="friendgryTop">
							<div class="friendYellowbar">
								<div class="fldline">
									<div class="profileLable">Group Name</div>
									<div class="profileFld">
							<?php 
									echo $this->Form->input('name', array(
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); 
							?>
									</div>									
									<div class="clr"></div>
								</div>
								<div class="fldline">
									<div class="profileLable">
										<?php
											//echo $this->Html->image($group['Group']['image'], array('width'=>'40','height'=>'35'))
										?>
									</div>
									<!-- <div class="profileFld">
							<?php 
								//echo $this->Form->input('image', array('type'=>'hidden'));
								/*echo $this->Form->input('imagefile', array(
													'type'=>'file',
													'div'=>false,
													'label'=>false,
													'class' =>'profileInpt',
													'onblur'=>'replaceText(this)')); */


							?>
						
									</div>			 -->						
									<div class="clr"></div>
								</div>
							</div>
						<div id="userbygroup">

								<div id="resultGroupSearch"  >
									<?php 
										
										if(isset($objGroup)){
											
											echo $this->element('Groups/search_group'); 
										}
									?>
								</div>									
						</div>

					</div>							
				</div>
					<!-- End event Box -->																							
					<?php 	echo $this->Form->end('Submit'); ?>
				</div>
				
				<!-- Start rgtCntrright -->
					<?php echo $this->element('profile/profile_right_column'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<div class="clr"></div>
			<!-- End right container -->

	</div>
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
