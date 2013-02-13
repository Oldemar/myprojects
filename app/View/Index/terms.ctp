
<!--scroll script -->
<script type="text/javascript">

function init_dw_Scroll() {
    // arguments: id of scroll area div, id of content div
    var wndo = new dw_scrollObj('wn', 'lyr1');
    // args: id, axis ('v' or 'h'), eType (event type for arrows), 
    // bScrollbar (include track and dragBar? true or false)
    wndo.buildScrollControls('scrollbar', 'v', 'mouseover', true);
}

// if code supported, link in the style sheet (optional) and call the init function onload
if ( dw_scrollObj.isSupported() ) {
    dw_Util.writeStyleSheet('css/scrollbar.css');
    dw_Event.add( window, 'load', init_dw_Scroll);
}

</script>

		<!--Start middle Container-->
		<div id="middleCntr">	
			<!-- Start content container -->
			<div id="contentCntr"  style="min-height: 600px;">
				<div class="headingBg">
					<div class="lt">
						<div class="rt">
							Terms and Conditions	
						</div>

					</div>		
				</div>
				<div class="cntrCntr">			
					<!-- Start left container -->
					<div id="leftCntr">
						<?php 
							echo $this->element('main_opt_left_column', array('sel'=>'Privacy'))
						?>
						<!-- End lftlink Box -->
					</div>
					<!-- End left container -->
					<!-- Start right container -->
					<div id="rightCntr">
						<!-- Start beforeloginleft -->
						<div class="beforeloginleft">					
							<div class="privacy">

								<!--Start text Box-->
								<div class="textBox">
									<div id="container"> <!-- optional container div for scroll area and scrollbar -->
										<div id="wn"> <!-- scroll area div -->
											<div id="lyr1" > <!-- layer in scroll area (content div) -->																															
											<?php echo $this->element('Policy/terms'); ?>							
											</div> 														
											</div><!-- end content div (lyr1) -->
										</div><!-- end wn div -->
										<div id="scrollbar"></div> <!-- code adds up, down, track, and dragBar divs -->	
									</div> <!-- end container div -->																											
								</div>

								<!-- End text Box -->
							</div>										
						</div>
						<!-- End beforeloginleft -->
						<!-- Start rgtCntrright -->
						<div class="rgtCntrright">							
								<?php // echo $this->element('testimonial_column'); ?>
						</div>
						<!-- End rgtCntrright -->																	
					</div>
					<!-- End right container -->
					<div class="clr"></div>	
				</div>																								

