<script type="text/javascript">

	ddaccordion.init({
		headerclass: "expandable", //Shared CSS class name of headers group that are expandable
		contentclass: "categoryitems", //Shared CSS class name of contents group
		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
		defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
		animatedefault: true, //Should contents open by default be animated into view?
		scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
		persiststate: false, //persist state of opened contents within browser session?
		toggleclass: ["selected", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})
</script>

<!--Start middle Container-->

<div id="middleCntr">
<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="fl">
						<?php 
							echo $journals['User']['firstname']." ".$journals['User']['lastname']."'s Journal"; 
						?>
					</div>
					<div class="fr">
						Shared View for 
						<?php 
							echo $share['Share']['email'];
						?>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
		<div class="cntrCntr">
<!-- Start left container -->
			<div id="leftCntr">
				<?php 
					echo $this->element('profile/user_image');
				?>
				<br>
				<?php 
					echo $this->element('profile/alphaworldmap'); 
				?>
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
										<div class="midHd">
											<div class="rating" style="float:right">
												<?php
													$rate  = $trate = 0 ;
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['user_id'] == $journals['Journal']['user_id'] ) {
															$rate += $journalrate['rate'];
															$trate++;
														}
													endforeach;
													$rate = ($rate > 0 ? round($rate/$trate) : 0);
													for ($x=1;$x<6;$x++) {
														if ($x <= $rate) {
															print("<img src=\"{$this->webroot}img/rating_icon_big.gif\" alt=\"\" />");
														} else {
															print("<img src=\"{$this->webroot}img/rating_icon_big_gry.gif\" alt=\"\" />");
														}
													}
												?>
											</div>
											<span>
												<?php 
													echo $journals['Journal']['title']; 
												?>
											</span>
										</div>
										<div class="size14" id="AworldRate">
										</div>
										<div class="midlft">
											<div class="midHdsml">
												<?php 
													echo $journals['Area']['ParentArea']['name'].' - '.h($journals['Area']['name']);  
												?><br>
												<b>
												<?php 
													echo $fullCityName;  
												?>
												</b><br>
												<?php 
													echo $journals['Journal']['location'];  
												?><br>
												<?php 
													echo CakeTime::format('F jS, Y ', $journals['Journal']['date_event']) ; 
												?><br>
												<span>
												<?php
													if ($journals['Journal']['cost'] != 0)
													echo $journals['Currency']['code'] . "  " . $journals['Journal']['cost']; ?>
												</span>
											</div>
											<div class="midHdclima">
												<?php 
													echo $journals['Journal']['climatic_conditions'];  
												?>
											</div>
											<div class="clr"></div>
										</div>
										<div class="midrgt">
											<div class="pvtabs">
												<?php 
													if(count($journals['Photo']) > 0 ||
														count($journals['Video']) > 0 ) {
												?>
												<ul>
													<?php
														if (count($journals['Photo']) > 0) {
													?>
													<li>
														<a href="javascript://" class="sel" id="a1" onclick="fp_show('tab_1','a1')">
															Photos
														</a>
													</li>
													<?php
														}
													?>
													<?php
														if (count($journals['Video']) > 0) {
													?>
													<li class="ved">
														<a href="javascript://" id="a2" onclick="fp_show('tab_2','a2')">
															Videos
														</a>
													</li>
													<?php
														}
													?>
												<?php 
												} 
												?>
												</ul>
											</div>
											<div class="pvtabsImgbg">
												<div class="slideCntr">
													<?php 
														if(count($journals['Photo']) > 0 ||
															count($journals['Video']) > 0 ) {
															if (count($journals['Photo']) > 0) {
													?>
													<div id="tab_1" style="position:relative;">
														<div class="vprev">
															<a href="#" id="prev1" class="jcarousel-prev">
																<img src="<?php echo $this->webroot ; ?>img/prevslide_icon.png" alt="" />
															</a>
														</div>
														<div class="myjurnalsVideo" id="scroll2">
															<ul>
																<?php 
																	if (is_array($journals['Photo']) && count($journals['Photo']) > 0) {
																		foreach ($journals['Photo'] as $photo):
																			if ($photo['sharing_level'] != '0')  {
																?>
																<li class="scroller_block">
																<?php
																	echo $this->Html->image($photo['url'].$photo['w240'], array('width'=>'240')) ?>
																</li>
																<?php
																			}
																		endforeach; 
																?>
																<?php 
																	} 
																?>
															</ul>
														</div>
														<div class="vnext jcarousel-next">
															<a  class="jcarousel-next">
																<img src="<?php echo $this->webroot ; ?>img/nextslide_icon.png" alt="" />
															</a>
														</div>
														<?php 
																	if (count($journals['Photo']) > 1 ) { 
														?>
														<script type="text/javascript">
															$(function() {
																$('#scroll2').jcarousel({
																	scroll:1, 
																	wrap: 'circular',
																	vertical: true,
																	animating: true
															
																	}).jcarouselAutoscroll({
																	autostart: 'true'
																	})
																	.hover(function() {
																$(this).jcarouselAutoscroll('stop');
																}, function() {
																	$(this).jcarouselAutoscroll('start');
																});
															
															
																$('.jcarousel-prev').jcarouselControl({
																	target: '-=1'
																});
															
																$('.jcarousel-next').jcarouselControl({
																	target: '+=1'
																});
															});
														</script>
														<?php 
																	}
														?>
																	
													</div>
													<?php
														}		
													?>
													<div id="tab_2" style="position:relative;">
														<div class="vprev">
															<a href="#" id="prev2">
																<img src="<?php echo $this->webroot ; ?>img/prevslide_icon.png" alt="" />
															</a>
														</div>
														<div class="myjurnalsVideo" id="scroll3">
															<ul>
																<?php
																	if (!empty($journals['Video'])) {
																		foreach ($journals['Video'] as $video):
																?>
																<li class="scroller_block">
																	<?php
																		echo $this->Html->image(Configure::read('UUI').$video['url'].$video['name'].".jpg", array('width'=>'240','height'=>'152'));
																	?>
																</li>
																	<?php
																	     endforeach;
																	} else { 
																	?>
																<li class="scroller_block">
																	<?php 
																		echo $this->Html->image('novideoavailable.gif',array('width'=>'240','height'=>'152')) ; ?>
																</li>
																<?php 
																	} 
																?>
															</ul>
															<div class="clr"></div>
														</div>
														<div class="vnext">
															<a href="#" id="next2">
																<img src="<?php echo $this->webroot ; ?>img/nextslide_icon.png" alt="" />
															</a>
														</div>
														<?php 
															if (count($journals['Video']) > 1 ) { 
														?>
														<script language="JavaScript" type="text/JavaScript" src="<?php echo $this->webroot ; ?>js/jquery.jcarousel-all.js">
														</script>
														<script>
															$(function() {
																$("#scroll3").jcarousel({
																	btnNext: "#next2",
																	btnPrev: "#prev2",
																	visible:1,
																	auto:4000,
																	scroll:1
																});
															});
														</script>
														<?php 
															} 
														?>
													</div>
													<?php
													} else {
														echo "<div class=\"scroller_block\">".$this->Html->image('journal_cover.png', array('width'=>'240','height'=>'152')) ."</div>";
													}
													?>
												</div>
											</div>
										</div>
										<div class="clr"></div>

									</div>
									<div class="midBottom">
										<div class="jrnlDesc">
											<div class="expandable selected">
												<a href="#">
													My comments for the world 
												</a>
											</div>
											<div id="cab_3" class="categoryitems">
												<p>
													<?php 
														echo h($journals['Journal']['forall_description']);
													?>
												</p>
												<br>
												<div>
													<?php 
														echo $this->element('journals/comment',array('journalId'=>$journals['Journal']['id'],'sharingLevel'=>2,'objLoggedUser'=>NULL));
													?>	 
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="expandable">
										<a href="#">
											For friends like you
										</a>
									</div>
									<div id="cab_2" class="categoryitems">
										<p>
											<?php 
												echo $journals['Journal']['forgroup_description']; 
											?>
										</p>
										<div>
											<?php 
												echo $this->element('journals/comment',array('journalId'=>$journals['Journal']['id'],'sharingLevel'=>1,'objLoggedUser'=>NULL));
											?>	 
										</div>
									</div><br>
								</div>
							</div>
						</div>
					</div>
				</div>
<!--End popupBox -->
			</div>
<!-- End event Box -->
		</div>
<!-- End rgtCntrleft -->
	</div>
<!-- End right container -->
	<div class="clr"></div>
	</div>
<!-- End content container -->
</div>
<!-- End middle container -->
