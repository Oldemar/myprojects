<script>
$(document).ready(function(){
	$('.ctooltip').tooltip();
});
</script>
<div class="albumPhoto" id="albumPhoto<?php echo $sharingLevel; ?>">
	<?php 
	$objJournal->buildHasMany('Photo');
	if ( $objJournal->getPhotosPerSharingLevel($sharingLevel) > 0 ) {
	?>
	<div id="alertIE"></div>
	<script>
		if ($.browser.msie) {
			$('#alertIE').replaceWith("<div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" style=\"float:right\">x</button><strong>Warning!</strong> You may experience a few minor issues when viewing LivingAlpha using Internet Explorer.  For optimum results, we recommend using Chrome or Mozilla-Firefox.<br>Thank you for your understanding.</div></div");

		}
	</script>
	<ul id="ulAlbumPhoto<?php echo $sharingLevel; ?>">
		<?php
			foreach ( $objJournal->Photo as $photo ) : 
				if ( $photo->getAttr('sharing_level') == $sharingLevel ) {
		?>

		<li id="liphoto_<?php echo $photo->getID(); ?>">
			<div>
				<div id="photo_<?php echo $photo->getID(); ?>" class="photolist" style="background-image:url(<?php echo $photo->getAttr('url').$photo->getAttr('w240'); ?>)">
				
				<?php if($objJournal->checkIfIsTheOwner($objLoggedUser)){ ?>
					<div id="photoOver<?php echo $photo->getID(); ?>" style="display:none;background-color: rgba(0, 0, 2, 0.3);">
						<div style="border-bottom:1px solid #fff;width:174px;line-height:25px">
							<a href="#" id="photoDesc_<?php echo $photo->getID() ; ?>" style="color: white; font-weight: bold; padding-left: 10px;">
							<?php 
								echo ($photo->getAttr('description') == null ? 'Add a description...' : substr($photo->getAttr('description'),0,20));
							?>
							</a>
						</div>
						<div id="photoActions_<?php echo $photo->getID(); ?>" style="border-top:1px solid #fff;color:white;font-weight:bold;position:relative;top:120px;width:174px;height:25px;z-index:100;">
				
							<div style="float:right;padding:3px 2px 0 0;">
								<?php if ($photo->getID() != $objJournal->getAttr('photo_id')) { ?>
								<a href="javascript:;" id="saveCover_<?php echo $photo->getID(); ?>" style="padding:5px 5px 6px 5px;border-left:1px solid #fff">
									<i class="icon-ok icon-white"></i>
								</a>
								<?php } ?>
								<a href="javascript:;" id="btnDeletePhoto<?php echo $photo->getID(); ?>"  style="padding:5px 5px 6px 5px;border-left:1px solid #fff">
									<i class="icon-trash icon-white"></i>
								</a>
							</div>
							<script>
								$('#btnDeletePhoto<?php echo $photo->getID(); ?>').click(function() {
									  	$.ajax({
							    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'delete', $photo->getID(),$objJournal->getID())); ?>",
							    			  dataType: 'json',
							    			  type: "POST",
							    			  success: function(ajaxReturn,textStatus,xhr){
							    				  $('#albumPhoto<?php echo $sharingLevel; ?>').replaceWith(ajaxReturn.content);	
							   			  },
										  beforeSend: function(j, s){
											  $("#liphoto_<?php echo $photo->getID(); ?>").detach();
										  }	  
										});
										
								    	
								});
							</script>
									
							<script>
								$('#saveCover_<?php echo $photo->getID(); ?>').click(function() {
									  	$.ajax({
							    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'saveCover', $photo->getID(), $objJournal->getID())); ?>",
							    			  dataType: 'json',
							    			  type: "POST",
							    			  success: function(){
												$("#saveCover_<?php echo $photo->getID(); ?>").detach();
										  }	  
										});
								    	
								});
									
							</script>
							<div style="float:left; padding:2px; border-right:1px solid #fff">
								<div class="btn-group dropup">
									<?php if ($sharingLevel == 2 ) { ?>
									<button id="btnSharingLevel_<?php echo $photo->getID() ; ?>" class="btn btn-success btn-mini dropdown-toggle" data-toggle="dropdown">G</button>
									<?php } elseif ($sharingLevel == 1) { ?>
									<button id="btnSharingLevel_<?php echo $photo->getID() ; ?>" class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">F</button>
									<?php  } else { ?>
									<button id="btnSharingLevel_<?php echo $photo->getID() ; ?>" class="btn btn-danger btn-mini dropdown-toggle" data-toggle="dropdown">P</button>
									<?php  } ?>
									<ul class="dropdown-menu"  style="width:125px;">
										<?php 
						  					if ($sharingLevel != 2 && $objJournal->getPhotosPerSharingLevel('2') < 25 ) { 
										?>
										<li style="color:green;height:25px; padding: 2px 5px;">
											<a href="javascript:" id="btnSharingLevelG_<?php echo $photo->getID() ; ?>" style="padding: 2px 5px; float:left; width: 125px; text-align:left">
												<button class="btn btn-success btn-mini">
													G
												</button>
												Move to Global
											</a>
										</li>
										<?php 
											} 
											if ($sharingLevel != 1 && $objJournal->getPhotosPerSharingLevel('2') < 25 ) { 
										?>
										<li style="color:blue;height:25px; padding: 2px 5px;">
											<a href="javascript:" id="btnSharingLevelF_<?php echo $photo->getID() ; ?>" style="padding: 2px 5px; float:left; width: 125px text-align:left">
												<button  class="btn btn-primary btn-mini">
													F
												</button> 
												Move to Friend
											</a>
										</li>
										<?php
											} 
											if ($sharingLevel != 0  && $objJournal->getPhotosPerSharingLevel('2') < 25 ) { 
										?>
										<li style="color:red;height:25px; padding: 2px 5px;">
											<a href="javascript:" id="btnSharingLevelP_<?php echo $photo->getID() ; ?>" style="padding: 2px 5px; float:left; width: 125px text-align:left">
												<button  class="btn btn-danger btn-mini">
													P
												</button> 
												Move to Private
											</a>
										</li>
										<?php  
											} 
										?>
									</ul>
								</div>
							</div>
							<script>
								$('#btnSharingLevelG_<?php echo $photo->getID(); ?>').click(function() {
									  	$.ajax({
							    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'saveSharingLevel', $photo->getID(), '2')); ?>",
							    			  dataType: 'json',
							    			  type: "POST",
							    			  success: function(ajaxReturn,textStatus,xhr){
												  if (ajaxReturn.error == 0) {
														$("#liphoto_<?php echo $photo->getID(); ?>").detach();
							    				  		$('#albumPhoto2').replaceWith(ajaxReturn.content);	
												  } else {
													  $("#liphoto_<?php echo $photo->getID(); ?>").css("display", "block");
												  }
							    			  							   			  },
										  beforeSend: function(j, s){
											  $("#liphoto_<?php echo $photo->getID(); ?>").detach();
										  }	  
							    		});
								    	
								});
									
								$('#btnSharingLevelF_<?php echo $photo->getID(); ?>').click(function() {
								  	$.ajax({
										url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'saveSharingLevel', $photo->getID(), '1')); ?>",
						    				dataType: 'json',
						   					type: "POST",
						    				success: function(ajaxReturn,textStatus,xhr){
												  if (ajaxReturn.error == 0) {
														$("#liphoto_<?php echo $photo->getID(); ?>").detach();
							    				  		$('#albumPhoto1').replaceWith(ajaxReturn.content);	
												  } else {
													  $("#liphoto_<?php echo $photo->getID(); ?>").css("display", "block");
												  }
						    										   			  		},
									  		beforeSend: function(j, s){
												$("#liphoto_<?php echo $photo->getID(); ?>").detach();
									  		}	  
						    		});
							    	
								});
								
								$('#btnSharingLevelP_<?php echo $photo->getID(); ?>').click(function() {
									  	$.ajax({
							    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'saveSharingLevel', $photo->getID(), '0')); ?>",
							    			  dataType: 'json',
							    			  type: "POST",
							    			  success: function(ajaxReturn,textStatus,xhr){
												  if (ajaxReturn.error == 0) {
														$("#liphoto_<?php echo $photo->getID(); ?>").detach();
							    				  		$('#albumPhoto0').replaceWith(ajaxReturn.content);	
												  } else {
													  $("#liphoto_<?php echo $photo->getID(); ?>").css("display", "block");
												  }
							   			  },
										  beforeSend: function(j, s){
											  $("#liphoto_<?php echo $photo->getID(); ?>").css("display", "none");
										  }	  
							    		});
								    	
								});
								
							</script>
							
						</div>
						<script> 
							$(function () { 
								
								$("#photoDesc_<?php echo $photo->getID() ; ?>").popover({
										trigger 	: 'click',
										title		: 'Description',
										placement	: 'left',
										html		: true,
										content		: '<?php
															$photodesc = "" ;
															echo $this->Form->create('Photo', array('action'=>'saveDesc')) ; 
															echo $this->Form->input('id', array('type'=>'hidden','value'=>$photo->getID()));
															echo $this->Form->input('journal_id', array('type'=>'hidden','value'=>$objJournal->getID()));
															echo $this->Form->input('description', array(
																						'label'=>false,
																						'div'=>false,
																						'type'=>'text',
																						'style'=>'padding:5px;margin-top:7px',
																						'value'=>$photo->getAttr('description')));
															echo $this->Form->submit('Save', array('style'=>'padding:5px;float:right'));
															echo $this->Form->end();
														?>'
								});
							});  
						</script>
<!-- 						<a href="<?php //echo $this->Html->url(array('controller'=>'photos','action'=>'photo',$photo->getID(),$objJournal->getID())); ?>"> -->
						<a href="javascript:" id="photoLghtBox_<?php echo $photo->getID(); ?>">
							<div style="position:relative;top:25px;width:174px; height:122px;"></div>
						</a>
						<script>
						$('#photoLghtBox_<?php echo $photo->getID(); ?>').click(function() {
							if (!$.browser.msie) {
							  	$.ajax({
					    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'photo', $photo->getID(), $objJournal->getID())); ?>",
					    			  dataType: 'html',
					    			  type: "POST",
					    			  success: function(ajaxReturn,textStatus,xhr){
					    				  $('#photoModal').modal("show");
					    				  $('#modalContent').html(ajaxReturn);
					    				  		//$('#lightbox').css('display','block');
					   				  },
					   				  beforeSend: function(){
					   					$('#photoModal').modal("show");
					   					$('#modalContent').html('Loading');
					   				  }	  
					    		});
							}	
						});
						</script>
					</div>
					<?php } ?>
				</div>
				<?php if($objJournal->checkIfIsTheOwner($objLoggedUser)){?>
				<script type="text/javascript">
					$(function(){
						$("#photo_<?php echo $photo->getID(); ?>").mouseover(function() {
							$("#photoOver<?php echo $photo->getID(); ?>").css("display","block");
						}).mouseout(function() {
							$("#photoOver<?php echo $photo->getID(); ?>").css("display","none");
						})
					});
				</script>
				<?php } ?>
			</div>
		</li>
		<?php 
				}
			endforeach; 
		?>
	</ul>
	<?php 
	} else {
	?>
	<div class="alert alert-block" style="text-align: justify">
		<p>
			You currently do not have any photo uploaded for this Sharing Level. 	</p>
	</div>
	<?php 
	}
	?>
</div>

