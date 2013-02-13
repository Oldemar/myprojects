<?php
App::uses('Debugger', 'Utility');
?>
<!-- Start banner container -->
<div id="bannerCntr">					
	<div class="banner">								
		<div class="scroller_bl">
			<div class="<?php echo "image".rand(1,2); ?>">
				<div class="bannermid">

					<div class="slogen">
						Tracking and sharing your memories<br />and victories are key to looking back and<br />feeling great about your accomplishments.
					</div>												
					<div class="banneralpha"><a href="users/add"><img src="<?php echo $this->webroot ; ?>img/StartCreatingyouAlpha2.png" alt="" /></a></div>

					
				</div>
			</div>
		</div>

	</div>
</div>				

<!-- End banner container -->

<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr" style="padding:8px 0 26px;">
		<!-- Start welcome Box -->
		<div class="welcomeBox">
			<div class="lft">
				<div class="heading">Welcome to Living Alpha</div>
				<p style="text-align: justify; text-justify: inter-word; padding-bottom: 10px">
					After creating your Alpha World you can start tracking your important moments and share them through 1, 2 or all 3 select custom sharing levels with each Journal entry. Together, we will be <b>creating the largest database of autobiographies in the world.</b>
				</p>
				<p style="text-align:center">
				<?php echo $this->Html->image('clickalphadef.png', array('class'=>'colorbox')); ?>
				</p>
			</div>
			<div class="mid" style="padding-left:20px;">
				<div class="myalphaworld">My Alpha World</div>
				<?php echo $this->Html->image('alphaworld.gif'); ?> 
				
			</div>
			<div class="rgt">
				<div class="headTxt" style="margin-left:7px;">About Us / Getting Started Videos</div>
				<div class="jVideo">

					<div><a href="#" id="videoAlpha1"><img src="<?php echo $this->webroot ; ?>img/LA-video1.jpg" alt="" /></a></div>
					<p style="text-align:center">An introduction to LivingAlpha.</p>							
				</div>
				<div class="jVideo">
					<div><a href="#" id="videoAlpha2"><img src="<?php echo $this->webroot ; ?>img/LA-video2.jpg" alt="" /></a></div>
					<p style="text-align:center">Learn about our privacy levels.</p>
				</div>
				<div class="jVideo lstVideo">

					<div><a href="#" id="videoAlpha3"><img src="<?php echo $this->webroot ; ?>img/LA-video3.jpg" alt="" /></a></div>
					<p style="text-align:center">3 Sharing levels with each Journal.</p>
				</div>
				<div class="clr"></div>										
			</div>
			<div class="clr"></div>
		</div>
		<!-- End welcome Box -->

		<div class="jEntries">	
			<div class="hd">
				Some Recent Alpha Journal Entries
			</div>
			<?php 
				echo $this->element('journals/index_box',array('arrayObjJournal'=>$arrayObjJournal)); 
			?>
			
		</div>
	</div>
</div>

<script>
	$(".colorbox").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphadefinition").modal({show:true});		
	});
	$("#videoAlpha1").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo1").modal({show:true});		
	});
	$("#videoAlpha2").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo2").modal({show:true});		
	});
	$("#videoAlpha3").click(function(){
		$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
		$("#alphaVideo3").modal({show:true});		
	});
	
</script>


<div id="alphadefinition" class="modal" style="display:none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
		<b>Official Alpha Definition</b>
	</div>
	<div class="modal-body">
		<p style="text-align: justify">
			Anthropology says that Alpha people are the ones that like to wear the crowns, have the colorful plumage and like to stand out.  We on the other hand prefer to say it this way:<br><br>
			A person having a LivingAlpha Spirit or Personality is one who exhibits self-assurance, physical and emotional strength, self control, independence of thought, grit and a laser like focus on achieving ones goals.  A person that is LivingAlpha does not fear to try new things and to risk themselves. LivingAlpha, however; also means having a caring and long term view of the world.<br><br>
			An Alpha is one who encourages and helps others. A true Alpha person is quiet, invisible and always there for friends and family. They do not always shine the light on themselves and often prefer to recognize the achievement of others. Alphas are skilled in building personal connections and they are great team players.<br><br>
			<b>This is what we believe is LivingAlpha, and is our official Alpha Definition.</b>
		</p>
	</div>
</div>
<div id="alphaVideo1" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video1').stop();">x</button>
		<b style="color: blue">An introduction to Living Alpha</b>
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
	$("#alphaVideo1").on('hidden', function(){
		jwplayer('my-video1').stop();
	});	
</script>
<div id="alphaVideo2" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video2').stop();">x</button>
		<b>Learn about our privacy levels</b>
	</div>
	<div class="modal-body">
	
		<div id='my-video2'></div>
		<script type='text/javascript'>
		    jwplayer('my-video2').setup({
		        file: 'rtmp://s3qugur08jn5mn.cloudfront.net/cfx/st/mp4:img/LA-SEC-HD.mp4',
		        width: '480',
		        height: '270',
		        image: '<?php echo $this->webroot."img/VideoBox-480x270.png" ?>'
		    });
		</script>

	</div>
</div>
<script>
	$("#alphaVideo2").on('hidden', function(){
		jwplayer('my-video2').stop();
	});	
</script>
<div id="alphaVideo3" class="modal" style="display:none;width:510px;overflow:hidden">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="jwplayer('my-video3').stop();">x</button>
		<b>3 Sharing levels with each Journal</b>
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
	$("#alphaVideo3").on('hidden', function(){
		jwplayer('my-video3').stop();
	});	
</script>


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


