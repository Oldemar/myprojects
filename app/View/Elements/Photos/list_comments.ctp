<?php
$objController->loadAditionalCss('popover_comments');

if(!isset($this->Html->request) && isset($objRequest) && is_object($objRequest)){
	$this->Html->request = $objRequest;
}	

?>
<div style="padding:0px;" class="commentDetail" photoId="<?php echo $objPhoto->getID();?>">
	<div class="line lineForm" style="padding:6px;">
		<div style="float:left;padding: 4px 0 0;">
			<?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?>
		</div>
		<form id="formCommentPhoto">
			<input type="hidden" name='photo_id' value="<?php echo $objPhoto->getID();?>">
			<div class="photoMidtxt">
				<div class="popover right" style="width:310px">
					<div class="arrow"></div>
					<div class="popover-content">
					  <p>
					  	<input type="text" id="PhotocommentComment" placeholder="AlphaBit - Write a Bit and press enter" class="messagearia" name="comment" style="width:265px">
					  </p>
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</form>
	</div>
	
<?php
	
	$objPhoto->buildBelong('Journal');
	$objPhoto->loadComments();
	
	if(isset($objPhoto->Photocomment) && is_array($objPhoto->Photocomment)){
		foreach($objPhoto->Photocomment as $key => $value){
			$value->buildBelong('User');
			$value->User->buildBelong('Picture');
?>
<div class="line" id="line<?php echo $value->getID(); ?>" style="padding:6px;">
	<div style="float:left;padding: 4px 0 0;">
		<?php 
			echo $this->CachedElement->userProfileImage($value->User->getID(),'w40',array('width' => '40'));
		?>
	</div>
	
	<div class="photoMidtxt">
		<div class="popover right" style="width:310px">
			<div class="arrow"></div>
			<h3 class="popover-title">
				<?php echo $this->Html->link($value->User->getAttr('username'), array('controller'=>'users','action'=>'profile',$value->User->getID())); ?>, <?php echo $value->getDateCreatedToExhibit('created'); ?>
				<?php
					if ($value->User->getID() == $objLoggedUser->getID() || $objPhoto->Journal->getAttr('user_id') == $objLoggedUser->getID()){
						echo "<span style='float:right;'><a href='javascript:;' name='aDeletePhoto' photoCommentId='".$value->getID()."'>".$this->Html->image('delete.png', array('width'=>'10'))."</a></span>";
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


	$('#PhotocommentComment').keypress(function (e) {
	  if (e.which == 13) {
	  		
		  	$.ajax({
    			  url: "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'postCommentAjax')) ?>",
    			  data: $('#formCommentPhoto').serialize(),
    			  dataType: 'json',
    			  type: "POST",
    			  success: function(ajaxReturn,textStatus,xhr){
		 			if(!ajaxReturn.boolError){
		 				$('#divCommentsPhoto > .commentDetail').replaceWith(ajaxReturn.comments_html);
		 				$('#PhotocommentComment').focus();
					}
					if(ajaxReturn.alertMessage){
						alert(ajaxReturn.alertMessage);
					}		
   			  },
			  beforeSend: function(j, s){
			  		$('.lineForm').after('<div class="line" style="padding:6px;"><div style="float:left;padding: 4px 0 0;"><?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?></div><div class="photoMidtxt"><div class="popover right" style="width:310px"><div class="arrow"></div><h3 class="popover-title"><?php echo $objLoggedUser->getAttr('username') ?>, 0 seconds ago</h3><div class="popover-content"><p>'+$('#PhotocommentComment').val()+'</p></div></div></div><div class="clr"></div></div>');
			  		$('#PhotocommentComment').val("");	
			  }	  
			});
			
	    	e.preventDefault();
	  }
	});
		
</script>
<script>
	$('a[name|="aDeletePhoto"]').click(function(){
		
		var photoCommentId = $(this).attr('photoCommentId');
		
		$('#line'+photoCommentId).hide();
		
		$.getJSON("<?php echo $this->Html->url(array('controller'=>'comments','action'=>'deleteCommentAjax')); ?>/"+photoCommentId,
	        function(data){
		        if(data.boolSuccess){
					$('#line'+photoCommentId).detach();
		        }else{
		        	$('#line'+photoCommentId).show();
		        }    
	        }
        );
		
	});
</script>	
</div>