<?php 
$objController->loadAditionalCss('users');
$objController->loadAditionalCss('bootstrap.components.dropdowns');
$objController->loadAditionalJs('bootstrap.components.dropdowns');

if(isset($arrayObjFriend) && count($arrayObjFriend) > 0 ){
	
	foreach ($arrayObjFriend as $key => $objFriend) {
		
		//debug($objFriend->City);
		
		?>
		<div class="row advantureBarNew bmargin">
		<?php
		echo $this->element('Users/friend_row', array('objFriend'=>$objFriend));
		?>
		</div>
		<?php
	}
}
?>
<script>
	$(document).ready(function() {
		$('.groupli input, .groupli span').click(function() {
			if ($(this).parents('.groupli').eq(0).hasClass('selected')) {
				$(this).parents('.groupli').eq(0).removeClass('selected');
				$(this).parents('.groupli').eq(0).find('input').removeAttr('checked');

				elementLi = $(this).parents('.groupli').eq(0);
				myParam = {
							userId:elementLi.attr('userId'),
							groupId:elementLi.attr('groupId'),
						}
				
				$.ajax({
					async : true,
					data : myParam,
					dataType: 'json',
					success : function(ajaxReturn, textStatus) {
						
						if(ajaxReturn.boolError){
							
							alert('There is problem with the group. Call to the administrator.');
							
								
						}
						
					},
					type : "POST",
					url : "<?php echo $this->Form->url('/groups/removeFriendToGroup/')?>",
			        error: function(xhr,textStatus,error){
			                alert('The server can not be reached in this moment. Please, try later.');
			        },
					
				});
								
				
				

			} else {
				$(this).parents('.groupli').eq(0).addClass('selected');
				$(this).parents('.groupli').eq(0).find('input').attr('checked', 'checked');
				
				elementLi = $(this).parents('.groupli').eq(0);
				myParam = {
							userId:elementLi.attr('userId'),
							groupId:elementLi.attr('groupId'),
						}
				
				$.ajax({
					async : true,
					data : myParam,
					dataType: 'json',
					success : function(ajaxReturn, textStatus) {
						
						if(ajaxReturn.boolError){
							
							alert('There is problem with the group. Call to the administrator.');
							
								
						}
						
					},
					type : "POST",
					url : "<?php echo $this->Form->url('/groups/addFriendToGroup/')?>",
			        error: function(xhr,textStatus,error){
			                alert('The server can not be reached in this moment. Please, try later.');
			        },
					
				});
								
				
			}
		});
	}); 
</script>