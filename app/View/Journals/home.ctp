<?php
if (Configure::read('debug') == 0):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<!-- Start banner container -->
<div id="bannerCntr">					
	<div class="banner">								
		<div class="scroller_bl">
			<div class="first">
				<div class="bannermid">

					<div class="slogen">
						Tracking and sharing your memories <br />   and victories are key to looking back and <br />feeling great about your accomplishements.
						<div class="txtgrybg">
							"At the right time and under the right sun, there is a little Alpha in each of us!"
						</div>
					</div>												
					<div class="banneralpha"></div>

				</div>
			</div>
		</div>								
		<div class="scroller_bl">
			<div class="second">
				<div class="bannermid">
					<div class="slogen">
						Tracking and Sharing your<br /> victories &amp; memories is key to<br /> looking back and feeling great.
						<div class="txtgrybg">

							"At the right time and under the right sun<br />There is an Alpha in each of us"
						</div>
					</div>												
					<div class="banneralpha"></div>
				</div>						
			</div>
		</div>
		<div class="scroller_bl">
			<div class="third">
				<div class="bannermid">

					<div class="slogen">
						Tracking and Sharing your<br /> victories &amp; memories is key to<br /> looking back and feeling great.
						<div class="txtgrybg">
							"At the right time and under the right sun<br />There is an Alpha in each of us"
						</div>
					</div>												
					<div class="banneralpha"></div>

				</div>					
			</div>
		</div>								
		<div class="scroller_bl">
			<div class="fourth">
				<div class="bannermid">
					<div class="slogen">
						Tracking and Sharing your<br /> victories &amp; memories is key to<br /> looking back and feeling great.
						<div class="txtgrybg">

							"At the right time and under the right sun<br />There is an Alpha in each of us"
						</div>
					</div>												
					<div class="banneralpha"></div>
				</div>					
			</div>
		</div>

	</div>
	<div class="slidetabs" style="display:none;">
		<a class="current" href="#">1</a>
	
		<a href="#">2</a>
		<a href="#">3</a>
		<a href="#">4</a>
	</div>			
	<script language="JavaScript" type="text/javascript">
		// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
		$(function() {
		
		$(".slidetabs").tabs(".banner > div", {
		
			// enable "cross-fading" effect
			effect: 'fade',
			fadeInSpeed: 500,
			fadeOutSpeed: 500,
		
			// start from the beginning after the last tab
			rotate: true
		
		// use the slideshow plugin. It accepts its own configuration
		}).slideshow({autoplay: true, interval:5000});
		});
	</script>			
</div>				
<!-- End banner container -->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<!-- Start welcome Box -->
		<div class="welcomeBox">
			<div class="lft">
				<div class="heading">Welcome to Living Alpha</div>
				<p>Welcome to our most unique and amazing top quality journal and adventure based social networking Site.  Join us and start creating your Alpha-Autobiography and select custom sharing levels with each entry from the whole world to completely private or to only select friends and family members.  At Living Alpha, we are creating the world’s largest database of autobiographies in the world and together we will help everyone to achieve their highest possible dreams one entry at a time.			<?php #echo $this->Html->link('... Read More', array('controller'=>'pages', 'action'=>'display','about_us')); ?>
			</p>

			</div>
			<div class="mid" style="padding-left:20px;">
				<div class="myalphaworld">My Alpha World</div>
				<img src="<?php echo $this->webroot ; ?>img/alphaworld.gif" alt="" />
			</div>
			<div class="rgt">
				<div class="headTxt">Featured  Journal Videos (Coming Soon)</div>
				<div class="jVideo">

					<div><a href="#"><img src="<?php echo $this->webroot ; ?>img/video1.jpg" alt="" /></a></div>
					<p>Alan added a video to his Journal "My Greatest Scuba Dive"</p>							
				</div>
				<div class="jVideo">
					<div><a href="#"><img src="<?php echo $this->webroot ; ?>img/video2.jpg" alt="" /></a></div>
					<p>Alan added a video to his Journal "My Greatest Scuba Dive"</p>
				</div>
				<div class="jVideo lstVideo">

					<div><a href="#"><img src="<?php echo $this->webroot ; ?>img/video3.jpg" alt="" /></a></div>
					<p>Alan added a video to his Journal "My Greatest Scuba Dive"</p>
				</div>
				<div class="clr"></div>										
			</div>
			<div class="clr"></div>
		</div>
		<!-- End welcome Box -->

		<div class="jEntries">	
			<div class="hd">Recent Alpha Journal Entries</div>
			<table border="0" cellpadding="0" cellspacing="0" width="1000">
			<tr class="topBar">
			<td width="140" style="padding-left:4px">Date of Event</td>
			<td width="200">Location</td>
			<td width="200">Activity</td>
	
			<td width="300">Short Description</td>
			<td width="120">Ratings</td>
			</tr>
			<?php 
				foreach ($journals as $journal) :
			?>
				<tr>
				<td style="border-bottom:1px solid #aaa;padding-left:4px"><?php echo CakeTime::format('F jS, Y ', $journal['Journal']['date_event']) ;?></td>
				<td style="border-bottom:1px solid #aaa"><?php echo $journal['Journal']['location'] ;?></td>
				<td style="border-bottom:1px solid #aaa"><?php echo $journal['Area']['name'] ;?></td>
				<td style="border-bottom:1px solid #aaa"><?php echo $journal['Journal']['title'] ;?></td>
				<td style="border-bottom:1px solid #aaa">
				<?php
					$rate  = 0 ;
					$trate = 0 ;
					foreach ($journal['Journalrate'] as $journalrate) :
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
				
						for ($x=1;$x<6;$x++) {
								print("<img src=\"{$this->webroot}img/rating_icon_gry.gif\" alt=\"\" />");
						}	
					?>
				<?php  } ?>
				</td>
				</tr>
			<?php 
					endforeach ;?>
			</table>
		</div>
	</div>
</div>
<!--Gallery Start-->
<div class="photoBox">
	<div class="headTxt">Recent Journal Photos</div>
	<!--End loopedSlider-->
	<div id="loopedSlider">
		<div class="container">
			<div class="slides">
				<?php
					$i = 0 ; 
					$jid= "";
					foreach ($photos as $photo) : 
						if ($i == 0) {
				?>
				<div>	  			
					<div class="bnrSlideMain">				
						<ul>
							<?php			
									}
									if ($photo['Photo']['sharing_level'] == 2) {
										if ($jid != $photo['Photo']['journal_id']) {
											$jid = $photo['Photo']['journal_id'] ;
							?>
								<li>
								<?php 
											if (file_exists('img/'.$photo['Photo']['name'])) {
												echo $this->Html->link($this->Html->image($photo['Photo']['name'], 
																		array('height'=>'170')),
															array('controller'=>'photos','action'=>'photo',$photo['Photo']['id']),
															array('escape'=>false));
								?>
								</li>
								<?php 
												$i++;
												if ($i>4) {
													$i = 0 ;
								 ?>
						</ul>
					</div>
				</div>
							<?php
												}
								 			}
										}
									}
								endforeach;
								if ($i < 4) {
							?>
						</ul>
					</div>
				</div>
				<?php } ?>
				</div>
			</div>

		</div>
		<ul class="pagination">
			<li><a href="#">&nbsp;</a></li>
			<li><a href="#">&nbsp;</a></li>
			<li><a href="#">&nbsp;</a></li>
			<li><a href="#">&nbsp;</a></li>
			<li><a href="#">&nbsp;</a></li>
		</ul>
		<a href="#" class="previous">&nbsp;</a> <a href="#" class="next">&nbsp;</a>					
	</div>									
</div>
</div>
</div>
</div>
</div>
</div>
<?php
	App::uses('Validation', 'Utility');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><span class="notice">';
			echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
			echo '<br/>';
			echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
		echo '</span></p>';
	}
?>


