<style>
				
.lmargin {
	height: 80px;
	margin-bottom: 2px;
	margin-top: 2px;
	margin-left: 1px;
}

.gname{
	
	font-size: 17px;
}
</style>
			<style>
				[class*="span"] {
			
					margin-left: 8px;
				}

			</style>
<?php

if(is_array($listGroup) && count($listGroup) > 0){
	
	foreach ($listGroup as $key => $objGroup) {
		
		$listMembers = $objGroup->listMembers();
		
 ?>
		<div class="row advantureBarNew lmargin">

			<div class="row-fluid">
				
				<div class="span12">
					<?php  echo $this -> Html -> link($objGroup -> getAttr('name'), array('controller' => 'groups', 'action' => 'index','groupid' => $objGroup -> getAttr('id')), array('escape' => false, 'class' => 'gname')).'  ('. count($listMembers).' members)'; ?>
					
				</div>
			</div>
			<div class="row-fluid">
				
				<div class="span9" >
					<?php 
					
						$listMemberLink = array();
						$iTruncate = 0;
						foreach ($listMembers as $key => $objFriend) {
						
							array_push($listMemberLink, $this -> Html -> link($objFriend -> getAttr('username'), array('controller' => 'users', 'action' => 'profile', $objFriend -> getAttr('id')), array('escape' => false)));
							
							$iTruncate ++;
							
							if($iTruncate == 10) break;	
						}
						
						echo implode(', ', $listMemberLink). $this -> Html -> link(' ... and more', array('controller' => 'groups', 'action' => 'index','groupid' => $objGroup -> getAttr('id')), array('escape' => false));
					
					 ?>
				
				</div>
				

			</div>
		</div>

		
<?php 
	}
} ?>