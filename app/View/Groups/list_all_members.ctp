<?php 

if(isset($arrayObjFriend) && count($arrayObjFriend) > 0){
	
	echo $this -> element('Users/list_friend'); 
}
else{
?>
    <div class="alert alert-info" style="width: 420px;">
    You do not have more friend to add to this group.
    </div>	
	
<?php
}
 
?>

