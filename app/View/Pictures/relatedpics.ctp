
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="fl">
					<?php 
						if ($users['Tutor'] != null) {
							echo $users['User']['firstname'] . ' ' . $users['User']['lastname'];
							if ($users['Tutor']['id'] != null) {
								echo '<span>\'s Profile related to </span>' . $users['Tutor']['firstname'] . ' ' . $users['Tutor']['lastname'];
							} else {
								echo '<span>\'s Profile</span>';
							}
						} else {
							echo $userFullName. '<span>\'s Profile</span>';
						}
					?>
					</div>

					<div class="clr"></div>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
			<!-- Start of Profile Left bar -->	
				<?php echo $this->element('Pictures/left_column'); ?>		
			<!-- End of Profile Left bar -->
			
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div class="rgtCntrleft">		
					<div class="midTop">
						<!--Start profileform -->
						<div class="profileform">
							<div class="strachbar">
								<div class="ltside">
									<div class="rtside">
										<div class="fl">Your Pictures</div>
										<div class="clr"></div>
									</div>
								</div>
							</div>
							<div class="pictcontainer">
								<?php
									foreach ($pictures as $picture): 
										if ($picture['Picture']['id'] != $picture['User']['picture_id']) 
								?>
								<div class="pictbg">
									<div class="pictbox">
										<?php 
											echo $this->Html->image($picture['Picture']['name'],array('width' => '65')); 
											 if ($picture['Picture']['id'] != $picture['User']['picture_id']) 
											 	echo $this->Form->postLink($this->Html->image('checkmark.jpg', array('height'=>'13')), 
											 				array('action' => 'editUser', $picture['Picture']['id']),
															array('escape'=> false),
											 				__('Are you sure you want to choose # %s?', $picture['Picture']['id']));
										?>
										<?php
											 if ($picture['Picture']['id'] != $picture['User']['picture_id']) 
												echo $this->Form->postLink($this->Html->image('delete.png', array('height'=>'13')), 
															array('controller'=>'pictures', 'action'=>'delete',$picture['Picture']['id']),
															array('escape'=> false),
															__('Are you sure you want to delete # %s?',$picture['Picture']['id'])); 
										?>
									</div>
								</div>
								<?php 
							 		endforeach; 
							 	?>
								 <div class="addpictbox">
									<?php 
										echo $this->Form->create('Picture', array('type' => 'file'));
										echo $this->Form->input('user_id', array('type'=>'hidden','value'=>$picture['User']['id']));
										echo $this->Form->input('url', array('type'=>'hidden'));
										echo $this->Form->input('name', array(
																			'type' => 'file',
																			'label'=>false,
																			'onchange'=> "document.getElementById('sbmtbtn').style.display = 'block'"));
									?>
									<div id="sbmtbtn"><?php echo $this->Form->end(__('Submit'));?></div>
							 	</div>
							</div>
						</div>
						<!--End profileform -->																													
					</div>
				</div>		
				<!-- End rgtCntrleft -->
				<!-- Start rgtCntrright -->
					<?php echo $this->element('profile/profile_right_column'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
			<div class="clr"></div>	
		</div>																								
	</div>

	<!-- End content container -->
</div>
<!-- End middle container -->		
