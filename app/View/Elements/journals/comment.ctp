<?php
	/**
	 * Expected params
	 * @param: $journalId
	 * @param: $sharingLevel
	 * @param: $objLoggedUser
	 */

	if(!isset($journalId) || !$journalId){
		$this->log('Didn\'t find $journalId on elements/journals/comment ','error');
	}
	if(!isset($sharingLevel) || !$sharingLevel){
		$this->log('Didn\'t find $sharingLevel on elements/journals/comment ','error');
	}
		

	$objController->loadAditionalCss('popover_comments');

	/*
	 * This is to fix cakephp 2.1 bug with helpers
	 */
	if(!isset($this->Html->request) && isset($objRequest) && is_object($objRequest)){
		$this->Html->request = $objRequest;
	}
	
	if(!isset($this->Journal) || !is_object($this->Journal) || !$this->Journal->getID()){
		$this->Journal = ClassRegistry::init('Journal');
		$this->Journal = $this->Journal->findById($journalId,array(),0);
	}	
	
	$arrObjComment = $this->Journal->listCommentsBySharingLevel($sharingLevel);
?>

<div style="width:500px;padding:0px;" class="commentDetail">
	<?php
		if(isset($objLoggedUser) && is_object($objLoggedUser)){
	?>
	<div class="line">
		<form id="formCommentJournal">
			<input type="hidden" name='journalId' value="<?php echo $this->Journal->getID();?>">
			<input type="hidden" name='sharingLevel' value="<?php echo $sharingLevel;?>">
			<div style="float:left;padding: 4px 0 0;">
				<?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?>
			</div>
			<div class="journalMidtxt">
				<div class="popover right">
					<div class="arrow"></div>
					<div class="popover-content">
					  <input type="text" id="JournalCommentInput<?php echo $sharingLevel;?>" placeholder="AlphaBit - Write a Bit and press enter" class="messagearia" name="comment" style="width:360px">
					</div>
				</div>
			</div>
			<div class="clr"></div>
		</form>
	</div>
	<?php } ?>
<?php foreach($arrObjComment as $key => $value){?>	
<div class="line" id="line<?php echo $value->getID(); ?>">
	<div style="float:left;padding: 4px 0 0;">
		<?php 
			echo $this->CachedElement->userProfileImage($value->User->getID(),'w40',array('width' => '40'));
		?>
	</div>
	
	<div class="journalMidtxt">
		<div class="popover right">
			<div class="arrow"></div>
			<h3 class="popover-title">
				<?php echo $this->Html->link($value->User->getAttr('username'), array('controller'=>'users','action'=>'profile',$value->User->getID())); ?>, <?php echo $value->getDateCreatedToExhibit('created'); ?>
				<?php
					try{
						if(isset($objLoggedUser) && is_object($objLoggedUser)){
							if($value->checkLoggedUserCanDeleteComment($objLoggedUser)){
								echo "<span style='float:right;'><a href='javascript:;' name='aDeleteComment".$sharingLevel."' commentId='".$value->getID()."'>".$this->Html->image('delete.png', array('width'=>'10'))."</a></span>";
							}
						}
					}catch(Exception $e){
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
<?php } ?>

</div>
<?php if(isset($objLoggedUser) && is_object($objLoggedUser)){?>
<script>
$('#JournalCommentInput<?php echo $sharingLevel;?>').keypress(function (e) {
	  if (e.which == 13) {
	  		var thisInput = $(this);
		  	$.ajax({
    			  url: "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'postJournalCommentAjax')) ?>",
    			  data: thisInput.parents('form').eq(0).serialize(),
    			  dataType: 'json',
    			  type: "POST",
    			  success: function(ajaxReturn,textStatus,xhr){
		 			if(!ajaxReturn.boolError){
		 				thisInput.parents('.commentDetail').eq(0).replaceWith(ajaxReturn.comments_html);
					}
					if(ajaxReturn.alertMessage){
						alert(ajaxReturn.alertMessage);
					}		
					thisInput.focus();
   			  },
			  beforeSend: function(j, s){
				  	thisInput.parents('.line').eq(0).after('<div class="line"><div style="float:left;padding: 4px 0 0;"><?php echo $this->CachedElement->userProfileImage($objLoggedUser->getID(),'w40',array('width' => '40')); ?></div><div class="journalMidtxt"><div class="popover right"><div class="arrow"></div><h3 class="popover-title"><?php echo $objLoggedUser->getAttr('username') ?>, 0 seconds ago</h3><div class="popover-content"><p>'+thisInput.val()+'</p></div></div></div><div class="clr"></div></div>');
			  		thisInput.val("");	
			  }	  
			});
			
	    	e.preventDefault();
	  }
});
		
</script>
<script>
$('a[name|="aDeleteComment<?php echo $sharingLevel;?>"]').click(function(){
		
		var commentId = $(this).attr('commentId');
		
		$('#line'+commentId).hide();
		
		$.getJSON("<?php echo $this->Html->url(array('controller'=>'comments','action'=>'deleteJournalCommentAjax')); ?>/"+commentId,
	        function(data){
		        if(data.boolSuccess){
					$('#line'+commentId).detach();
		        }else{
		        	$('#line'+commentId).show();
		        }    
	        }
        );
		
});
</script>
<?php } ?>