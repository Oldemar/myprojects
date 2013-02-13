<?php 

if(is_null($objGroup->getAttr('id'))){
	
?>
<div>
	We did not find the <span id="gname" style="font-weight: bold;"><?php echo $objGroup->getAttr('name'); ?></span> group in your data. Do you want to add it?
	<div style="width: 25px" id="addGroup" class="buttons">
		Yes
	</div>
</div>
<script>
	
$(document).ready(function() {
	
	$('#addGroup').click(function(){
		
		addGroup();
	});
	
	function addGroup( )
	{
		
		myParam = {	groupName: '<?php echo $objGroup->getAttr('name'); ?>',  }
	   $.ajax({
		   	async:true, 
		   	data:myParam, 
		   	dataType: 'json',
		   	success:function (ajaxReturn, textStatus) {
		   		

			   $.ajax({
				   	async:true, 
				   	data:myParam, 
				   	dataType: 'json',
				   	success:function (ajaxReturn, textStatus) {
				   		
				   		
						$("#resultGroupSearch").html(ajaxReturn.content);
				   	}, 
				   	error: function(xhr,textStatus,error){
		                alert('The server can not be reached in this moment. Please, try later.');
		        	},
		        	beforeSend: function(){
		        		
			      	  $('#employment_list').html('<?php echo $this->Html->image('loading.gif');?>'); 	
				    },
				   	type:"post", 
				   	url:"<?php echo $this->Form->url('/groups/listMembers/')?>"
			   	});


		   	}, 
		   	error: function(xhr,textStatus,error){
		   		
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      		$('#employment_list').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/groups/addGroup/')?>"
	   	});
	}	
});	
</script>
<?php
}
else{

	echo $this->element('Groups/search_group', array('objGroup'=>$objGroup));
	
}
?>		