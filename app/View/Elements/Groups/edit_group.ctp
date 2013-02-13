<div id="divErrors" class="alert alert-error" style="display:none;"></div>
<div id="groupNameBody" class="row-fluid employmentrow smallMarginRow">
<div class="span4">
	<div class="input text required"><label for="UserEmailaddress0">Group Name</label><input type="text" id="groupName2edit" class="bodymessage" name="groupName" value="<?php echo $objGroup->getAttr('name'); ?>"></div></div>
</div>
<script>
	$(document).ready(function(){
		
		$('#saveGroupName').one('click',function(){

			if(validateName($('#groupName2edit').val())){ 
				
				myParam = {	groupId: '<?php echo $objGroup->getAttr('id'); ?>', groupName: $('#groupName2edit').val(), }
				
			    $.ajax({
		        type: 'POST',
		        dataType: 'json',
		        url: "<?php echo $this->Form->url('/Groups/editGroupName')?>",
		        data: myParam,
		        success: function(ajaxReturn,textStatus,xhr){
		        	
		        	$('.bottomButton').show();
		        	
		 			if(ajaxReturn.boolError){
		 				
						$('#modaleditGroup .modal-body').html(ajaxReturn.content);
						
						$('#modaleditGroup #divErrors').html(ajaxReturn.strErrors);
						
						$('#modaleditGroup #divErrors').show();
						
							
					}else{
						
						$('#modaleditGroup .modal-body').html(ajaxReturn.content);
						
						$('.modal').modal('hide');
						
						reloadGroupResult();
					}		
		       	
		        },
		        error: function(xhr,textStatus,error){
		
		                alert('The server can not be reached in this moment. Please, try later.');
		                $('#myModal').modal('hide')
		        },
		        beforeSend: function(){
		
						$('.bottomButton').hide();
						$('#modaleditGroup .modal-body').html('<?php echo $this->Html->image('loading.gif');?>');
						
			    }
		    	}); 
		    	
	    	}
	    	else{
	    		
	    		alert('You must specify a Group name.');
	    	}
		
			
		});
		
		function validateName(name){
			
			return (name != '');
		}
	
		
	})</script>	