<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="headingBg">
			<div class="lt">
				<div class="rt" style="padding-top:11px;">
				<?php 
					echo $this->Html->link(substr($objJournal->getAttr('title'),0,40). "... -  " . CakeTime::format('F jS, Y ', $objJournal->getAttr('date_event')),array('action'=>'index')) ; 
				?>
				</div>
			</div>		
		</div>				
		<div class="cntrCntr">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>


			</div>
			<!-- End of Profile Left bar -->	
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft">	
					<!--Start event Box-->
					<div class="eventBox">
						<div class="btnBack">
							<?php 
								echo $this->Html->link($this->Html->image('backto_album.gif'),
													array('controller'=>'videos','action'=>'index'),
													array('escape'=>false)) ;
							?>
						</div><br>
					</div>
					<div>
						<div class="bluBar">
							Global videos
						</div>
						<?php
							$vsl2 = 2-$objJournal->getVideosPerSharingLevel(2);
							if ( $vsl2 < 3 && $vsl2 > 0 ) {
						?>
						<div id="addphtobtn">
							<a href="javascript://" onclick="pop_show_hide('albumbox2v')">
								<?php 
									echo $this->Html->image('add_videos.gif'); 
								?>
							</a>
						</div>
						<div class="albumUpper" id="albumbox2v" style="display:none">
							<div class="albumLower" style="width:auto">
								<div class="close">
									<a href="javascript://" onclick="pop_hide('albumbox2v')" id="close2">
										Close
									</a>
								</div>
								<div class="headblk">
									Album - add up to 
									<span id="photocount">
										<?php 
											echo $vsl2 ;
										?>
									</span> 
									videos
								</div>
								<div class="albumtxt">
									Add pictures based on sharing level and you can choose more than one picture by holding the CTRL Key, in the Picture browser pop-up window, our you can drag and drop.
								</div>
								<div id="upldphto">
									<?php 
										echo $this->Form->input('file_uploadv2', array(
																	'div' => false, 
																	'label'=> false,
																	'id'=>'file_uploadv2',
																	'type' => 'file','multiple'));
									?>	<br clear="all">	
									<div id="queuev2"></div>
									<script type="text/javascript">
										$(function() {
										if ($.browser.msie) {
											$('#file_uploadv2').uploadify({
												'swf'   :  <?php echo "'".$this->webroot."include/uploadify.swf". "'" ?>,
												'height'			: 23,
												'width'				: 120,	
												'uploader'			: <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj2".$objJournal->getID()."'" ?>,
												'auto'				: true,
												'queueID'			: 'queuev2',
												'queueSizeLimit'	: <?php echo $vsl2; ?>,
												'onUploadStart': function(file){
													$("#queuev2").html('<h3>Uploading video. Please wait.</h3><img src="<?php echo $this->webroot?>img/loading.gif">');
												},			
												'onQueueComplete' : function(file) {
													$("#albumbox2v").html('<h3>Your videos has been added.</h3>');
	 									   		}
											});

										} else { 
											$('#file_uploadv2').uploadifive({
												'auto'         : true,
												'queueID'      : 'queuev2',
												'queueSizeLimit'   : <?php echo $vsl2; ?>,
												'uploadScript' : <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj2".$objJournal->getID()."'" ?>
												});
											}
										 });

									</script>
								</div>

							</div>

						</div>
						<?php
							}
							if ($vsl2 != 2) {

						?>
						
						<!--Start albumVideo -->
						<div class="albumVideo" id="VideoAlbum2p" >
							<ul>
								<?php 
									foreach ($objJournal->Video as $video) : 
										if ($video->getAttr('sharing_level') == 2) {
								?>
								<li style="width:225px">
									<div>
										<div id="btndelphto">
											<?php 
												echo $this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')),array('controller' => 'videos' ,'action' => 'delete', $video->getID(), $objJournal->getID()),array('escape'=> false),__('Are you sure you want to delete this video?'));
											?>
										</div>
										<?php 
											echo $this->Html->link($this->Html->image($video->getFullPathAndVideoName(), array('width'=>'225','height'=>'180')),array('controller'=>'videos', 'action'=>'playvideo',$video->getID(), $objJournal->getID()),array('escape'=>false)) ; 
										?>
										<div>
											<div id="desc<?php echo $video->getID(); ?>" style="display:block">
												<p style="padding:7px 0 5px 0;text-align:center">
													<?php 
														echo ($video->getAttr('description') != null ? $video->getAttr('description') : 'Add a description' );
													?>
												</p>
												<p style="text-align:right">
													<a href="#">
														Edit
														<img src="<?php echo $this->webroot; ?>img/edit_icon.png" width="18px">
													</a>
												</p>
											</div>
											<div id="caption<?php echo $video->getID(); ?>" style="display:none;text-align:center;padding:7px 0 5px 0;">
												<?php
													$videodesc = "" ;
													echo $this->Form->create('Video', array('action'=>'saveDesc')) ; 
													echo $this->Form->input('id', array('type'=>'hidden','value'=>$video->getID()));
													echo $this->Form->input('journal_id', array('type'=>'hidden','value'=>$objJournal->getID()));
													echo $this->Form->input('description', array(
																				'label'=>false,
																				'div'=>false,
																				'value'=>$video->getAttr('description')));
													echo $this->Form->submit('save_update.jpg', array('style'=>'padding-top:5px;'));
													echo $this->Form->end();
												?>
											</div>
											<script type="text/javascript">
												$(document).ready(function(){
			
												   $("#desc<?php echo $video->getID(); ?>").click(function(){
														$("#caption<?php echo $video->getID(); ?>").css("display","block");
														$("#desc<?php echo $video->getID(); ?>").css("display","none");
													});
												});
									 
											</script>
										</div>
									</div>
								</li>
								<?php 
										}
									endforeach; 
								?>
							</ul>
							<div class="clr"></div>							
						</div>
						<!--End albumBox -->
						<?php
							}
						?>
					</div>
					<div>
						<?php 
							if (count($friendlist) != 0) { 
						?>
						<div class="bluBar">
							Videos for Friends
						</div><br>
						<?php
								$vsl1 = 2-$objJournal->getVideosPerSharingLevel(1);
								if ( $vsl1 < 3 && $vsl1 > 0 ) {
						?>
						<div id="addphtobtn">
							<a href="javascript://" onclick="pop_show_hide('albumbox1v')">
								<?php 
									echo $this->Html->image('add_videos.gif'); 
								?>
							</a>
						</div>
						<div class="albumUpper" id="albumbox1v" style="display:none">
							<div class="albumLower" style="width:auto">
								<div class="close">
									<a href="javascript://" onclick="pop_hide('albumbox1v')" id="close1">
										Close
									</a>
								</div>
								<div class="headblk">
									Album - add up to 
									<span id="photocount">
										<?php 
											echo $vsl1 ;
										?>
									</span> 
									videos
								</div>
								<div class="albumtxt">
									Add pictures based on sharing level and you can choose more than one picture by holding the CTRL Key, in the Picture browser pop-up window, our you can drag and drop.
								</div>
								<div id="upldphto">
									<?php 
										echo $this->Form->input('file_uploadv1', array(
																	'div' => false, 
																	'label'=> false,
																	'id'=>'file_uploadv1',
																	'type' => 'file','multiple'));
									?>	<br clear="all">	
									<div id="queuev1"></div>
									<script type="text/javascript">
										$(function() {
											var zz1 = 0;
										if ($.browser.msie) {
											$('#file_uploadv1').uploadify({
												'swf'   			:  <?php echo "'".$this->webroot."include/uploadify.swf". "'" ?>,
												'height'			: 23,
												'width'				: 120,	
												'uploader'			: <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj1".$objJournal->getID()."'" ?>,
												'auto'				: true,
												'queueID'			: 'queuev1',
												'queueSizeLimit'	: <?php echo $vsl1; ?>,
												'onUploadStart'		: function(file){
													$("#queuev1").append('<div id="upld_' + zz1 + '"></div>');
													},
												'onUploadProgress': function( file , data ){
													$("#upld_"+zz1).html('<h3>'+ file.name + '</h3> ' + Math.round( (data/1048576) * Math.pow(10,2)) / Math.pow(10,2)  + ' Kbytes sent. <span id="span_'+zz1+'">Please wait.</span><br>');
												},			
												'onUploadComplete' : function(file) {
													$("#span_"+zz1).html( '<b style="color:darkgreen">Video has been added.</b>');
													zz1++;
	 									   		}
											});

										} else { 
											$('#file_uploadv1').uploadifive({
												'auto'         : true,
												'queueID'      : 'queuev1',
												'queueSizeLimit'   : <?php echo $vsl1; ?>,
												'uploadScript' : <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj1".$objJournal->getID()."'" ?>
												});
											}
										 });

									</script>
								</div>

							</div>

						</div>
						<?php
							}
							if ($vsl1 != 2){

						?>
						
						<!--Start albumVideo -->
						<div class="albumVideo" id="VideoAlbum1p" >
							<ul>
								<?php 
									foreach ($objJournal->Video as $video) : 
										if ($video->getAttr('sharing_level') == 1) {
								?>
								<li style="width:225px">
									<div>
										<div id="btndelphto">
											<?php 
												echo $this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')),array('controller' => 'videos' ,'action' => 'delete', $video->getID(), $objJournal->getID()),array('escape'=> false),__('Are you sure you want to delete this video?'));
											?>
										</div>
										<?php 
											echo $this->Html->link($this->Html->image($video->getFullPathAndVideoName(), array('width'=>'225','height'=>'180')),array('controller'=>'videos', 'action'=>'playvideo',$video->getID(), $objJournal->getID()),array('escape'=>false)) ; 
										?>
										<div>
											<div id="desc<?php echo $video->getID(); ?>" style="display:block">
												<p style="text-align:center">
													<?php 
														echo ($video->getAttr('description') != null ? $video->getAttr('description') : 'Add a description' );
													?>
												</p>
												<p style="text-align:right">
													<a href="#">
														Edit
														<img src="<?php echo $this->webroot; ?>img/edit_icon.png" width="18px">
													</a>
												</p>
											</div>
											<div id="caption<?php echo $video->getID(); ?>" style="display:none;text-align:center">
												<?php
													$videodesc = "" ;
													echo $this->Form->create('Video', array('action'=>'saveDesc')) ; 
													echo $this->Form->input('id', array('type'=>'hidden','value'=>$video->getID()));
													echo $this->Form->input('journal_id', array('type'=>'hidden','value'=>$objJournal->getID()));
													echo $this->Form->input('description', array(
																				'label'=>false,
																				'div'=>false,
																				'value'=>$video->getAttr('description')));
													echo $this->Form->submit('save_update.jpg');
													echo $this->Form->end();
												?>
											</div>
											<script type="text/javascript">
												$(document).ready(function(){
			
												   $("#desc<?php echo $video->getID(); ?>").click(function(){
														$("#caption<?php echo $video->getID(); ?>").css("display","block");
														$("#desc<?php echo $video->getID(); ?>").css("display","none");
													});
												});
									 
											</script>
										</div>
									</div>
								</li>
								<?php 
										}
									endforeach; 
								?>
							</ul>
							<div class="clr"></div>							
						</div>
						<!--End albumBox -->
						<?php 
									}
								}
						?>
					</div>
					<div>
						<!--Start albumBox -->
						<div class="bluBar">Videos for My Eyes only
						</div><br>
						<?php
							$vsl0 = 2-$objJournal->getVideosPerSharingLevel(0);
							if ( $vsl0 < 3 && $vsl0 > 0 ) {
						?>
						<div id="addphtobtn">
							<a href="javascript://" onclick="pop_show_hide('albumbox0v')">
								<?php 
									echo $this->Html->image('add_videos.gif'); 
								?>
							</a>
						</div>
						<div class="albumUpper" id="albumbox0v" style="display:none">
							<div class="albumLower" style="width:auto">
								<div class="close">
									<a href="javascript://" onclick="pop_hide('albumbox0v')" id="close0">
										Close
									</a>
								</div>
								<div class="headblk">
									Album - add up to 
									<span id="photocount">
										<?php 
											echo $vsl0 ;
										?>
									</span> 
									videos
								</div>
								<div class="albumtxt">
									Add pictures based on sharing level and you can choose more than one picture by holding the CTRL Key, in the Picture browser pop-up window, our you can drag and drop.
								</div>
								<div id="upldphto">
									<?php 
										echo $this->Form->input('file_uploadv0', array(
																	'div' => false, 
																	'label'=> false,
																	'id'=>'file_uploadv0',
																	'type' => 'file','multiple'));
									?>	<br clear="all">	
									<div id="queuev0"></div>
									<script type="text/javascript">
										$(function() {
										if ($.browser.msie) {
											$('#file_uploadv0').uploadify({
												'swf'   :  <?php echo "'".$this->webroot."include/uploadify.swf". "'" ?>,
												'height'			: 23,
												'width'				: 120,	
												'uploader'			: <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj0".$objJournal->getID()."'" ?>,
												'auto'				: true,
												'queueID'			: 'queuev0',
												'queueSizeLimit'	: <?php echo $vsl0; ?>,
												'onUploadStart'		: function(file){$("#queuev0").html('<h3>Uploading video. Please wait.</h3><img src="<?php echo $this->webroot?>img/loading.gif">');},			
												'onUploadComplete' 	: function(file) {$("#queuev0").html('<h3>Video Uploaded Complete.</h3>');}
											});

										} else { 
											$('#file_uploadv0').uploadifive({
												'auto'         : true,
												'queueID'      : 'queuev0',
												'queueSizeLimit'   : <?php echo $vsl2; ?>,
												'uploadScript' : <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj0".$objJournal->getID()."'" ?>
												});
											}
										 });

									</script>
								</div>

							</div>

						</div>
						<?php
							}
							if ($vsl0 != 2) {

						?>
						
						<!--Start albumVideo -->
						<div class="albumVideo" id="VideoAlbum0p" >
							<ul>
								<?php 
									foreach ($objJournal->Video as $video) : 
										if ($video->getAttr('sharing_level') == 0) {
								?>
								<li style="width:225px">
									<div>
										<div id="btndelphto">
											<?php 
												echo $this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')),array('controller' => 'videos' ,'action' => 'delete', $video->getID(), $objJournal->getID()),array('escape'=> false),__('Are you sure you want to delete this video?'));
											?>
										</div>
										<?php 
											echo $this->Html->link($this->Html->image($video->getFullPathAndVideoName(), array('width'=>'225','height'=>'180')),array('controller'=>'videos', 'action'=>'playvideo',$video->getID(), $objJournal->getID()),array('escape'=>false)) ; 
										?>
										<div>
											<div id="desc<?php echo $video->getID(); ?>" style="display:block">
												<p style="padding:7px 0 5px 0;text-align:center">
													<?php 
														echo ($video->getAttr('description') != null ? $video->getAttr('description') : 'Add a description' );
													?>
												</p>
												<p style="text-align:right">
													<a href="#">
														Edit
														<img src="<?php echo $this->webroot; ?>img/edit_icon.png" width="18px">
													</a>
												</p>
											</div>
											<div id="caption<?php echo $video->getID(); ?>" style="display:none;text-align:center;padding:7px 0 5px 0;">
												<?php
													$videodesc = "" ;
													echo $this->Form->create('Video', array('action'=>'saveDesc')) ; 
													echo $this->Form->input('id', array('type'=>'hidden','value'=>$video->getID()));
													echo $this->Form->input('journal_id', array('type'=>'hidden','value'=>$objJournal->getID()));
													echo $this->Form->input('description', array(
																				'label'=>false,
																				'div'=>false,
																				'value'=>$video->getAttr('description')));
													echo $this->Form->submit('save_update.jpg', array('style'=>'padding-top:5px;'));
													echo $this->Form->end();
												?>
											</div>
											<script type="text/javascript">
												$(document).ready(function(){
			
												   $("#desc<?php echo $video->getID(); ?>").click(function(){
														$("#caption<?php echo $video->getID(); ?>").css("display","block");
														$("#desc<?php echo $video->getID(); ?>").css("display","none");
													});
												});
									 
											</script>
										</div>
									</div>
								</li>
								<?php 
										}
									endforeach; 
								?>
							</ul>
							<div class="clr"></div>							
						</div>
						<!--End albumBox -->
						<?php
							}
						?>
						</div>			
					<div class="socialdetail">
						<div class="clr"></div>
					</div>						
					<!--Start commentdetail -->
					<div class="commentDetail albumCmnt">
						<?php
							foreach ($albumcomments as $comment) : ?>
						<div class="line">
							<?php 
								if (($comment['Albumcomment']['user_id'] == Authcomponent::user('id')) || ($journals['Journal']['user_id'] == Authcomponent::user('id')))
									echo $this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')), 
													array('controller' => 'videos' ,'action' => 'deletecomment', $comment['Albumcomment']['id'], $journals['Journal']['id']),
													array('escape'=> false), 
													__('Are you sure you want to delete this comment?')); 
							?>
							<div class="icon">
								<?php
//									echo "<pre>".print_r($albumcomments,true)."</pre>";
									echo $this->Html->image($comment['User']['Picture']['name'], 
											array('width' => '40', 'url' => 
												array('controller'=>'users','action'=>'profile',$comment['User']['id'])));
								?>
							</div>
							<div class="albummidtxt">
								<?php echo $comment['Albumcomment']['comment'] ; ?><br>
								<span>
								<?php 
									if (CakeTime::isToday($comment['Albumcomment']['created'])) echo CakeTime::timeAgoInWords($comment['Albumcomment']['created']);
									if (CakeTime::wasYesterday($comment['Albumcomment']['created'])) echo 'Yesterday';
									?></span>

							</div>
							<div class="date">
								<span>
									<?php echo CakeTime::format('h:m | F d', $comment['Albumcomment']['created']) ; ?>
								</span>
								<br />
								<a href="#"><img src="<?php echo $this->webroot ; ?>img/like_icon.gif" alt="" class="vAlign" /> Like</a></div>
							<div class="clr"></div>
						</div>
						<?php
							endforeach;
						?>
						<div align="center">
						<?php 
							echo $this->Form->create('Albumcomment', array('controller'=>'videos','action'=>'saveAlbumcomment')) ;
							echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>AuthComponent::user('id')));
							echo $this->Form->input('journal_id', array('type'=>'hidden', 'value'=>$journals['Journal']['id']));
							echo $this->Form->input('comment', array(
														'div'=>false,
														'label'=>false,
														'class'=>'messagearia',
														'onblur'=>'replaceText(this)',
														'onfocus'=>'clearText(this)'
														));
							echo $this->Form->end();
							?>
						</div>																				
					</div>
					<!--End commentdetail -->
					
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


