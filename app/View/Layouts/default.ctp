<?php
$titleEnvironment = Configure::read('environment') != 'production' ? Configure::read('environment').' / ' : '' ;
$cakeDescription = __d('cake_dev',$titleEnvironment.'Living Alpha - Beta V.1.0');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
echo $this->Facebook->html();

?>
<head>
<?php  
#Removed because we're going to user the FB
#echo $this->Html->charset(); ?>

<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>

<script>
	var __loadedJavascript = new Array();
</script>	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>

<?php
echo $this->Html->meta('icon');



echo $this->Html->css(array(
		'style',
		'scrollbar',
		'colorbox',
		'calendar',
		'jquery-ui-1.8.20.custom',
		'uploadifive',
		'bootstrap.scaffolding',
		'uploadify'
));

/**
*
*/
if(isset($objController) && is_object($objController)){
	$objController->loadAditionalJs('//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js',1);
	$objController->loadAditionalJs('function');
	$objController->loadAditionalJs('ddaccordion');
	$objController->loadAditionalJs('dw_scroll_c');
	$objController->loadAditionalJs('jquery.colorbox');
	$objController->loadAditionalJs('loopedslider');
	$objController->loadAditionalJs('jquery.uploadifive');
	$objController->loadAditionalJs('jquery.uploadify');
	$objController->loadAditionalJs('bootstrap.tooltip');
	$objController->loadAditionalJs('bootstrap.popovers');
	
	
	$objController->loadAditionalJs('bootstrap.javascript.modal');
	
	$objController->loadAditionalCss('bootstrap.js_components.tooltips');
	$objController->loadAditionalCss('bootstrap.javascript.modal');
	$objController->loadAditionalCss('bootstrap.miscellaneous.close_icon');
	$objController->loadAditionalCss('bootstrap.basecss.labelsandbadges');
	$objController->loadAditionalCss('popovers_notifications');
	$objController->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
	$objController->loadAditionalCss('bootstrap.basecss.buttons');
	
	$aditionalCss = $objController->listAditionalCss();
	
	if(is_array($aditionalCss) && count($aditionalCss) > 0){
		echo $this->Html->css($aditionalCss);
	}
	
	$aditionalJs = $objController->listAditionalJs();
	
	$__loadedJavascript = '';
	if(is_array($aditionalJs) && count($aditionalJs) > 0){
		foreach($aditionalJs as $key => $value){
			foreach($value as $k => $v){
				if (is_array($v)) {
					foreach ($v as $k1 => $v1) {
						$__loadedJavascript .= '__loadedJavascript["'.$v1.'"] = "1";';
					}
				} else {
					$__loadedJavascript .= '__loadedJavascript["'.$v.'"] = "1";';
				}
				echo $this->Html->script($v);
			}
		}
	}
	echo '
		<script>
			'.$__loadedJavascript.'
		</script>';
}

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('functions');


?>

<script type="text/javascript" charset="utf-8">
		
		$(function(){
			$('#loopedSlider').loopedSlider({
				autoStart: 6000,
				restart: 2000
				
			});
			$('#newsSlider').loopedSlider({
				autoHeight: 400
			});
		});

		var boolExecNotificationAjax = 1;
		function toggleNotificationAlert(){
			//alert($('#btnGroupNotification > .popover').html());
			if($('#btnGroupNotification > .popover-notifications').css('display') == 'none'){
				boolExecNotificationAjax = 0;
				$('#btnGroupNotification > .popover-notifications').css('display','block');
				$('body').append('<div id="divNotificationBackground" style="bottom: 0;left: 0;position: fixed;right: 0;top: 0;z-index: 1000;" onclick="javascript:toggleNotificationAlert();"></div>');

				$.ajax({
		  			  url: "<?php echo $this->Html->url(array('controller' => 'notifications' ,'action' => 'markAsViewed')); ?>",
		  			  dataType: 'json',
		  			  type: "GET",
		  			  success: function(ajaxReturn,textStatus,xhr){
		 			  }	  
		  		});
				
				
			}else{
				boolExecNotificationAjax = 1;
				updateNotifications();
				$('#btnGroupNotification > .popover-notifications').css('display','none');
				$('#divNotificationBackground').detach();
			}	
		}	
		<?php
			if (isset($logged_in) && $logged_in) {
		?>
		function updateNotifications(){
			if(boolExecNotificationAjax == 1){
				$.ajax({
		  			  url: "<?php echo $this->Html->url(array('controller' => 'notifications' ,'action' => 'status')); ?>.json",
		  			  dataType: 'json',
		  			  type: "POST",
		  			  success: function(ajaxReturn,textStatus,xhr){
			  			  	if(ajaxReturn.notification){
			  					if(ajaxReturn.notification.countNew > 0){
			  						$('.aNotifications').addClass('btn-danger');
			  						$('.aNotifications').removeClass('btn-primary');
			  						$('.aNotifications .txtNotification').html(" "+ajaxReturn.notification.countNew+' new notification(s)'); 
			  					}else{
			  						$('.aNotifications').removeClass('btn-danger');
			  						$('.aNotifications').addClass('btn-primary');
			  						$('.aNotifications .txtNotification').html(" Notifications");
			  					}
			  					$("#btnGroupNotification .popover-notifications-content").html(ajaxReturn.notification.html);
			  			  	}
			  			  	timer = setTimeout("updateNotifications()", 5000);
		 			  },
					  beforeSend: function(j, s){
					  }	  
		  		});
			}
			
		}	
		<?php
			}
		?>
		$(document).ready(function() {
			if($("#flashMessage").html()){
				$('body').append('<div id="flashModal" class="modal" style="display:none;"><div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button><b>Living Alpha Message</b></div><div class="modal-body"></div></div>');
				$("#flashMessage").hide();
				$('#flashModal').find('.modal-body').html($("#flashMessage").html());
				$("#flashMessage").detach();
				$('.modal-backdrop, .modal-backdrop.fade.in').css('opacity', 0.6);
				$('#flashModal').modal({show:true});
			}

			<?php
				if (isset($logged_in) && $logged_in) {
			?>
					updateNotifications();
			<?php 
				}
			?>
				
		});

</script>
</head>
<body class="body">
	<div id="mainCntr">
		<!-- Start header container -->
		<div id="headerCntr">

			<div class="row-fluid">
				<div class="span3" style="margin-top:9px;">
					<?php echo $this->Html->image('livingAlpha_logo.png', array(
						'alt' => 'Living Alpha Logo',
						'url' => '/'))  
					?>
				</div>
				<div class="span9"  style="margin-top:10px;">
					<div class="row-fluid toptab">
						
						<?php
						if (isset($logged_in) && $logged_in) {
							//onclick="logout();"
							echo '<span class="welcomeUser">Welcome,</span> ' . $this->Html->link($userFullName, array('controller'=>'users', 'action'=>'index'))."<span>|</span>". $this->Html->link('Sign Out', array('controller'=>'users', 'action'=>'logout'))."<span>|</span>". $this->Html->link('Change password', array('controller'=>'users', 'action'=>'change_password'));
							 
						?>  
					<!-- this is the search engine -->
						<div class="searchbox">
						<?php echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'index', 'div'=>false))); ?>
						<?php echo $this->Form->input('word', array('type'=>'text','label'=>false, 'value' => 'Search Journals', 'onblur' => 'replaceText(this)', 'onfocus' => 'clearText(this)', 'div'=>false, 'class' => 'srchInpt' )); ?>
						<?php echo $this->Form->submit('Search',array('type' => 'image','src'=> $this->webroot.'img/search_btn.gif','div' => false)); ?>
						<?php echo $this->Form->end(); ?>
						</div>
						<?php 
													
						} else {
							if (!$this->Session->read('sharedemail')) {
						?>
						<div style="float:right;color:white;font-size:16px;font-weight:bold;width:333px;font-style:italic;text-align:justify;">
							<?php echo $this->Html->link('Join Us Now','/users/add'); ?> 
							and start creating your own Autobiography one Journal Entry at a time!
							<br>
							<span style="font-size: 12px; float: left; text-align: left; padding: 0px; margin-top: 8px;">
								"A Life Worth Living... is... A Life Worth Journaling."
							</span>

						</div>

						<?php
							}
							echo $this->Html->link('Sign In', array('controller'=>'users', 'action'=>'login')); 
							echo "<span>|</span>New User? ".$this->Html->link('Join Now!','/users/add'); 
						}
		
						?>

					<span>|</span>
						<?php  
							echo $this->Html->link('Contact', array('controller'=>'messages','action'=>'index'));
						?>

				</div>
					<?php
						if (isset($logged_in) && $logged_in) {
					?>
					<div class="row-fluid">
					
						<div class="btn-group" id="btnGroupNotification" >
						    <a class="btn btn-mini btn-primary dropdown-toggle aNotifications" href="javascript:;" onclick="javascript:toggleNotificationAlert();" style="color:#FFF;"><span class="caret" style="padding:0px;"></span><span class="txtNotification"> Notifications</span></a>
							
							<div class="popover-notifications bottom" style="top:26px;">
					            <div class="arrow" style="margin-left:-196px;"></div>
					            
					            <div class="popover-notifications-content" >
					            	<?php echo $this->Html->image('loading.gif');?>
					            </div>
					        </div>
						    <!-- <ul class="dropdown-menu">
						    	<li><div class="span2"><img alt="" src="/img/journal_cover.png" width=50></div><div class="span4"><a href="/journals/view/37">View details View details View details View details View details View details </a></div></li>
						    	<li><a href="/journals/view/37">View details View details View</a></li>
						    </ul>  -->
					    </div>
					    
						<div class="header-menu">
						<ul>					
						<!--	<li><?php echo $this->Html->link('Alpha Shop', '#', array('class'=>'inactiveelement'));?></li>
							<li><?php echo $this->Html->link('Events', '#', array('class'=>'inactiveelement'));?></li>
							
							<li><?php echo $this->Html->link('Dream Lists', '#', array('class'=>'inactiveelement'));?></li> 
		-->
							<li><?php echo $this->Html->link('Global Alpha Journals', '/journals/alphajournals');?></li>
						<!--	<li><?php echo $this->Html->link('Alpha World', '#', array('class'=>'inactiveelement'));?></li> -->
							<li class="fst"><?php echo $this->Html->link('Home', '/');?></li>
							
						</ul>
						</div>
					</div>
					<?php
						} else {
							if ($this->Session->read('sharedemail')) {
					?>
						<!-- Start menu Box -->
						<div class="menuBox">
							<ul>					
								<li><?php echo $this->Html->link('Shared Journals', '/journals/sharedjournals/');?></li>
								<li class="fst"><?php echo $this->Html->link('Home', array('controller' => 'index', 'action' => 'index'));?></li>
							</ul>			
						</div>
						<!-- End menu Box -->																									
					<?php 
							}
						}
					?>
				</div>
					
			</div>
		</div>

		<?php  
			if ($this->Session->check('Message') != NULL) { 
				echo $this->Session->flash();
			}
		?>

		<?php 
			echo $this->fetch('content'); 
		?>

		<div id="footerCntr">
			<!-- Start footer Box -->
			<div class="footerBox">
				<div class="navigation">
					<div class="hd">Navigation</div>
					<ul>
						<li><?php echo $this->Html->link('Home', '/');?></li>
						<li><?php echo $this->Html->link('Contact', array('controller'=>'messages', 'action'=>'index')); ?>
						</li>
					</ul>
					<div class="clr"></div>
				</div>
				<div class="aboutUs">
					<div class="hd">About Us</div>
					<p>
					LivingAlpha has a commitment to excellence, where we provide the best products and services on behalf of a noble mission: to make the world a better place. In so doing, we empower people to develop their full "Inner-Alpha" potential -- which is the first step towards realizing the highest possible goals. Dream It... Live It... Preserve It!!! These three principles, which are the unifying themes of LivingAlpha, enable people to connect with one another, share experiences and alleviate the fear of the unknown. This sense of independence and self-confidence is the ideal way to bring people together around the globe. 
					</p>
					<p>
					By combining micro-journal entries or autobiographical copy tidbits, LivingAlpha is the centerpiece of a worldwide community of people "Living with an Adventurous, Loving, Positive, Healthy Attitude". Indeed, the very concept of LivingAlpha is the result of a core set of beliefs: that people are, by their nature, generous; that they will help others, if given the opportunity to do so; and that, when inspired and properly motivated, they can achieve great success. Thus, LivingAlpha creates relationships that transcend borders - we maximize the power of the web for the good of humankind - so people can support and encourage each other.
					</p>
					<p>
					At LivingAlpha, we believe that "Dreams you Set are Dreams you Get" -- and "A Life Worth Living is A Life Worth Journaling". So, go ahead and learn more about other people, activities, destinations - and perhaps even yourself?  You can also post comments, and even ask people for their advice about the issues that matter most to you. Then, set a date and know that the next adventure you journal and preserve at LivingAlpha may inspire others to live it as well.
					</p>

				</div>

				<div class="clr"></div>
			</div>
			<!-- End footer Box -->
		</div>
		<div class="copyright">
			<div class="copyrightBox">

				<div class="footertext">
					&copy; 2010 Living Alpha. All right reserved.
					<?php echo $this->Html->link('Privacy Policy', array('controller'=>'index', 'action'=>'privacy')); ?>
					&nbsp; | &nbsp;

					<?php echo $this->Html->link('Terms & Conditions', array('controller'=>'index', 'action'=>'terms')); ?>
					<span id="patentstext">Patents Pending</span>
				</div>

				<div class="clr"></div>
			</div>
		</div>
	</div>
	<!-- End main container -->

	<!-- scripts_for_layout -->
	<?php 
		echo $this->fetch('script'); 
	?>

	<?php 
		echo $this->element('sql_dump'); 
	?>

	<?php
		if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) 
			echo $this->Js->writeBuffer(); 
	?>
<?php echo $this->element('google-analytics'); ?>
</body>
<?php echo $this->Facebook->init(); ?>
</html>
