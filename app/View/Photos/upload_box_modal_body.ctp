
		<div class="headblk">You can add up to 
			<span id="photocount">
				<?php echo $countAllowedPhotos; ?>
			</span> photos
		</div>
		<div class="albumtxt">
			Add pictures based on sharing level and you can choose more than one picture by holding the CTRL Key, in the Picture browser pop-up window.
		</div>
		
		<div id="upldphto">
			
			<?php 
				echo $this->Form->input('file_uploadp'.$sharingLevel, array(
											'div' => false, 
											'label'=> false,
											'id'=>'file_uploadp'.$sharingLevel,
											'type' => 'file','multiple'
						));
			?><br clear="all">	
			<div id="queuep<?php echo $sharingLevel;?>" style="display:none;"></div>
	
			<script type="text/javascript">
				if ($.browser.msie) {
					$('#file_uploadp<?php echo $sharingLevel;?>').uploadify({
						'swf'   			:  <?php echo "'".$this->webroot."include/uploadify.swf". "'" ?>,
						'height'			: 23,
						'width'				: 120,	
						'uploader'			: <?php echo "'".$this->webroot."photos/uploadify/".$sharingLevel."/".$objJournal->getID()."'" ?>,
						'auto'				: true,
						'queueID'			: 'queuep<?php echo $sharingLevel;?>',
						'queueSizeLimit'	: <?php echo $countAllowedPhotos; ?>,
						'onUploadStart': function(file){
							//$("#queuep<?php echo $sharingLevel;?>").html('<h3>Uploading photo. Please wait.</h3><img src="<?php echo $this->webroot?>img/loading.gif">');
							
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$('#queuep<?php echo $sharingLevel;?>').css('display','none');
							modalFooter.html('<div class="alert alert-info">Your photos are being uploaded please wait.</div>');
						},			
						'onQueueComplete' : function(file) {
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$.get("<?php echo $this->Html->url(array('controller'=>'photos','action'=>'displayPhotosInRows',$objJournal->getID(),$sharingLevel));?>", function(data) {
								$('#<?php echo $divDestinationId;?>').html(data);
							});
							$('#queuep<?php echo $sharingLevel;?>').css('display','none');
							$("#<?php echo $modalId; ?>").trigger('refreshBody');
							modalFooter.html('<button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Your photos have been uploaded. Clik here to close this window.</button>');
     					}
					});
				} else { 
					
					$('#file_uploadp<?php echo $sharingLevel;?>').uploadifive({
						'auto'         : true,
						'queueID'      : 'queuep<?php echo $sharingLevel;?>',
						'queueSizeLimit'   : <?php echo $countAllowedPhotos; ?>,
						'uploadScript' : <?php echo "'".$this->webroot."photos/uploadify/".$sharingLevel."/".$objJournal->getID()."'" ?>,
						'onUpload' : function(file) {
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$('#queuep<?php echo $sharingLevel;?>').css('display','block');
							modalFooter.html('<div class="alert alert-info">Your photos are being uploaded please wait.</div>');
						},
						'onInit' : function(file){
							$('.uploadifive-button input').css('cursor','pointer');
						},	
						'onQueueComplete' : function(file) {
							var modalFooter = $("#<?php echo $modalId; ?> .modal-footer");
							$.get("<?php echo $this->Html->url(array('controller'=>'photos','action'=>'displayPhotosInRows',$objJournal->getID(),$sharingLevel));?>", function(data) {
								$('#<?php echo $divDestinationId;?>').html(data);
							});
							$('#queuep<?php echo $sharingLevel;?>').css('display','none');
							$("#queuep<?php echo $sharingLevel;?>").html('<h3>Your photos has been added.</h3>');
							modalFooter.html('<button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Your photos have been uploaded. Clik here to close this window.</button>');
							$("#<?php echo $modalId; ?>").trigger('refreshBody');
     					}
						
					});
				}
			 


			</script>


		</div>