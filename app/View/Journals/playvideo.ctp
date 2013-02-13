<?php
//	echo "<pre>".print_r($journals,true)."</pre>" ;
?>
<!--Start middle Container-->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="fl">
						<?php 
								echo $this->Html->link(substr($journals['Journal']['title'],0,40). "... -  " . CakeTime::format('F jS, Y ', $journals['Journal']['date_event']),
																array('controller'=>'journals','action'=>'editnew',$journals['Journal']['id'])) ; 
						?>
					</div>

					<div class="clr"></div>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
			<!-- Start left container -->
				<div id="leftCntr">
					<?php echo $this->element('profile/user_image'); ?>
					<?php echo $this->element('profile/alphaworldmap'); ?>
					<?php echo $this->element('profile/side_navigation'); ?>
					</div>
			<!-- End left container -->
			<!-- Start right container -->
			<div id="rightCntr">
				<!-- Start rgtCntrleft -->

				<div class="rgtCntrleft">					
					<!--Start event Box-->
					<div class="eventBox">
						<!--start popupBox -->
						<div class="popupBox">
							<div class="botPart">
								<div class="midPart">
					
									<div class="midTop">					
										<div class="clr"></div>
										
									</div>
									<div class="midBottom">

										<a href="<?php echo $this->webroot; ?>img/<?php echo Configure::read('UUI').$video['Video']['url'].$video['Video']['name']; ?>.flv" style="display:block; width:515px; height:300px;" id="player"></a>

										<script language="JavaScript">
      										flowplayer("player", "<?php echo $this->webroot; ?>upvideos/flowplayer-3.2.12.swf");
    									</script>


										<br><br>
										<?php echo $this->Html->link('Back to Journal', array('action'=>'view', $journals['Journal']['id']) ,array('class'=>'next_button')) ?>
													
										
									</div>
									
								</div>
							</div>
						</div>
						<!--End popupBox -->
					</div>
					<!-- End event Box -->																														
				</div>
				<!-- End rgtCntrleft -->
				<!-- Start rgtCntrright -->
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
			<div class="clr"></div>	
		</div>																								
	</div>

	<!-- End content container -->
</div>
<!-- End middle container -->
