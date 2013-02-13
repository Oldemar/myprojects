<?php
//    echo "<pre>".print_r($journals,true)."</pre>" ;
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
<script type="text/javascript">
	$(document).ready(function(){
		$(".popup1").colorbox({width:"776px", height:"950px", background:"none", iframe:true});
		//Example of preserving a JavaScript event for inline calls.
			$("#click").click(function(){
			$('#click').css({"background-color":"#000", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
		return false;
		});
	});
</script>

<!--Start middle Container-->

<div id="middleCntr" style="line-height:16px">
<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt">
					<div class="fl">
						<?php 
							echo $objJournal->User->getAttr('username') ."'s Journal"; 
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
					echo $this->element('profile/user_image',array('userId'=>$objJournal->User->getID())); 
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
											<?php 
												echo $objJournal->getAttr('title'); 
											?>
											<div class="rating" style="float:right;">
												<?php
												$rate = 0 ;
												foreach ($objJournal->Journalrate as $journalrate) :
													if ( $journalrate->getAttr('user_id') == $objJournal->getAttr('user_id') ) {
														$rate = $journalrate->getAttr('rate');
														break;
													}
												endforeach;
												for ($x=1;$x<6;$x++) {
													if ($x <= $rate) {
														echo $this->Html->image('rating_icon_big.gif');
													} else {
														echo $this->Html->image('rating_icon_big_gry.gif');
													}               
												}
											?>
											</div>
										</div>
										<div class="size14" id="myAvgRate">
											<!-- Here it was the div ratings -->
										</div>
										<div class="midlft">
											<div class="midHdsml">
												<?php 
													echo $objJournal->getDateEventString(); 
												?>
												<br><span>
												<?php 
													echo $objJournal->Area->ParentArea->getAttr('name').' - '.h($objJournal->Area->getAttr('name'));  
												?></span>
												<br>
												<b>
												<?php 
													echo $objJournal->City->getNameToExhibit();  
												?>
												</b>
												<br>
												<?php 
													echo $objJournal->getAttr('location');  
												?>
												<br>
												<span>
												<?php
													echo $objJournal->getCost(); 
												?>
												</span>
											</div>
											<div class="midHdclima">
												<?php 
													echo h($objJournal->getAttr('climatic_conditions'));  
												?>
											</div>
										</div>
										<div class="midrgt">
											<div class="pvtabs">
												<ul>
													<?php
														if ((count($objJournal->Photo) > 0 ) ||
															(count($objJournal->Video) > 0 ) ) {
													?>
													<?php
															if (count($objJournal->Photo) > 0 ) { 
													?>
													<li>
														<a href="javascript://" class="sel" id="a1" onclick="fp_show('tab_1','a1')">
															Photos
														</a>
													</li>
													<?php
															}
															if (count($objJournal->Video) > 0 ) { 
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
														if ((count($objJournal->Photo) > 0 ) ||
															(count($objJournal->Video) > 0 ) ) {
															if (count($objJournal->Photo) > 0 ) { 
																echo $this->element('journals/photo_carousel',array('objJournal'=>$objJournal)); 
															}
															if (count($objJournal->Video) > 0 ) { 
																echo $this->element('journals/video_carousel',array('objJournal'=>$objJournal)); 
															}
														} else {
															echo "<div class=\"scroller_block\">".$this->Html->image('journal_cover.png', array('width'=>'240','height'=>'140')) ."</div>";
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
												<p style="padding:5px 5px 5px 15px;">
													<?php 
														echo $objJournal->getDescriptionToShow('forall_description'); 
													?>
												</p
												><br>
												<div>
													<?php 
														echo $this->element('journals/comment',array('journalId'=>$objJournal->getID(),'sharingLevel'=>2));
													?>  
												</div>
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
		</div>
<!-- End content container -->
	</div>
<!-- End middle container -->
</div>
