<?php 
//	echo CakeSession::read('shareduser')." - ".CakeSession::read('sharedemail');
//	echo "<pre>".print_r($shares,true)."</pre>";
//	echo "<pre>".print_r($journals,true)."</pre>";
?>
		<!--Start middle Container-->

		<div id="middleCntr">	
			<!-- Start content container -->
			<div id="contentCntr">
				<div class="headingBg">
					<div class="lt">
						<div class="rt">
							<div class="fl">Shared Journals for <?php echo $journals[0]['Share']['email']; ?></div>
							<div class="clr"></div>
						</div>
					</div>		
				</div>				
				<div class="cntrCntr">			
				
					<!-- Start of Profile Left bar -->	
						
						<div id="leftCntr">
							<?php echo $this->element('journals/share_img'); ?>
							<?php echo $this->element('profile/alphaworldmap'); ?>
						</div>
					
	     					
					<!-- End of Profile Left bar -->	

					<!-- Start right container -->
					<div id="rightCntr">
						<!-- Start rgtCntrleft -->

						<div class="rgtCntrleft">					
							<!--Start event Box-->
							<div class="eventBox">
								<div class="bluBar">Alpha Journals Entries</div>
								<?php
									$classj[0] = 'alternativeBarNew';
									$classj[1] = 'advantureBarNew';
									$cl_i = 1;
									$isfriend = 0;
									$allfriend = 0 ;
						 			$isallowed = 0 ;
									foreach ($journals as $journal) :
											$cl_i = ($cl_i == 0 ? $cl_i = 1 : $cl_i = 0); 
									?>
									<div class="ctJrnlIdx">
									<!--Start Bar -->
										<div class="<?php echo $classj[$cl_i] ; ?>">
											<div class="dreamimage">
												<?php
													$cover_ok = 0 ;
													foreach ($journal['Journal']['Photo'] as $photo):
														if ($photo['id']==$journal['Journal']['photo_id']) {
															echo $this->Html->image($photo['name'], array('width'=>'50', 'url' => array('controller' => 'journals', 'action' => 'shareview', $journal['Journal']['id']))) ;
															$cover_ok = 1 ;
															break;
															}
													endforeach;
													if (empty($journal['Journal']['Photo']) || (!$cover_ok)) { 
														echo $this->Html->image($journal['Journal']['Area']['image'] != null ? $journal['Journal']['Area']['image'] : 'nocover.jpg', array('width'=>'50', 'url' => array('controller' => 'journals', 'action' => 'shareview', $journal['Share']['id']))) ;
													}
												?>
											</div>											
											<div class="dreamtext">
												<div class="hd">
													<div class="grytxtsml2" style=""><?php echo CakeTime::format('F jS, Y ', h($journal['Journal']['date_event'])). ", ". h($journal['Journal']['location']); ?></div>
													<?php echo $this->Html->link($journal['Journal']['title'], array('controller' => 'journals', 'action' => 'shareview', $journal['Share']['id'])); ?>
												</div>
												<div class="jrnlTxt">
													<?php 
														if ($journal['Journal']['forall_description'] != null) {
															echo h(substr($journal['Journal']['forall_description'],0,200)."..."); 
														} else {
															echo h(substr($journal['Journal']['forgroup_description'],0,200)."..."); 
														}?>
												</div>
												<div class="bt">
													<?php 
														echo 	$journal['Journal']['User']['username'].
																	"<span> Posted this </span>".$journal['Journal']['Area']['name'].
																	"<span> Journal</span><br>"; 
													?>
													<div class="grytxtsml1"><?php echo CakeTime::timeAgoInWords(h($journal['Journal']['created'])); ?></div>
												</div>												
											</div>
											<div>													
												<?php
													$rate  = 0 ;
													$trate = 0 ;
													foreach ($journal['Journal']['Journalrate'] as $journalrate) :
														if ( $journalrate['user_id'] == $journal['Journal']['user_id'] ) {
															$rate += $journalrate['rate'];
															$trate++;
														}	
													endforeach;
													if ($rate) {
														$rate = round($rate/$trate);
														for ($x=1;$x<6;$x++) {
															if ($x <= $rate) {
																print("<img src=\"{$this->webroot}img/rating_icon.gif\" alt=\"\" />");
															} else {
																print("<img src=\"{$this->webroot}img/rating_icon_gry.gif\" alt=\"\" />");
															}
														}	
													} else { 
												?>
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_gry.gif" alt="" />
												<?php  } ?>
											</div>
											<div>
												<?php 
													if ($journal['Journal']['user_id'] == AuthComponent::user('id')) { 
														$totcomm0 = count($journal['Journal']['Comment']);
														$totcomm1 = 0 ;
			
									 					foreach ($journal['Journal']['Comment'] as $comment) :
										 					if (!$comment['viewed']) {
																$totcomm1++;
										 					}
										 				endforeach;
												?>
												<div class="journalNo" style="float:right;<?php echo $totcomm1==0?"background-color:#cccccc;":""; ?>">
													<a class="number" style="<?php echo $totcomm1==0?"color:#000000;":"color:#ffffff;"; ?>">
														<?php
														 echo $totcomm1!=0?$totcomm1:$totcomm0 ; ?>
													</a>														
												</div>
												<?php } ?>
												<div style="float:right; padding: 0 5px;">
													<?php 
														if ($journal['Journal']['user_id'] == Authcomponent::user('id'))
															echo $this->Html->link($this->Html->image('edit_icon.png', array('height'=>'20')), 
																					array('action' => 'editnew', $journal['Journal']['id']),
																					array('escape'=> false)); 
													?>
												</div>
											</div>
											<div class="clr"></div>																
										</div>
									</div>
									<!--End advantureBar -->
									<?php 
									
								endforeach; 
								?>
							</div>
							<!-- End event Box -->																														
						</div>
						<!-- End rgtCntrleft -->
					<div class="clr"></div>	
				</div>																								
			</div>

			<!-- End content container -->
		</div>
		<!-- End middle container -->		
</div>