<?php
$objController->loadAditionalCss('popover_comments');

if(!isset($this->Html->request) && isset($objRequest) && is_object($objRequest)){
	$this->Html->request = $objRequest;
}	

?>
<div style="padding:0px;" class="commentDetail" videoId="<?php echo $objVideo->getID();?>">
	<div class="line lineForm" style="padding:6px;">
		<div style="float:left;padding: 4px 0 0;">
			<?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?>
		</div>
		<form id="formCommentPhoto">
			<input type="hidden" name='video_id' value="<?php echo $objVideo->getID();?>">
			<div class="photoMidtxt" style="float:right">
				<div class="popover right" style="width:320px; float:right">
					<div class="arrow"></div>
					<div class="popover-content">
					  <p>
					  	<input type="text" id="VideocommentComment" placeholder="AlphaBit - Write a Bit and press enter" class="messagearia" name="comment" style="width:265px">
					  </p>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</form>
	</div>
	
<?php
	
	$objVideo->buildBelong('Journal');
	$objVideo->loadComments();
	
	if(isset($objVideo->Videocomment) && is_array($objVideo->Videocomment)){
		foreach($objVideo->Videocomment as $key => $value){
			$value->buildBelong('User');
			$value->User->buildBelong('Picture');
?>
<div class="line" id="line<?php echo $value->getID(); ?>" style="padding:6px;">
	<div style="float:left;padding: 4px 0 0;">
		<?php 
			echo $this->CachedElement->userProfileImage($value->User->getID(),'w40',array('width' => '40'));
		?>
	</div>
	
	<div class="photomMidtxt">
		<div class="popover right" style="width:320px; float:right">
			<div class="arrow"></div>
			<h3 class="popover-title">
				<?php echo $this->Html->link($value->User->getAttr('username'), array('controller'=>'users','action'=>'profile',$value->User->getID())); ?>, <?php echo $value->getDateCreatedToExhibit('created'); ?>
				<?php
					if ($value->User->getID() == $objLoggedUser->getID() || $objVideo->Journal->getAttr('user_id') == $objLoggedUser->getID()){
						echo "<span style='float:right;'><a href='javascript:;' name='aDeleteVideo' videoCommentId='".$value->getID()."'>".$this->Html->image('delete.png', array('width'=>'10'))."</a></span>";
					} 
				?>
			</h3>
			<div class="popover-content">
			  <p><?php echo $value->getAttr('comment') ; ?></p>
			</div>
		</div>
	</div>	
	
	<div class="clr"></div>
</div>						

<?php
		}
	}
?>
<script>


	$('#VideocommentComment').keypress(function (e) {
	  if (e.which == 13) {
	  		
		  	$.ajax({
    			  url: "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'postVideoCommentAjax')) ?>",
    			  data: $('#formCommentVideo').serialize(),
    			  dataType: 'json',
    			  type: "POST",
    			  success: function(ajaxReturn,textStatus,xhr){
		 			if(!ajaxReturn.boolError){
		 				$('.commentDetail').replaceWith(ajaxReturn.comments_html);
		 				$('#VideocommentComment').focus();
					}
					if(ajaxReturn.alertMessage){
						alert(ajaxReturn.alertMessage);
					}		
   			  },
			  beforeSend: function(j, s){
			  		$('.lineForm').after('<div class="line" style="padding:6px;"><div style="float:left;padding: 4px 0 0;"><?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?></div><div class="photomidtxt"><div class="popover right" style="width:320px; float:right"><div class="arrow"></div><h3 class="popover-title"><?php echo $objLoggedUser->getAttr('username') ?>, 0 seconds ago</h3><div class="popover-content"><p>'+$('#VideocommentComment').val()+'</p></div></div></div><div class="clr"></div></div>');
			  		$('#VideocommentComment').val("");	
			  }	  
			});
			
	    	e.preventDefault();
	  }
	});
		
</script>
<script>
	$('a[name|="aDeleteVideo"]').click(function(){
		
		var videoCommentId = $(this).attr('videoCommentId');
		
		$('#line'+videoCommentId).hide();
		
		$.getJSON("<?php echo $this->Html->url(array('controller'=>'comments','action'=>'deleteVideoCommentAjax')); ?>/"+videoCommentId,
	        function(data){
		        if(data.boolSuccess){
					$('#line'+videoCommentId).detach();
		        }else{
		        	$('#line'+videoCommentId).show();
		        }    
	        }
        );
		
	});
</script>	
</div>