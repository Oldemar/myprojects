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
	//echo $this->CachedElement->userProfileImage($objFriend->getAttr('id'),'w90', array('width'=>60));
?>
</div>
<div class="span3">
	<?php  echo $this -> Html -> link($objFriend -> getAttr('username'), array('controller' => 'users', 'action' => 'profile', $objFriend -> getAttr('id')), array('escape' => false)); ?>
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
<div class="row-fluid"><h4>Groups</h4></div>
	<div class="row-fluid">
		<div id="facet_area_id" class="boxFacet txt11">
			<ul id="area_id" class="selectMultiplo  mutiplo" showcheckbox="true" unique="false" maxlength="100000">
				<?php
				foreach ($objUser->listGroupsByUser() as $key => $objGroup) {

					if($objGroup->isInGroup($objFriend -> getAttr('id'))){

						echo '<li class="groupli selected" groupId="'. $objGroup -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('class'=>'selected', 'label' => false, 'checked' => $objGroup->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroup -> getAttr('name') . '</span></li>';
					}
					else{
							
						echo '<li class="groupli" groupId="'. $objGroup -> getAttr('id').'" userId="'.$objFriend -> getAttr('id').'">' . $this -> Form -> checkbox('Group.userlist.', array('label' => false, 'checked' => $objGroup->isInGroup($objFriend -> getAttr('id')))) . ' <span class="sLabel">' . $objGroup -> getAttr('name') . '</span></li>';
						
					}

				}
				?>
			</ul>
		</div>


	</div>

</div>

