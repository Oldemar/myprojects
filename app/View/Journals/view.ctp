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
		<div>
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
									<!-- Commenting DELETE button
										<div class="delBtn">
											<?php
												echo $this->Form->input('id',array('type'=>'hidden'));
												if ($journals['Journal']['user_id'] == AuthComponent::user('id'))
														echo $this->Form->postLink($this->Html->image('delete.png'),array('action' => 'delete', $journals['Journal']['id']),array('escape'=> false),__('This action will delete all photos,videos and comments associated to the journal titled  %s . Proceed?', $journals['Journal']['title']));
											?>
											</div>
																	 -->
											<div class="delBtn">
												<?php
													if ($journals['Journal']['user_id'] == AuthComponent::user('id'))
															echo $this->Html->link($this->Html->image('edit_icon.png'),array('action' => 'editnew', $journals['Journal']['id']),array('escape'=> false));
												?>
											</div>
											<!-- Commenting out Dreamable, publishable and Delete buttons
											<div class="delBtn">
												<?php
													if ($journals['Journal']['user_id'] == AuthComponent::user('id')) {
														if ($journals['Journal']['isdreamable']) {
															echo $this->Html->link($this->Html->image('adddream_icon.jpg', array('height'=>'25')),array('action' => 'editdreamable', $journals['Journal']['id'],0),array('escape'=> false));
														} else {
															echo $this->Html->link($this->Html->image('adddream_icon_bw.png', array('height'=>'25')),array('action' => 'editdreamable', $journals['Journal']['id'],1),array('escape'=> false));
														}
													}
												?>
											</div>
											<div class="delBtn">
												<?php
													if ($journals['Journal']['user_id'] == AuthComponent::user('id')) {
														if ($journals['Journal']['ispublishable']) {
															echo $this->Html->link($this->Html->image('unloked_icon.png', array('height'=>'25')),array('action' => 'editpublish', $journals['Journal']['id'],0),array('escape'=> false));
														} else {
															echo $this->Html->link($this->Html->image('locked_icon.png', array('height'=>'25')),array('action' => 'editpublish', $journals['Journal']['id'],1),array('escape'=> false));
														}
													}
												?>
											</div>
											-->
											<div class="midHd">
												<span>
													<?php echo $journals['Journal']['title']; ?>
												</span>
											</div>
											<div class="size14" id="myAvgRate">
												<div class="rating">My ratings:
												<?php
													$rate = $trate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['user_id'] == $journals['Journal']['user_id'] ) {
																$rate += $journalrate['rate'];
																$trate++;
														}
													endforeach;
													
													if ($rate) {
														$rate = ($trate == 0 ? 0 : round($rate/$trate));
														for ($x=1;$x<6;$x++) {
															if ($x <= $rate) {
																echo $this->Html->image('rating_icon_big.gif');
															} else {
																echo $this->Html->image('rating_icon_big_gry.gif');
															}								
														}
													}	
													
												?>
												</div>
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
																echo h($journals['Currency']['code'] . "  " . $journals['Journal']['cost']); 
															?>
													</span>
												</div>
												<div class="midHdclima">
													<?php 
														echo h($journals['Journal']['climatic_conditions']);  
													?>
												</div>
													<?php 
														if ($journals['Journal']['user_id']==AuthComponent::user('id')) { 
													?>
												<div class="heddBlu">


													<?php 
													/*		
														if ( count($journals['Participation']) > 0 ) { 
													?>
													<a href="#">
														<?php echo count($journals['Participation']) ?> people</a>
													<br>
													participated in this journal
													<br>
													<a href="#">
														<img src="<?php echo $this->webroot."img/findout_btn.jpg"  ;?>" alt="" class="vAlign"  style="padding-top:7px"/>
													</a>
													<?php 
															} else { 
													?>
													Nobody share their 
													<br>
													participation in this journal yet.
													<?php 
															} 
													?>

												</div>
												<?php 
														} else { 
															$isshared = 0;
															$you = "";
															foreach ($journals['Participation'] as $share):
															if ($share['user_id'] == AuthComponent::user('id')) {
																$isshared = 1;
																$you = "You ";
															}
														endforeach;
												?>
												<div class="heddBlu">
													<?php 
														if ($you != "")
															echo $this->Html->link($you, array('controller'=>'users' ,'action'=>'profile',AuthComponent::user('id'))); 
													?>
													<?php 
														if (count($journals['Participation'])-1 == 1 && $isshared) {
															foreach ($journals['Participation'] as $share):
																if ($share['user_id'] != AuthComponent::user('id')) {
																$shareuser = $share['User']['username'];
																$idshareduser = $share['User']['id'];
																}
															endforeach;
															echo "and " . $this->Html->link($shareuser, array('controller'=>'users' ,'action'=>'profile',$idshareduser)) . " "; 
														}
														if (count($journals['Participation'])-1 > 1 && $isshared) {
															$totshare = count($journals['Participation'])-1;
															echo "and <a href=\"#\">".$totshare. " people</a> ";  
														}
													?>
													<?php if (count($journals['Participation'])-1 > 0 && !$isshared) echo '<a href="#">'.count($journals['Participation'])." people</a> " ; 
													?>
													<br>participated in this journal.
													<br>
													<?php if (count($journals['Participation']) >= 2 && !$isshared) { ?>
													<a href="#">
														<img src="<?php echo $this->webroot."img/findout_btn.jpg"  ;?>" alt="" class="vAlign"  style="padding-top:7px"/>
													</a>
													<?php } ?>
													<?php
														$befirst = "";
														if ((!$isshared) && count($journals['Participation']) == 0 ) {
															$befirst = " ";
														
													?>
													<a href="#">Be the first to share your <br>participation in this journal.</a>
													<?php 
														} */
													?>
												</div>
												<?php
													} 
												?>
												<div class="alldetail">
<!--                    <div class="liked"><img src="<?php echo  $this->webroot ; ?>img/like_icon.gif" alt="" /> 4 Liked it</div> -->
													<div class="clr"></div>
												</div>
											</div>
											<div class="midrgt">
												<div class="pvtabs">
													<ul>

														<li><a href="javascript://" class="sel" id="a1" onclick="fp_show('tab_1','a1')">Photos</a></li>
														<?php
															if (!empty($journals['Video'])) {
																echo '<li class="ved"><a href="javascript://" id="a2" onclick="fp_show(\'tab_2\',\'a2\')">Videos</a></li>';
															}
														?>
														
													</ul>
												</div>
												<div class="pvtabsImgbg">
													 <div class="slideCntr">
															<div id="tab_1" style="position:relative;">
																<div class="vprev">
																	<a href="#" id="prev1" class="jcarousel-prev">
																			<img src="<?php echo $this->webroot ; ?>img/prevslide_icon.png" alt="" />
																	</a>
																</div>
																<div class="myJournalsPicture" id="scroll2">
																	<ul>
																		<?php
																			$isowner = ($journals['Journal']['user_id']==AuthComponent::user('id')) ? $isowner = 1: $isowner = 0;

																			$isfriend = 0;
																			foreach ($friendlist as $id=>$name):
																				if ($id == $journals['Journal']['user_id']) {
																					$isfriend = 1;
																					break;
																				}
																			endforeach;
																			$allfriend = 0 ;
																			$isallowed = 0 ;
																			foreach ($journals['Journalperm'] as $journalperm):
																				if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == 0)) {
																					$allfriend = 1 ;
																					break;
																				}
																				if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == Authcomponent::user('id'))) {
																					$isallowed = 1;
																					break;
																				}
																				if (($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] == 0) ) {
																					if ($usersbygroup != null) $isallowed = 1;
																				}
																				if  ( ($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] != 0) ) {
																					if ($usersbygroup != null) {
																						foreach ($usersbygroup as $userbygroup):
																							if ($userbygroup['Group']['id'] == $journalperm['id_value']) {
																								$isallowed = 1;
																								break;
																							}
																						endforeach;
																					}
																				}
																			endforeach;
																			if (!empty($journals['Photo'])) {
																				foreach ($journals['Photo'] as $photo):
																					if (($isowner) || ($photo['sharing_level']) =='2' ||
																						($photo['sharing_level'] =='1') && ($isowner) ||
																						($isallowed && $photo['sharing_level'] != '0') ) {
																	?>
																	<li class="scroller_block">
																		<a href="javascript:" id="photoLghtBox_<?php echo $photo['id']; ?>">
																			<?php echo $this->Html->image($photo['url'].$photo['w240']) ?>
																		</a>
																		<script>
																			$('#photoLghtBox_<?php echo $photo['id']; ?>').click(function() {
																				if (!$.browser.msie) {
																				  	$.ajax({
																		    			  url: "<?php echo $this->Html->url(array('controller' => 'photos' ,'action' => 'photo', $photo['id'], $journals['Journal']['id'])); ?>",
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
																				} else {
																					alert('Warning! You may experience a few minor issues when viewing LivingAlpha using Internet Explorer.  For optimum results, we recommend using Chrome or Mozilla-Firefox.Thank you for your understanding.');
																				}
																				  	
																			});
																		</script>
																	</li>
																	<?php
																					}
																				endforeach;
																			} else { 
																	?>
																	<li class="scroller_block">
																		<?php 
																			echo $this->Html->image('novideoavailable.gif',array('width'=>'240','height'=>'152')) ; 
																		?>
																	</li>
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
															if (!empty($journals['Video'])) {
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
																		foreach ($journals['Video'] as $video):
																	?>
																	<li class="scroller_block">
																	<a href="javascript:" id="videoLghtBox_<?php echo $video['id']; ?>">
																			<?php echo $this->Html->image($video['url'].$video['w375'].".jpg") ?>
																		</a>
																		<script>
																			$('#videoLghtBox_<?php echo $video['id']; ?>').click(function() {
																				if (!$.browser.msie) {
																				  	$.ajax({
																		    			  url: "<?php echo $this->Html->url(array('controller' => 'videos' ,'action' => 'video', $video['id'], $journals['Journal']['id'])); ?>",
																		    			  dataType: 'html',
																		    			  type: "POST",
																		    			  success: function(ajaxReturn,textStatus,xhr){
																		    				  $('#photoModal').modal("show");
																		    				  $('#modalContent').html(ajaxReturn);
																		   				  },
																		   				  beforeSend: function(){
																		   					$('#photoModal').modal("show");
																		   					$('#modalContent').html('Loading');
																		   				  }	  
																		    		});
																				} else {
																					alert('Warning! You may experience a few minor issues when viewing LivingAlpha using Internet Explorer.  For optimum results, we recommend using Chrome or Mozilla-Firefox.Thank you for your understanding.');
																				}
																		    	
																			});
																		</script>
																	</li>
																	<?php     
																			endforeach;
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
														</div>
													</div>
												</div>
												<div class="clr"></div>
											</div>
											<div class="midBottom">
												<div class="jrnlDesc">
													<?php
														if (((strlen($journals['Journal']['forall_description']) > 0) ||
															($jPhoto2 > 0))) { 
													?>
													<div class="expandable selected">
														<a href="#">My comments for the world </a>
													</div>
													<div id="cab_3" class="categoryitems">
														<?php 
															if ($journals['Journal']['user_id'] == AuthComponent::user('id')) { 
														?>
														<div id="rating2" style="padding-bottom:5px;">
															<?php
																echo $this->element('journals/rating',array('shrlvl'=>'2'));
															?>
														</div>
														<?php 
															}
														?>
														<p style="padding:5px 5px 5px 15px;">
															<?php echo $journals['Journal']['forall_description']; ?>
														</p><br>
														<div>
														<?php 
															echo $this->element('journals/comment',array('journalId'=>$journals['Journal']['id'],'sharingLevel'=>2,'objLoggedUser'=>$objLoggedUser));
														?>	
														</div>
													</div>
													<?php
														}
													?>
													 <?php
														if (((strlen($journals['Journal']['forgroup_description']) > 0) || $jPhoto1 > 0)) { 
															$isfriend = 0;
															$allfriend = 0 ;
															$isallowed = 0 ;
															foreach ($friendlist as $id=>$name):
																if ($id == $journals['Journal']['user_id']) {
																	$isfriend = 1;
																	break;
																}
																endforeach;
																$allfriend = 0 ;
																$isallowed = 0 ;
																foreach ($journals['Journalperm'] as $journalperm):
																	if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == 0)) {
																		$allfriend = 1 ;
																		break;
																	}
																	if (($journalperm['tablename_id'] == 3) && ($journalperm['id_value'] == Authcomponent::user('id'))) {
																		$isallowed = 1;
																		break;
																	}
																	if  ( ($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] == 0) ) {
																		if ($usersbygroup != null) 
																			$isallowed = 1;
																	}
																	if  ( ($journalperm['tablename_id'] == 10) && ($journalperm['id_value'] != 0) ) {
																		if ($usersbygroup != null) {
																			foreach ($usersbygroup as $userbygroup):
																				if ($userbygroup['Group']['id'] == $journalperm['id_value']) {
																					$isallowed = 1;
																					break;
																				}
																			endforeach;
																		}
																	}
																	endforeach;
																	if ( ( ($isfriend) && ( ($isallowed) || ($allfriend) ) )  ||
																		( $journals['Journal']['user_id'] == Authcomponent::user('id') ) ) {
													?>
													<div class="expandable"><a href="#">Comments for my friends</a></div>
 													<div id="cab_2" class="categoryitems">
														<div id="rating1" style="padding-bottom:5px;">
														<?php
															echo $this->element('journals/rating',array('shrlvl'=>'1'));
														?>
														</div>
														<p style="padding:5px 5px 5px 15px;">
															<?php echo $journals['Journal']['forgroup_description']; ?>
														</p>
														<div>
														<?php 
															echo $this->element('journals/comment',array('journalId'=>$journals['Journal']['id'],'sharingLevel'=>1,'objLoggedUser'=>$objLoggedUser));
														?>
														</div>
													</div><br>
													<?php
															}
														} 
													?>
													 <?php
														if (($journals['Journal']['user_id'] == AuthComponent::user('id')) &&
															((strlen($journals['Journal']['forme_description']) > 0) ||
															($jPhoto0 > 0))) { 
													?>

													<div class="expandable">
														<a href="#">
															Just for myself
														</a>
													</div>
													<div class="categoryitems">
														<div id="rating0" style="padding-bottom:5px;">
														<?php
															echo $this->element('journals/rating',array('shrlvl'=>'0'));
														?>
														</div>
														<p style="padding:5px 5px 5px 15px;">
														<?php
															echo $journals['Journal']['forme_description']; 
														?>
														</p>
														<div>
														<?php 
															echo $this->element('journals/comment',array('journalId'=>$journals['Journal']['id'],'sharingLevel'=>0,'objLoggedUser'=>$objLoggedUser));
														?>	 
														</div>
													</div>
													<br>
													<?php } ?>
													<?php
														if ($journals['Journal']['user_id'] == AuthComponent::user('id')) {
													?>
													<div class="expandable"><a href="#">Sharings</a></div>
													<div class="categoryitems popform">
														<table>
															<tr>
																<td class="invitWho"><h4>Who</h4></td>
																<td class="invitDate"><h4>Sent</h4></td>
																<td class="invitDate"><h4>Viewed</h4></td>
																<td class="invitIcon"></td>
																<td class="invitIcon"></td>
															</tr>
															<?php 
																foreach ($journals['Share'] as $share) : 
															?>
															<tr>
																<td><?php echo $share['email'] ; ?></td>
																<td><?php echo CakeTime::format('F jS, Y ',$share['created']) ; ?></td>
																<td><?php echo ($share['viewed']== 0 ? "No":"Yes") ; ?></td>
																<td>
																<?php
																	echo $this->Html->link($this->Html->image('email.png',array('width'=>'40')),array('controller'=>'shares', 'action' => 'sendEmail', $share['id']),array('escape'=> false));
																?>
																</td>
																<td>
																<?php
												 					echo $this->Form->postLink($this->Html->image('delete.png'),array('controller'=>'shares', 'action' => 'deleteshare', $share['id']),array('escape'=> false),__('Proceed to delete this share?')); 
																?>
																</td>
															</tr>
															<?php
																endforeach;
															?>
														</table>
													</div>
													<?php } ?>
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
				<!-- Start rgtCntrright -->
				<?php echo $this->element('journals/share'); ?>	
				<!-- End rgtCntrright -->																	
			</div>
			<!-- End right container -->
				
			 <div class="clr"></div>
			 </div>
	 </div>

	 <!-- End content container -->

</div>
<div id="photoModal" class="photomodal hide fade" aria-hidden="true">
	<div class="photomodal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3><?php echo $journals['Journal']['title']; ?></h3>
	</div>
	<div class="photomodal-body" id="modalContent">
		
	</div>
</div>
<!-- End middle container -->
<?php
	$this->Js->get("#inputComment");
	$this->Js->event('change',
		$this->Js->request(array(
			'controller'=>'journals',
			'action'=>'commentDetail'
			), array(
			'update'=>"#comDe2",
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				))
			))
	);

?>
