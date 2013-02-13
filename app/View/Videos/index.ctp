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
						My Video Albums
					</div>
					<br>
					<div class="phototabs">							
						<ul>
							<li>
								<a href="javascript://" id="a1" class="sel" onclick="fp_show('tab_1','a1')">
									<span>
										With videos
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
										No videos
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
									<ul>
										<?php
											$vsl = 0 ;
											foreach ($journals as $journal) :
												if (count($journal['Video']) > 0 ) {
													$vsl = 1 ;
										?>
										<li>
											<div class="image">
												<?php 
													$photocover = 'nocover.jpg';
													foreach ($journal['Video'] as $video) :
														$photocover = $video['url'].$video['w140'].".jpg";
														$vsl = 1 ;
														break;
													endforeach; 
													echo $this->Html->link('<span>'.$this->Html->image($photocover,array('style'=>'width:140px')),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']),array('class'=>'img', 'escape'=>false));
												?>
												</span>										
											</div>
											<div class="detail">
												<?php 
													echo $this->Html->link(substr($journal['Journal']['title'],0,23),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']));
												?>
												<span class="date">
													<?php 
													echo CakeTime::format('F jS, Y ', $journal['Journal']['date_event']);
													?>
												</span>
											</div>										
											<?php
													
												} 
											endforeach; 
											if (!$vsl) {
											
											?>
											<div class="alert alert-block" style="text-align: justify">
												<p>
													You currently do not have any video uploaded.<br> Video albums will be created automatically for you when you start entering your Journal entries.
												</p>
											</div>
											<?php 
												}
											
											?>
										</li>

									</ul>
									<div class="clr"></div>							
								</div>
								<!--End albumVideo -->
							</div>
							<!--End tab 1 -->

							<!--Start tab 2 -->
							<div id="tab_2" style="display:none;">	
								<!--Start albumVideo -->
								<div class="albumVideo">
									<ul>										
										<?php
											foreach ($journals as $journal) :
										?>
										<li>
											<div class="image">
												<?php 
													$photocover = 'nocover.jpg';
													if (!empty($journal['Video'])) {
														foreach ($journal['Video'] as $video) :
															if ($video['sharing_level'] == '2') {
																$photocover = $this->webroot.$video['url'].$video['w140'].".jpg";
																break;
															}
														endforeach; 
												}
												echo $this->Html->link('<span>'.$this->Html->image($photocover,array('style'=>'width:140px')),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']),array('class'=>'img', 'escape'=>false));
												?>
												</span>										
											</div>
											<div class="detail">
												<?php 
													echo $this->Html->link(substr($journal['Journal']['title'],0,23),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']));
												?>
												<span class="date">
													<?php 
														echo CakeTime::format('F jS, Y ', $journal['Journal']['date_event']);
													?>
												</span>
											</div>										
											<?php
											endforeach; 
											?>
										</li>
									</ul>
									<div class="clr"></div>							
								</div>
								<!--End albumVideo -->
							</div>
							<!--End tab 2 -->
							<!--Start tab 3 -->
							<div id="tab_3" style="display:none;">	
								<!--Start albumVideo -->
								<div class="albumVideo">
									<ul>																			
										<?php
											foreach ($journals as $journal) :
												if (count($journal['Video']) == 0 ) {
										?>
										<li>
											<div class="image">
												<?php 
													$photocover = 'nocover.jpg';
													if (!empty($journal['Video'])) {
														foreach ($journal['Video'] as $video) :
															if ($video['sharing_level'] == '2') {
																$photocover = "Configure::read('UUI')".$video['url'].$video['w140'].".jpg";
																break;
															}
														endforeach; 
												}
												echo $this->Html->link('<span>'.$this->Html->image($photocover,array('style'=>'width:140px')),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']),array('class'=>'img', 'escape'=>false));
												?>
												</span>										
											</div>
											<div class="detail">
												<?php 
													echo $this->Html->link(substr($journal['Journal']['title'],0,23),array('controller'=>'videos','action'=>'album',$journal['Journal']['id']));
												?>
												<span class="date">
													<?php 
														echo CakeTime::format('F jS, Y ', $journal['Journal']['date_event']);
													?>
												</span>
											</div>										
											<?php
												}
											endforeach; 
											?>
										</li>
									</ul>
									<div class="clr"></div>							
								</div>
								<!--End albumVideo -->
							</div>
							<!--End tab 3 -->																																																		
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
