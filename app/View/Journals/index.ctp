		<!--Start middle Container-->

		<div id="middleCntr">	
			<!-- Start content container -->
			<div id="contentCntr">				
				<div>			
				
					<!-- Start of Profile Left bar -->	
						
						<div id="leftCntr">
							<?php echo $this->element('profile/profile_image_0'); ?>
							<?php echo $this->element('profile/alphaworldmap'); ?>
							<?php echo $this->element('profile/side_navigation'); ?>
							</div>
					
						
					<!-- End of Profile Left bar -->	

					<!-- Start right container -->
					<div id="rightCntr">
						<!-- Start rgtCntrleft -->

						<div class="rgtCntrleft">					
							<!--Start event Box-->
							<div class="eventBox">
							
								<div class="bluBar">My Alpha Journals Entries</div>
								<?php
									
									if(is_array($arrObjJournal) && count($arrObjJournal) > 0){
										foreach ($arrObjJournal as $objJournal){
											echo $this->element('journals/journal_row',array('objJournal'=>$objJournal));
										}
									}else{
										?>
										    <div class="alert">
										    	<p style="text-align: justify;">You do not currently have any Journal Entries at this time.  Please click here to <?php echo $this->Html->link('Add New Journal Entry', array('controller' => 'journals', 'action'=> 'add')) ?>.
												No autobiography would be complete without this, so go ahead and start entering all your important memories and achievements.</p>
										    </div>
										<?php
									}
								?>
								<!--End advantureBar -->
							</div>
							<!-- End event Box -->																														
						</div>
						<!-- End rgtCntrleft -->
						<!-- Start rgtCntrright -->
							<?php echo $this->element('journals/add_journal_rightbar_1'); ?>				
						<!-- End right container -->
					<div class="clr"></div>	
				</div>																								
			</div>

			<!-- End content container -->
		</div>
		<!-- End middle container -->		
