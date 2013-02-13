
		<div class="headblk">You can add up to 
			<span id="photocount">
				<?php echo $countAllowedVideos ?>
			</span> videos
		</div>
		<div class="albumtxt">
			Add videos based on sharing level and you can choose more than one video by holding the CTRL Key, in the video browser pop-up window.
		</div>
		<div id="upldphto">
			
			<?php 
				echo $this->Form->input('file_uploadv'.$sharingLevel, array(
											'div' => false, 
											'label'=> false,
											'id'=>'file_uploadv'.$sharingLevel,
											'type' => 'file','multiple'
						));
			?>
			<br clear="all">	
			<div id="queuev<?php echo $sharingLevel;?>" style="display:none;"></div>
	
			<script type="text/javascript">
				if ($.browser.msie) {
					$('#file_uploadv<?php echo $sharingLevel;?>').uploadify({
						'swf'   			:  <?php echo "'".$this->webroot."include/uploadify.swf". "'" ?>,
						'height'			: 23,
						'width'				: 120,	
						'uploader'			: <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj".$sharingLevel.$objJournal->getID()."'" ?>,
						'auto'				: true,
						'queueID'			: 'queuev<?php echo $sharingLevel;?>',
						'queueSizeLimit'	: <?php echo $countAllowedVideos; ?>,
						'onUploadStart': function(file){
							//$("#queuev<?php echo $sharingLevel;?>").html('<h3>Uploading photo. Please wait.</h3><img src="<?php echo $this->webroot?>img/loading.gif">');
							
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$('#queuev<?php echo $sharingLevel;?>').css('display','none');
							modalFooter.html('<div class="alert alert-info">Your videos are being uploaded please wait.</div>');
						},			
						'onQueueComplete' : function(file) {
							$("#<?php echo $modalId; ?>").trigger('refreshBody');
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$.get("<?php echo $this->Html->url(array('controller'=>'videos','action'=>'displayVideosInRows',$objJournal->getID(),$sharingLevel));?>", function(data) {
								$('#<?php echo $divDestinationId;?>').html(data);
							});
							
							$('#queuev<?php echo $sharingLevel;?>').css('display','none');
							modalFooter.html('<button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Your videos have been uploaded. Click here to close this window.</button>');
     					}
					});
				} else { 
					
					$('#file_uploadv<?php echo $sharingLevel;?>').uploadifive({
						'auto'         : true,
						'queueID'      : 'queuev<?php echo $sharingLevel;?>',
						'queueSizeLimit'   : <?php echo $countAllowedVideos; ?>,
						'uploadScript' : <?php echo "'".$this->webroot."include/vuploadifive.php?j=vj".$sharingLevel.$objJournal->getID()."'" ?>,
						'onUpload' : function(file) {
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$('#queuev<?php echo $sharingLevel;?>').css('display','block');
							modalFooter.html('<div class="alert alert-info">Your videos are being uploaded please wait.</div>');
						},
						'onInit' : function(file){
							$('.uploadifive-button input').css('cursor','pointer');
						},	
						'onQueueComplete' : function(file) {
							$("#<?php echo $modalId; ?>").trigger('refreshBody');
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$.get("<?php echo $this->Html->url(array('controller'=>'videos','action'=>'displayVideosInRows',$objJournal->getID(),$sharingLevel));?>", function(data) {
								$('#<?php echo $divDestinationId;?>').html(data);
							});
							$('#queuev<?php echo $sharingLevel;?>').css('display','none');
							$("#queuev<?php echo $sharingLevel;?>").html('<h3>Your videos has been added.</h3>');
							modalFooter.html('<button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Your videos have been uploaded. Click here to close this window.</button>');
     					}
						
					});
				}
			 


			</script>


		</div>