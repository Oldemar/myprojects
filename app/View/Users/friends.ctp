<?php
//	echo "<pre align='left'>".print_r($frReqss,true)."</pre>";
//	echo "<pre align='left'>".print_r($friendlist,true)."</pre>";
//	echo "<pre align='left'>".print_r($users,true)."</pre>";
?>
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
				<div class="cntrCntr2">			

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
							
								<div class="expandable selected"><a href="#">My Friends List</a></div>
								<div class="categoryitems">
									<div class="friendgryBg">
										<div class="friendgryTop">
											<div class="clr"></div>
											<div class="advantureBarNew">
												<div class="alphabatic">
													<?php
														if ($ini == 'All') {
															echo $this->Html->link('All',array('controller'=>'users', 'action' => 'friends'),
																	array('class'=>'sel'));
														} else {
															echo $this->Html->link('All',array('controller'=>'users', 'action' => 'friends'));
														} 
														if ($ini == 'A') {
															echo $this->Html->link('A',array('controller'=>'users', 'action' => 'friends','A'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('A',array('controller'=>'users', 'action' => 'friends','A')); 
														}
														if ($ini == 'B') {
														echo $this->Html->link('B',array('controller'=>'users', 'action' => 'friends','B'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('B',array('controller'=>'users', 'action' => 'friends','B')); 
														}
														 
														if ($ini == 'C') {
														echo $this->Html->link('C',array('controller'=>'users', 'action' => 'friends','C'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('C',array('controller'=>'users', 'action' => 'friends','C')); 
														}
														 
														if ($ini == 'D') {
														echo $this->Html->link('D',array('controller'=>'users', 'action' => 'friends','D'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('D',array('controller'=>'users', 'action' => 'friends','D')); 
														}
														 
														if ($ini == 'E') {
														echo $this->Html->link('E',array('controller'=>'users', 'action' => 'friends','E'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('E',array('controller'=>'users', 'action' => 'friends','E')); 
														}
														 
														if ($ini == 'F') {
														echo $this->Html->link('F',array('controller'=>'users', 'action' => 'friends','F'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('F',array('controller'=>'users', 'action' => 'friends','F')); 
														}
														 
														if ($ini == 'G') {
														echo $this->Html->link('G',array('controller'=>'users', 'action' => 'friends','G'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('G',array('controller'=>'users', 'action' => 'friends','G')); 
														}
														 
														if ($ini == 'H') {
														echo $this->Html->link('H',array('controller'=>'users', 'action' => 'friends','H'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('H',array('controller'=>'users', 'action' => 'friends','H')); 
														}
														 
														if ($ini == 'I') {
														echo $this->Html->link('I',array('controller'=>'users', 'action' => 'friends','I'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('I',array('controller'=>'users', 'action' => 'friends','I')); 
														}
														
														 
														if ($ini == 'J') {
														echo $this->Html->link('J',array('controller'=>'users', 'action' => 'friends','J'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('J',array('controller'=>'users', 'action' => 'friends','J')); 
														}
														 
														if ($ini == 'K') {
														echo $this->Html->link('K',array('controller'=>'users', 'action' => 'friends','K'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('K',array('controller'=>'users', 'action' => 'friends','K')); 
														}
														 
														if ($ini == 'L') {
														echo $this->Html->link('L',array('controller'=>'users', 'action' => 'friends','L'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('L',array('controller'=>'users', 'action' => 'friends','L')); 
														}
														 
														if ($ini == 'M') {
														echo $this->Html->link('M',array('controller'=>'users', 'action' => 'friends','M'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('M',array('controller'=>'users', 'action' => 'friends','M')); 
														}
														 
														if ($ini == 'N') {
														echo $this->Html->link('N',array('controller'=>'users', 'action' => 'friends','N'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('N',array('controller'=>'users', 'action' => 'friends','N')); 
														}
														 
														if ($ini == 'O') {
														echo $this->Html->link('O',array('controller'=>'users', 'action' => 'friends','O'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('O',array('controller'=>'users', 'action' => 'friends','O')); 
														}
														 
														if ($ini == 'P') {
														echo $this->Html->link('P',array('controller'=>'users', 'action' => 'friends','P'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('P',array('controller'=>'users', 'action' => 'friends','P')); 
														}
														 
														if ($ini == 'Q') {
														echo $this->Html->link('Q',array('controller'=>'users', 'action' => 'friends','Q'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('Q',array('controller'=>'users', 'action' => 'friends','Q')); 
														}
														 
														if ($ini == 'R') {
														echo $this->Html->link('R',array('controller'=>'users', 'action' => 'friends','R'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('R',array('controller'=>'users', 'action' => 'friends','R')); 
														}
														 
														if ($ini == 'S') {
														echo $this->Html->link('S',array('controller'=>'users', 'action' => 'friends','S'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('S',array('controller'=>'users', 'action' => 'friends','S')); 
														}
														 
														if ($ini == 'T') {
														echo $this->Html->link('T',array('controller'=>'users', 'action' => 'friends','T'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('T',array('controller'=>'users', 'action' => 'friends','T')); 
														}
														 
														if ($ini == 'U') {
														echo $this->Html->link('U',array('controller'=>'users', 'action' => 'friends','U'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('U',array('controller'=>'users', 'action' => 'friends','U')); 
														}
														 
														if ($ini == 'V') {
														echo $this->Html->link('V',array('controller'=>'users', 'action' => 'friends','V'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('V',array('controller'=>'users', 'action' => 'friends','V')); 
														}
														 
														if ($ini == 'W') {
														echo $this->Html->link('W',array('controller'=>'users', 'action' => 'friends','W'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('W',array('controller'=>'users', 'action' => 'friends','W')); 
														}
														 
														if ($ini == 'X') {
														echo $this->Html->link('X',array('controller'=>'users', 'action' => 'friends','X'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('X',array('controller'=>'users', 'action' => 'friends','X')); 
														}
														 
														if ($ini == 'Y') {
														echo $this->Html->link('Y',array('controller'=>'users', 'action' => 'friends','Y'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('Y',array('controller'=>'users', 'action' => 'friends','Y')); 
														}
														 
														if ($ini == 'Z') {
														echo $this->Html->link('Z',array('controller'=>'users', 'action' => 'friends','Z'),
																	array('class'=>'sel')); 
														} else {
															echo $this->Html->link('Z',array('controller'=>'users', 'action' => 'friends','Z')); 
														}
														 
														?>
												</div>
											</div>
										</div>
									</div>
									<div id="frndLst" style="margin-left: 20px;">
										
										<?php echo $this->element('Users/list_friend'); ?>
									
									
									
									</div>
								<br>									
								</div>
								<?php if (count($frRqs)>0) { ?>
								<div class="expandable"><a href="#">Friend Requests</a></div>
								<div class="categoryitems">
									<div id="frndLst">
									<?php
										$classj[0] = 'alternativeBarNew';
										$classj[1] = 'advantureBarNew';
										$cl_i = 1;
										foreach ($frRqs AS $frReqs) : 
											$cl_i = ($cl_i == 0 ? $cl_i = 1 : $cl_i = 0); ?>
									<div class="<?php echo $classj[$cl_i] ; ?>">
										
										<div class="tpPart">
											<div class="btPart">
												<div class="dreamimage">
												<?php
												if ( isset($frReqs['User_A']['Picture']['w40']) && $frReqs['User_A']['Picture']['w40'] != null ) {
													echo $this->Html->link($this->Html->image($frReqs['User_A']['Picture']['url'].$frReqs['User_A']['Picture']['w40'], array('width'=>'55')), 
																			array('controller'=>'users', 'action' => 'profile', $frReqs['User_A']['id']),
																			array('escape'=> false)); 
												} else {
													echo $this->Html->link($this->Html->image('nopicture.gif', array('width'=>'55')), 
																			array('controller'=>'users', 'action' => 'profile', $frReqs['User_A']['id']),
																			array('escape'=> false)); 
												}
												?>
												</div>											
												<div class="dreamtext">
													<div class="hd">
														<a href='profile/<?php print($frReqs['User_A']['id']); ?>'>
															<?php print($frReqs['User_A']['firstname']." ".$frReqs['User_A']['lastname']); ?>
														</a>
													</div>												
													<div class="ageaddress">From : 
													<?php 
														$okcity = $okregion = $okcountry = 0;
														if (isset($frReqs['User_A']['Contact']['ResCity']['name']) && $frReqs['User_A']['Contact']['ResCity']['name'] != null) {
															echo $frReqs['User_A']['Contact']['ResCity']['name'].', ';
															$okcity = 1;
														}
														if (isset($frReqs['User_A']['Contact']['ResRegion']['code']) && $frReqs['User_A']['Contact']['ResRegion']['code'] != null) {
															echo $okcity ? '' :', ';
															echo $frReqs['User_A']['Contact']['ResRegion']['code'] ;
															$okregion = 1 ;
														}
														if (isset($frReqs['User_A']['Contact']['ResCountry']['name']) && $frReqs['User_A']['Contact']['ResCountry']['name'] != null){
															echo $okregion ? ', ' :'' ;
															echo $frReqs['User_A']['Contact']['ResCountry']['name'];
															$okcountry = 1 ;
														}
														if (!$okcity && !$okregion && !$okcountry)
															echo "Not specified.";
													?>
													</div>												
												</div>														
												<div class="eventRgt">
													<div style="float: right;">
														<?php
															echo $this->Html->link(__('Accept friendship'), 
																		array('controller'=>'users', 'action' => 'acceptFriendship', $frReqs['Relation']['id']),
																		array('escape'=> false)); 
														?>
													</div>
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
								<?php } ?>
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
		
