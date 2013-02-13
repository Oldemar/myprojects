<?php 
$objController->loadAditionalJs('jwplayer/jwplayer');
?>
<a href="#" id="videoAlpha2"><img src="<?php echo $this->webroot ; ?>img/LA-video2.jpg" alt="" /><b><br>Learn about our privacy levels.</b></a>
<div id="alphaVideo2" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video').stop();">x</button>
		<b>Learn about our privacy levels.</b>
	</div>
	<div class="modal-body">
	
		<div id='my-video'></div>
		<script type='text/javascript'>
		    jwplayer('my-video').setup({
		    	file: 'rtmp://s3qugur08jn5mn.cloudfront.net/cfx/st/mp4:img/LA-SEC-HD.mp4',
		        width: '480',
		        height: '270',
		        image: '<?php echo $this->webroot."img/VideoBox-480x270.png" ?>'
		    });
		</script>

	</div>
</div>
<script>
	$("#videoAlpha2").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo2").modal({show:true});		
	});
</script>