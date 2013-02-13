<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">			
		<div class="">			
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
			<?php
			if(is_array($pictures) && (count($pictures) > 0)){
			?>
							<div class="strachbar">
								<div class="ltside">
									<div class="rtside">
										<div class="fl">Your pictures</div>
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
											echo $this->Html->image($picture['Picture']['url'].$picture['Picture']['w90'],array('width' => '90')); 
											
											 if ($picture['Picture']['id'] != $picture['User']['picture_id']){ 
											 	echo $this->Form->postLink($this->Html->image('checkmark.jpg', array('style'=>'height:13px;width:13px;')), 
											 				array('action' => 'editUser', $picture['Picture']['id']),
															array('escape'=> false),
											 				__('Are you sure you want to choose # %s?', $picture['Picture']['id']));
										?>
										<?php
											  
												echo $this->Form->postLink($this->Html->image('delete.png', array('style'=>'height:13px;width:13px;')), 
															array('controller'=>'pictures', 'action'=>'delete',$picture['Picture']['id']),
															array('escape'=> false),
															__('Are you sure you want to delete # %s?',$picture['Picture']['id'])); 
											 }				
										?>
									</div>
								</div>
								<?php 
							 		endforeach; 
							 	?>
							</div><br clear="all"><br clear="all">
		<?php 
} 
?>
							<div class="strachbar">
								<div class="ltside">
									<div class="rtside">
										<div class="fl">Upload a new picture</div>
										<div class="clr"></div>
									</div>
								</div>
							</div>
							<div class="addpictbox">
								<?php 
									echo $this->Form->create('Picture', array('type' => 'file'));
									echo $this->Form->input('upload', array(
																		'type' => 'file',
																		'label'=>false,
																		'onchange'=> "document.getElementById('sbmtbtn').style.display = 'block'"));
								?>
								<div id="sbmtbtn"><?php echo $this->Form->end(__('Submit'));?></div>
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
