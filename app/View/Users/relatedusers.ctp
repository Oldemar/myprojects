<?php
//	echo "<pre>".print_r($relatedusers,true)."</pre>";
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
									echo $userFullName. '<span>\'s Profile</span>';
							?>
							</div>
							<div class="clr"></div>
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
						<!-- Start rgtCntrleft -->

						<div class="rgtCntrleft">					
							<!--Start event Box-->
							<div class="eventBox">
							
								<div class="expandable selected"><a href="#">Related Users</a></div>
								<div>
									<div id="frndLst">
									<?php
										$classj[0] = 'alternativeBarNew';
										$classj[1] = 'advantureBarNew';
										$cl_i = 1;
										foreach ($relatedusers as $relateduser) : 
											$cl_i = ($cl_i == 0 ? $cl_i = 1 : $cl_i = 0);
									?>
									<div class="<?php echo $classj[$cl_i] ; ?>">
										
										<div class="tpPart">
											<div class="btPart">
												<div class="dreamimage">
												<?php
												if ( isset($relateduser['Picture']['name']) && $relateduser['Picture']['name'] != null ) {
													echo $this->Html->link($this->Html->image($relateduser['Picture']['name'], array('width'=>'55')), 
																			array('controller'=>'users', 'action' => 'profile', $relateduser['User']['id']),
																			array('escape'=> false)); 
												} else {
													echo $this->Html->link($this->Html->image('nopicture.gif', array('width'=>'55')), 
																			array('controller'=>'users', 'action' => 'profile', $relateduser['User']['id']),
																			array('escape'=> false)); 
												}
												?>
												</div>											
												<div class="dreamtext">
													<div class="hd">
														<a href='profile/<?php print($relateduser['User']['id']); ?>'>
														<?php 
															echo $relateduser['User']['firstname']." ".$relateduser['User']['lastname'] ; 
														?>
														</a>
													</div>												
													<br>Relationship : 
													<?php 
														echo $relateduser['Relation_B']['0']['Relationship_B']['name'] ; 
													?>												
												</div>														
												<div class="clr"></div>															
											</div>
										</div>										
										
									</div>
									<?php
										endforeach;
									?>
									</div>
								<br>									
								</div>
							</div>
							<!-- End event Box -->																														
						</div>
						<!-- End rgtCntrleft -->
						<!-- Start rgtCntrright -->
							<?php echo $this->element('profile/profile_right_column'); ?>				
						<!-- End right container -->
						<div class="clr"></div>	
					</div>																								
				</div>
			</div>
			<!-- End content container -->
		</div>
		<!-- End middle container -->		
		
