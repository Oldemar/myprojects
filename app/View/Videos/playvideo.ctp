<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
<div id="my-video"></div>
<script type='text/javascript'>
	if (!$.browser.msie) {
		jwplayer('my-video').setup({
	        file: '<?php echo $video['url'] == '/img/' ? '/img/' : 'rtmp://s3qugur08jn5mn.cloudfront.net/cfx/st/mp4:img/'.$video['Video']['name'].".mp4"; ?>',
	        width: '530',
	        height: '370',
	        image: '<?php echo $video['Video']['url'].$video['Video']['w375'].".jpg"; ?>'
	    });
	} else {
		$('#my-video').replaceWith('<div id="my-video"><h1>Please note that you may experience a few minor issues when viewing LivingAlpha using Internet Explorer.  For optimum results, we recommend using Chrome or Mozilla-Firefox.<br>Thank you for your understanding.</h1></div>');
	}
</script>

<br><br>

<div class="clr"></div>
