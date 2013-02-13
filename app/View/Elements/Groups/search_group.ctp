<style>
#groupName {
    font-size: 20px;
    padding-bottom: 20px;
    padding-left: 1px;
    padding-top: 20px;
}	
	
</style>
<div id="groupName"><h3>Group Name: <span id="sgroupName"><?php echo $objGroup->getAttr('name'); ?></span>&nbsp;&nbsp;&nbsp;<a data-original-title="Edit Group" data-placement="top" href="#" id="editGroup" class="ctooltip"><i class="icon-pencil"></i></a>&nbsp;<?php echo $this->Form->postLink('<i class="icon-trash ctooltip" data-original-title="Delete Group" data-placement="top"></i>', 
													array('controller'=>'groups', 'action'=>'delete',$objGroup->getAttr('id')),
													array('escape'=> false),
													__('Are you sure you want to delete '.$objGroup->getAttr('name').' ?')); 
?></h3></div>

<div id="grpoptedt" >


<?php 
$button1 = '<button aria-hidden="true" data-dismiss="modal" class="buttons bottomButton">Cancel</button>';
$button2 = '<button class="buttons bottomButton" id="saveGroupName">Save</button>';
echo $this->Modal-> displayAction('editGroup', array('controller'=>'groups', 'action'=>'editGroup','groupId'=>$objGroup->getAttr('id')),'Edit Group',$button1, $button2);
?>
</div>
<div id="grpoptdel">

</div>
<ul id="myTab" class="nav nav-tabs">
	<li id="gmembers" class="active">
		<a href="#employment_list" data-toggle="tab"
		id="#employment_list_link">Group Members</a>
	</li>
	<li id="newmember">
		<a href="#add_new_employment" data-toggle="tab"
		id="add_new_employment_link">Edit Members</a>
	</li>
</ul>
<style>

	#employment_list, #addMemberList{
		margin-left: 20px;
		width: 500px;
	}
	.alphalist{
		width: 520px;
	}
	
	.alphabatic a {
	    color: #333333;
	    display: inline-block;
	    font-size: 12px;
	    padding: 2px 3px;
	}

</style>

<div class="tab-content" style="overflow: visible;">
	<div class="tab-pane active" id="employment_list">
		<?php echo $this->element('Users/list_friend'); ?>		

	</div>
	<div class="tab-pane" id="add_new_employment">

		<div class="friendgryBg">
			<div class="friendgryTop">
				<div class="friendgryBottom">
					Please simply start typing the name, username or email of the person you are looking for.
					<br>
					<br>
					<div class="srchfriend">
						<?php
						echo $this -> Form -> input('q', array('label' => false, 'type' => 'text', 'class' => 'srchfld', 'value' => 'Search Friends', 'onblur' => "replaceText(this)", 'onfocus' => "clearText(this)", 'onkeypress' => "return delayExecute();"));
						?>
					</div>

					<div class="clr"> </div>
					
				</div>
			</div>
		</div>
		
<div class="alphalist">
	<div class="advantureBarNew">
		<div class="alphabatic">
			<a href="#" class="linkalphabetic">All</a>
			<a href="#" class="linkalphabetic">A</a>
			<a href="#" class="linkalphabetic">B</a>
			<a href="#" class="linkalphabetic">C</a>
			<a href="#" class="linkalphabetic">D</a>
			<a href="#" class="linkalphabetic">E</a>
			<a href="#" class="linkalphabetic">F</a>
			<a href="#" class="linkalphabetic">G</a>
			<a href="#" class="linkalphabetic">H</a>
			<a href="#" class="linkalphabetic">I</a>
			<a href="#" class="linkalphabetic">J</a>
			<a href="#" class="linkalphabetic">K</a>
			<a href="#" class="linkalphabetic">L</a>
			<a href="#" class="linkalphabetic">M</a>
			<a href="#" class="linkalphabetic">N</a>
			<a href="#" class="linkalphabetic">O</a>
			<a href="#" class="linkalphabetic">P</a>
			<a href="#" class="linkalphabetic">Q</a>
			<a href="#" class="linkalphabetic">R</a>
			<a href="#" class="linkalphabetic">S</a>
			<a href="#" class="linkalphabetic">T</a>
			<a href="#" class="linkalphabetic">U</a>
			<a href="#" class="linkalphabetic">V</a>
			<a href="#" class="linkalphabetic">W</a>
			<a href="#" class="linkalphabetic">X</a>
			<a href="#" class="linkalphabetic">Y</a>
			<a href="#" class="linkalphabetic">Z</a>
		</div>
	</div>
</div>	




		
		<div id="addMemberList"></div>
	</div>

</div>

<script>

var typingTimer;
var doneTypingInterval = 450;

//Detect keystroke and only execute after the user has finish typing
	function delayExecute()
	{
	    clearTimeout(typingTimer);
	        typingTimer = setTimeout(
	        function(){somethingExecuted('typesomethinghere')},
	        doneTypingInterval
	    );
	
	    return true;
	}
	
	function somethingExecuted( theInputName)
	{
		
		myParam = {	groupId: '<?php echo $objGroup->getAttr('id'); ?>', q:$("#q").attr('value'), }
	

	   $.ajax({
		   	async:true, 
		   	data:myParam, 
		   	dataType:'json',
		   	success:function (data, textStatus) {

		   		$("#addMemberList").html(data.content);
		   	}, 
		   	error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      	  $('#addMemberList').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/groups/listNewMembers/')?>"
	   	});
	}
	


	
	//refresh the group member list
	$('#gmembers').click(function(){
		
		reloadGroupResult();
		
	});
	
	function reloadGroupResult(){
		
		myParam = {	groupId: '<?php echo $objGroup->getAttr('id'); ?>', }
	

	   $.ajax({
		   	async:true, 
		   	data:myParam, 
		   	dataType:'json',
		   	success:function (data, textStatus) {

		   		$("#resultGroupSearch").html(data.content);
		   	}, 
		   	error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      	  $('#resultGroupSearch').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/groups/listMembers/')?>"
	   	});		
	}
	
	
	
	//refresh the group member list
	$('#newmember').click(function(){
		
		loadAddNewMemberPage(null);
		
	});
	
	function loadAddNewMemberPage(inialpha){
		
		myParam = {	groupId: '<?php echo $objGroup->getAttr('id'); ?>', ini: inialpha,}
	

	   $.ajax({
		   	async:true, 
		   	data:myParam, 
		   	dataType:'json',
		   	success:function (data, textStatus) {

		   		$("#addMemberList").html(data.content);
		   	}, 
		   	error: function(xhr,textStatus,error){
                alert('The server can not be reached in this moment. Please, try later.');
        	},
        	beforeSend: function(){
        		
	      	  $('#addMemberList').html('<?php echo $this->Html->image('loading.gif');?>'); 	
		    },
		   	type:"post", 
		   	url:"<?php echo $this->Form->url('/groups/listAllMembers/')?>"
	   	});	
	   	
	}
	
	$('.linkalphabetic').click(function(){
		
		iniAlpha = ($( this ).html() == 'All')? null : $( this ).html();
		
		
		loadAddNewMemberPage( iniAlpha );
	});
	
	$(document).ready(function(){
	
		$('.ctooltip').tooltip();
	});

</script>