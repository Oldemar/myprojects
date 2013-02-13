<?php
//	echo "<pre>".print_r($journals,true)."</pre>";
?>
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">			
		<div class="cntrCntr">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image_0'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>

			</div>
			<!-- End of Profile Left bar -->	
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft" style="width:744px">		
					<div class="bluBar_wide" >
						My Photo Albums
					</div>
					<br>
					<div class="phototabs">							
						<ul>
							<li>
								<a href="javascript://" id="a1" class="sel" onclick="fp_show('tab_1','a1')">
									<span>
										With Photos
									</span>
								</a>
							</li>
							<li>
								<a href="javascript://" id="a2" onclick="fp_show('tab_2','a2')">
									<span>
										All Albums
									</span>
								</a>
							</li>
							<li>
								<a href="javascript://" id="a3" onclick="fp_show('tab_3','a3')">
									<span>
										No Photos
									</span>
								</a>
							</li>
						</ul>
						<div class="clr"></div>							
					</div>	
					<!--Start tab 1 -->
					<div id="tab_1">											
						<!--Start albumVideo -->
						<div class="albumS">
							
								<?php
									if (count($arrJournalsWithPhotos) > 0) {
									echo '<ul>';
									foreach ($arrJournalsWithPhotos as $value) :
								?>
								<li>
									<div class="image">
										<?php 											
											echo $this->Html->link('<span>'.$this->Html->image($value->getCoverPhotoToDisplay($objLoggedUser),array('style'=>'width:140px;height:120px;')).'</span>',array('controller'=>'photos','action'=>'album',$value->getID()),array('class'=>'img', 'escape'=>false));
										?>
										
									</div>
									<div class="detail">
										<?php 
											echo $this->Html->link(substr($value->getAttr('title'),0,23),array('controller'=>'photos','action'=>'album',$value->getID()));

										?>
										<span class="date">
										<?php 
											echo CakeTime::format('F jS, Y ', $value->getAttr('date_event'));
										?>
										</span>
									</div>	
								</li>									
									<?php
									endforeach; 
									echo '</ul>';
									}else{
									?>
									<div class="alert alert-block" style="text-align: justify">
										<p>
											You currently do not have any photo uploaded. <br>Photo albums will be created automatically for you when you start entering your Journal entries.
										</p>
									</div>
									<?php
									}
									?>
								
							<div class="clr"></div>							
						</div>
						<!--End albumVideo -->
					</div>
					<!--End tab 1 -->

					<!--Start tab 2 -->
							<div id="tab_2" style="display:none;">	
								<!--Start albumVideo -->
								<div class="albumS">
																			
										<?php
											if (count($arrAllJournals) > 0) {
											echo '<ul>';
											foreach ($arrAllJournals as $value) :
												if(is_object($value)){
													$journalId = $value->getID();
												}else{
													$journalId = $value['id'];
												}
										?>
										<li>
											<div class="image">
												<?php 			
													if(is_object($value)){								
														$imgUrl = $value->getCoverPhotoToDisplay($objLoggedUser);
													}else{
														$imgUrl = Configure::read('IMG_URL').$noCoverPhotoImagePath;
													}	
													echo $this->Html->link('<span>'.$this->Html->image($imgUrl,array('style'=>'width:140px;height:120px;')).'</span>',array('controller'=>'photos','action'=>'album',$journalId),array('class'=>'img', 'escape'=>false));
												?>
												
											</div>
											<div class="detail">
												<?php 
												if(is_object($value)){
													$title = $value->getAttr('title');
												}else{
													$title = $value['title'];
												}	
													echo $this->Html->link(substr($title,0,23),array('controller'=>'photos','action'=>'album',$journalId));
		
												?>
												<span class="date">
												<?php 
													if(is_object($value)){
														$dateEvent = $value->getAttr('date_event');
													}else{
														$dateEvent = $value['date_event'];
													}
													echo CakeTime::format('F jS, Y ', $dateEvent);
												?>
												</span>
											</div>	
										</li>									
											<?php
											endforeach; 
											echo '</ul>';
											}else{
											?>
											<div class="alert alert-block" style="text-align: justify">
												<p>
													You currently do not have any photo uploaded. <br>Photo albums will be created automatically for you when you start entering your Journal entries.
												</p>
											</div>
											<?php
											}
											?>
									<div class="clr"></div>							
								</div>
								<!--End albumVideo -->
							</div>
							<!--End tab 2 -->
							<!--Start tab 3 -->
							<div id="tab_3" style="display:none;">	
								<!--Start albumVideo -->
								<div class="albumS">
										<?php
											if (count($arrJournalsWithoutPhotos) > 0) {
											echo '<ul>';
											foreach ($arrJournalsWithoutPhotos as $value) :
												$journalId = $value['id'];
												
										?>
										<li>
											<div class="image">
												<?php 			
													$imgUrl = Configure::read('IMG_URL').$noCoverPhotoImagePath;
														
													echo $this->Html->link('<span>'.$this->Html->image($imgUrl,array('style'=>'width:140px;height:120px;')).'</span>',array('controller'=>'photos','action'=>'album',$journalId),array('class'=>'img', 'escape'=>false));
												?>
												
											</div>
											<div class="detail">
												<?php 
													$title = $value['title'];	
													echo $this->Html->link(substr($title,0,23),array('controller'=>'photos','action'=>'album',$journalId));
		
												?>
												<span class="date">
												<?php 
													$dateEvent = $value['date_event'];
													echo CakeTime::format('F jS, Y ', $dateEvent);
												?>
												</span>
											</div>	
										</li>									
											<?php
											endforeach; 
											echo '</ul>';
											}else{
											?>
											<div class="alert alert-block" style="text-align: justify">
												<p>
													You currently do not have any photo uploaded. <br>Photo albums will be created automatically for you when you start entering your Journal entries.
												</p>
											</div>
											<?php
											}
											?>
									<div class="clr"></div>							
								</div>
								<!--End albumVideo -->
							</div>
							<!--End tab 3 -->																																																		
						</div>
				
																				
			</div>
			<div class="clr"></div>
			<!-- End right container -->

	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->		
