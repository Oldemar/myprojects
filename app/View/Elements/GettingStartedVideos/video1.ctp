<?php 
$objController->loadAditionalJs('jwplayer/jwplayer');
?>
<a href="#" id="videoAlpha1"><img src="<?php echo $this->webroot ; ?>img/LA-video1.jpg" alt="" /><b><br>An introduction to Living Alpha.</b></a>
<div id="alphaVideo1" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video1').stop();">x</button>
		<b>An introduction to Living Alpha</b>
	</div>
	<div class="modal-body">
	
		<div id='my-video1'></div>
		<script type='text/javascript'>
		    jwplayer('my-video1').setup({
		    	file: 'rtmp://s3qugur08jn5mn.cloudfront.net/cfx/st/mp4:img/LA-INTRO-HD.mp4',
		        width: '480',
		        height: '270',
		        image: '<?php echo $this->webroot."img/VideoBox-480x270.png" ?>'
		    });
		</script>

	</div>
</div>
<script>
	$("#videoAlpha1").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo1").modal({show:true});		
	});
</script>