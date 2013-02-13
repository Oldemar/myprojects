<?php 
$objController->loadAditionalCss('bootstrap.javascript.photomodal');
?>
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div class="cntrCntr" style="background:none">			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>


			</div>
			<!-- End of Profile Left bar -->	
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft" style="width:744px">	
					<!--Start event Box-->
					<div class="bluBar_wide" id="divWallace">
						<?php echo $journals['Journal']['title']; ?>
						<span style="float:right;padding-right:30px;">
							<?php 
							echo CakeTime::format('F jS, Y ', $objJournal->getAttr('date_event')) ;
							?>
						</span>
					</div>		
							
					<!--Start albumPhoto -->
					<div style="margin-top:5px;" class="popover_journal_list left">
						<h3 class="popover_journal_list-title" style="font-size:14px; line-height:30px;">
							<b>
								<span class="label label-success">
									G
								</span>
								For Alpha world
							</b> 
							<div class="btn-group" style="float:right;padding:3px 5px 0 0">
					    
						    	<a href="javascript:;" data-toggle="dropdown" class='btn btn-mini btn-primary dropdown-toggle'>
						    		<i class="icon-list-alt icon-white"></i> 
						    			Actions 
						    		<span class="caret"></span>
								</a>
							
						    	<ul class="dropdown-menu" style="width: 145px;">
					    			<li style="width:auto;height:auto;">
					    				<?php echo $this->Html->link('<i class="icon-arrow-left"></i> Back to Albums', 
					    								array('controller' => 'photos', 'action' => 'index'),
					    								array('escape'=> false)); 
					 	   				?>
					    			</li>
									<?php
										if ($objJournal->getCountAllowedPhotosUpload(2)) {
									?>
					    			<li style="width:auto;height:auto;">
					    				<a  href="javascript://" id="addPhotoButton2">
					    					<i class="icon-plus"></i> 
					    						Add a photo
					    				</a>
					    			</li>
					    			<?php
										}
									?>
								</ul>
								<?php 
									echo $this->Modal->photoUpload('addPhotoButton2', $objJournal, 2 , 'PhotoAlbum2p');
								?>
					    	</div>
						</h3>
						<div class="popover_journal_list-content">
							<div class="row-fluid">
								<div id="PhotoAlbum2p" >
									<?php 
										echo $this->element('Photos/list_photos', array('objJournal'=>$objJournal,'sharingLevel'=>'2')) 
									?>
									<div class="clr"></div>							
								</div>
							</div>
						</div>
						<h3 class="popover_journal_list-title" style="font-size:14px; line-height:30px;border-top:1px solid #EBEBEB">
							<b>
								<span class="label label-info">
									F
								</span>
								For Alpha friends
							</b> 
							<div class="btn-group" style="float:right;padding:3px 5px 0 0">
					    
						    	<a href="javascript:;" data-toggle="dropdown" class='btn btn-mini btn-primary dropdown-toggle'>
						    		<i class="icon-list-alt icon-white"></i> 
						    			Actions 
						    		<span class="caret"></span>
								</a>
							
						    	<ul class="dropdown-menu" style="width: 145px;">
					    			<li style="width:auto;height:auto;">
					    				<?php echo $this->Html->link('<i class="icon-arrow-left"></i> Back to Albums', 
					    								array('controller' => 'photos', 'action' => 'index'),
					    								array('escape'=> false)); 
					 	   				?>
					    			</li>
									<?php
										if ($objJournal->getCountAllowedPhotosUpload(1)) {
									?>
					    			<li style="width:auto;height:auto;">
					    				<a  href="javascript://" id="addPhotoButton1">
					    					<i class="icon-plus"></i> 
					    						Add a photo
					    				</a>
					    			</li>
					    			<?php
										}
									?>
								</ul>
								<?php 
									echo $this->Modal->photoUpload('addPhotoButton1', $objJournal, 1 , 'PhotoAlbum1p');
								?>
					    	</div>
						</h3>
						<div class="popover_journal_list-content">
							<div class="row-fluid">
								<div id="PhotoAlbum1p" >
									<?php 
										echo $this->element('Photos/list_photos', array('objJournal'=>$objJournal,'sharingLevel'=>'1')) 
									?>
									<div class="clr"></div>							
								</div>
							</div>
						</div>
						<h3 class="popover_journal_list-title" style="font-size:14px; line-height:30px;border-top:1px solid #EBEBEB">
							<b>
								<span class="label label-important">
									P
								</span>
								For My eyes only
							</b> 
							<div class="btn-group" style="float:right;padding:3px 5px 0 0">
					    
						    	<a href="javascript:;" data-toggle="dropdown" class='btn btn-mini btn-primary dropdown-toggle'>
						    		<i class="icon-list-alt icon-white"></i> 
						    			Actions 
						    		<span class="caret"></span>
								</a>
							
						    	<ul class="dropdown-menu" style="width: 145px;">
					    			<li style="width:auto;height:auto;">
					    				<?php echo $this->Html->link('<i class="icon-arrow-left"></i> Back to Albums', 
					    								array('controller' => 'photos', 'action' => 'index'),
					    								array('escape'=> false)); 
					 	   				?>
					    			</li>
									<?php
										if ($objJournal->getCountAllowedPhotosUpload(0)) {
									?>
					    			<li style="width:auto;height:auto;">
					    				<a  href="javascript://" id="addPhotoButton0">
					    					<i class="icon-plus"></i> 
					    						Add a photo
					    				</a>
					    			</li>
					    			<?php
										}
									?>
								</ul>
								<?php 
									echo $this->Modal->photoUpload('addPhotoButton0', $objJournal, 0 , 'PhotoAlbum0p');
								?>
					    	</div>
						</h3>
						<div class="popover_journal_list-content">
							<div class="row-fluid">
								<div id="PhotoAlbum0p" >
									<?php 
										echo $this->element('Photos/list_photos', array('objJournal'=>$objJournal,'sharingLevel'=>'0')) 
									?>
									<div class="clr"></div>							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clr"></div>
			<!-- End right container -->
		</div>
	</div>
	<!-- End content container -->
</div>
<!-- End middle container -->	

<div id="photoModal" class="photomodal hide fade" aria-hidden="true">
	<div class="photomodal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3><?php echo $objJournal->getAttr('title') ?></h3>
	</div>
	<div class="photomodal-body" id="modalContent">
		
	</div>
</div>
 
