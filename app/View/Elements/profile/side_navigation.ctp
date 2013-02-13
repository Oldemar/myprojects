<?php 
//	echo "<pre>".print_r($notviewedjournals,true)."</pre>"; 
?>
<!-- Start innerlink Box -->
<div class="innerlinkBox">
	<ul>
		<li>
			<div class="loct"><?php echo $this->Html->image('myworldicons/Group.gif') ?></div>
				<?php echo $this->Html->link('My Profile',array('controller'=> 'users', 'action' => 'index')); ?>
		</li>
		<li>
			<div class="loct"><?php echo $this->Html->image('myworldicons/Journals.gif') ?></div>
			<?php echo $this->Html->link('My Alpha Journals',array('controller'=> 'journals', 'action' => 'index')); ?>
		</li>
<!-- 		<?php if ($relatedusers != null && $relatedusers > 0) { ?>
		<?php } ?> -->
		<!--<li>
			<div class="loct"><img src="<?php echo $this->webroot ; ?>img/green_square.jpg" alt="" /></div>
				<?php echo $this->Html->link('My Alpha Bits', '#', array('class'=>'inactiveelement')); ?>
		</li>
		<li>
			<div class="loct"><img src="<?php echo $this->webroot ; ?>img/black_square.jpg" alt="" /></div>
				<?php echo $this->Html->link('My Dream Lists', '#', array('class'=>'inactiveelement')); ?>
		</li>	
		<li>
			<div class="loct"><img src="<?php echo $this->webroot ; ?>img/yellow_square.jpg" alt="" /></div>
				<?php echo $this->Html->link('Events', '#', array('class'=>'inactiveelement')); ?>	
	   </li>
	   <li>
			<div class="loct"><img src="<?php echo $this->webroot ; ?>img/sky_blu_square.jpg" alt="" /></div>
				<?php echo $this->Html->link('Messages', '#', array('class'=>'inactiveelement')); ?>
		</li>   -->								
		<li>
			<div class="loct"><?php echo $this->Html->image('myworldicons/Interests.gif'); ?></div>
				<?php echo $this->Html->link('My Alpha Interests', '/interests'); ?>
		</li>
		<li>
		<div class="loct"><?php	echo $this->Html->image('myworldicons/list.gif'); ?></div>
				<?php 
					echo $this->Html->link('My Friends List', '/users/friends');
					if (count($frRqs) > 0) { 
					?>
				<a href="javascript://" class="number" onclick="pop_show('popfriendlist')">
					<?php echo count($frRqs); ?>
				</a>
				<div class="popcntr" id="popfriendlist">											
				<div class="notoficationhead">Friend Requests</div>
				<?php 
					foreach ($frRqs as $frReqs) :
 				?>
 				<div class="popupclose">
					<a href="javascript://" onclick="pop_hide('popfriendlist')">
						<img src="<?php echo $this->webroot ; ?>img/close.gif" alt="" />
					</a>
				</div>
				<!--line 1 -->
				<div class="popnavLine">
					<div class="innerpopimage">
					<?php
						if (isset($frReqs['User_A']['Picture']['w40']) && $frReqs['User_A']['Picture']['w40'] != null ) {
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
					<div class="innerpopmid">
						<div class="postdetailLt">
							<div class="hd">
							<?php
							echo $this->Html->link($frReqs['User_A']['firstname']." ".$frReqs['User_A']['lastname'], 
										array('controller'=>'users', 'action' => 'profile', $frReqs['User_A']['id']));
							?>
							</div>											
							<div class="postdetail">
								<span>From : </span> 
								<span class="type">
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
								</span>
								
							</div>
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
					<div class="clr"></div>
				</div>
	
				<?php endforeach; ?>
			</div>
			<?php } ?>
		</li>
		<li>
		<div class="loct"><?php echo $this->Html->image('myworldicons/photos.gif'); ?></div>
				<?php echo $this->Html->link('My Photo Albums', array('controller'=>'photos', 'action'=>'index')); ?>
		</li>
		<li>

			<div class="loct"><?php echo $this->Html->image('myworldicons/Video.gif'); ?></div>
				<?php echo $this->Html->link('My Video Albums', array('controller'=>'videos', 'action'=>'index')); ?>
		</li>
		<li>
			<div class="loct"><?php echo $this->Html->image('myworldicons/Group.gif'); ?></div>
				<?php echo $this->Html->link('My Groups',array('controller'=>'groups', 'action'=>'index')); ?>
		</li>
		<!--<li class="last">
			<div class="loct"><img src="<?php echo $this->webroot ; ?>img/blue_square.jpg" alt="" /></div>
				<?php echo $this->Html->link('My Products', '#', array('class'=>'inactiveelement')); ?>
		</li> -->								
	</ul>
</div>
<!-- End innerlink Box -->
