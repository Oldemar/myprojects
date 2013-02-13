<?php 
$objController->loadAditionalCss('users');
$objController->loadAditionalCss('bootstrap.components.dropdowns');
$objController->loadAditionalJs('bootstrap.components.dropdowns');

if(isset($arrayObjFriend) && count($arrayObjFriend) > 0 ){
	
	
	foreach ($arrayObjFriend as $key => $objFriend) {
		
		?>
		<div class="row advantureBarNew bmargin">
			<style>
				[class*="span"] {
			
					margin-left: 8px;
				}
				.span1 {
					width: 40px;
				}
			</style>
			<div class="span1"  >
				<?php
			
				echo $this -> Html -> link($this -> CachedElement -> userProfileImage($objFriend -> getAttr('id'), 'w90', array('width' => 60)), array('controller' => 'users', 'action' => 'profile', $objFriend -> getAttr('id')), array('escape' => false));
			?>
			</div>
			<div class="span3">
				<?php  echo $this -> Html -> link($objFriend -> getAttr('username'), array('controller' => 'users', 'action' => 'profile', $objFriend -> getAttr('id')), array('escape' => false)); ?>
				<br>
				<?php echo $objFriend -> getEmail(1); ?>
				<br>
				<?php echo $objFriend -> getFullname(1); ?>
				<br>
				<?php echo $objFriend -> Contact -> ResCity -> getNameToExhibitWithCountryCode(); ?>
			
			</div>
			<style>
				.boxFacet {
					background-color: #FFFFFF;
					border: 1px solid #B6C8DC;
					position: relative;
					width: 210px;
				}
				.txt11 {
					font-size: 11px;
				}
				.unico, .mutiplo {
					height: 100px;
					overflow-x: hidden;
					overflow-y: auto;
				}
				.selectMultiplo, .selectUnico, .selectMultiple {
					height: 55px;
					list-style: none outside none;
					margin: 0;
					padding: 0;
					position: relative;
					width: 100%;
				}
				#area_id li {
					padding-left: 10px;
				}
				.selectUnico li, .selectMultiplo li, .selectMultiple li {
					display: block;
					margin: 0;
					padding: 0;
					position: relative;
					width: 100%;
				}
				.selected, .selectUnico li.selected a:hover, .selectMultiplo li.selected a:hover, .selectMultiple li.selected a:hover, .selectUnico li.selected a, .selectMultiplo li.selected a, .selectMultiple li.selected a {
					background-color: #3888D7;
					color: #FFFFFF;
				}
				.selectMultiplo li input, .selectMultiple li input {
					left: 3px;
					margin: 0;
					padding: 0;
					position: absolute;
					top: 3px;
					z-index: 2;
				}
				
				.sLabel{
					margin-left: 10px;
				}
			
			</style>
			
			<div class="span2">
				
				
				<?php 
						
				if($objFriend->isFriend($objUser->getAttr('id'))){
					
					if(count($objUser->listGroupsByUser()) > 0 ){ 
				
				?>				
			<div class="row-fluid"><h4>Groups</h4></div>
				<div class="row-fluid">
					

					<div id="facet_area_id" class="boxFacet txt11">
						<ul id="area_id" class="selectMultiplo  mutiplo" showcheckbox="true" unique="false" maxlength="100000">
							<?php
							//GroupId is set because it's finding for specific group to add or remove
							if(isset($objGroup)){
										
									if($objGroup->isInGroup($objFriend -> getAttr('id'))){
				
										echo '<li class="groupli selected" groupId="'. $objGroup -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('class'=>'selected', 'label' => false, 'checked' => $objGroup->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroup -> getAttr('name') . '</span></li>';
									}
									else{
											
										echo '<li class="groupli" groupId="'. $objGroup -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('label' => false, 'checked' => $objGroup->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroup -> getAttr('name') . '</span></li>';
										
									}								
							}
							else{
								
	
								
									foreach ($objUser->listGroupsByUser() as $key => $objGroupUser) {
					
										if($objGroupUser->isInGroup($objFriend -> getAttr('id'))){
					
											echo '<li class="groupli selected" groupId="'. $objGroupUser -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('class'=>'selected', 'label' => false, 'checked' => $objGroupUser->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroupUser -> getAttr('name') . '</span></li>';
										}
										else{
												
											echo '<li class="groupli" groupId="'. $objGroupUser -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('label' => false, 'checked' => $objGroupUser->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroupUser -> getAttr('name') . '</span></li>';
											
										}
					
									}		
												
							}

							?>
						</ul>
					</div>
				</div>
					<?php 
						}
						else{
							
							echo $this->Html->link('Add a group', array('controller'=>'groups','action'=>'index'));
						}
					
					}
					else{
			
						//echo $this->Html->link('Add as a Friend.', array('controller'=>'users','action'=>'addFriend',$objFriend -> getAttr('id')));
						echo '<a class="addfriend" href="#" friendId="'.$objFriend -> getAttr('id').'">Add as a Friend.</a>';
					}
					?>
				
			</div>


		</div>
		<?php
	}
}
?>
<script>
	$(document).ready(function() {
		
		
		$('.addfriend').click(function(){
			
			var elem = $( this );
			
				myParam = {
							friendId:$(this).attr('friendId'),
						}		
						
				$.ajax({
					async : true,
					data : myParam,
					dataType: 'json',
					success : function(ajaxReturn, textStatus) {
						
						if(ajaxReturn.boolError){
							
							alert('There is problem with add Friend. Call to the administrator.');
							
								
						}
						else{
							
							elem.text ('The invitation has been sent.')
						}
						
					},
					type : "POST",
					url : "<?php echo $this->Form->url('/users/addFriendAjax/')?>",
			        error: function(xhr,textStatus,error){
			                alert('The server can not be reached in this moment. Please, try later.');
			        },
			        beforeSend: function(){

						elem.html('<?php echo $this->Html->image('loading.gif');?>');
	    			}
				});
		});
		
		
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