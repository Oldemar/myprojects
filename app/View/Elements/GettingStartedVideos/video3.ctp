<?php 
$objController->loadAditionalJs('jwplayer/jwplayer');
?>
<a href="#" id="videoAlpha3"><img src="<?php echo $this->webroot ; ?>img/LA-video3.jpg" alt="" /><b><br>3 Sharing levels with each Journal.</b></a>
<div id="alphaVideo3" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video3').stop();">x</button>
		<b>3 Sharing levels with each Journal.</b>
	</div>
	<div class="modal-body">
	
		<div id='my-video3'></div>
		<script type='text/javascript'>
		    jwplayer('my-video3').setup({
		    	file: 'rtmp://s3qugur08jn5mn.cloudfront.net/cfx/st/mp4:img/LA-EventsHD.mp4',
		        width: '480',
		        height: '270',
		        image: '<?php echo $this->webroot."img/VideoBox-480x270.png" ?>'
		    });
		</script>

	</div>
</div>
<script>
	$("#videoAlpha3").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo3").modal({show:true});		
	});
</script>