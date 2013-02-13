<?php
 
 /**
 * @param: $objJournal
 * @param $objLoggedUser (optional)
 *
 * Configuration parameters:
 * @param $maxChars (optional)
 * @param $arrLinkToJournalLogged (optional) 
 * @param $arrLinkToJournalNotLogged (optional)
 * @param 
 */
 
if(!isset($maxChars)){
	$maxChars = '130';
}

if(!is_object($objJournal)){
	throw new NotFoundException('Invalid ObjJournal on element/journals/journal_row.ctp');
}

if(!isset($arrLinkToJournalLogged)){ 
	$arrLinkToJournalLogged = array('controller' => 'journals', 'action' => 'view', $objJournal->getID());
}

if(!isset($arrLinkToJournalNotLogged)){
	$arrLinkToJournalNotLogged = array('controller' => 'index', 'action' => 'journalview', $objJournal->getID());
}

if(isset($objLoggedUser) && is_object($objLoggedUser) && $objLoggedUser->getID()){
	$boolIsUserLogged = true;
	$arrLinkToJournal = $arrLinkToJournalLogged;
}else{
	$boolIsUserLogged = false;
	$arrLinkToJournal = $arrLinkToJournalNotLogged;
}

 
$objController->loadAditionalCss('popover_journallist');
$objController->loadAditionalCss('bootstrap.basecss.buttons');
$objController->loadAditionalCss('bootstrap.basecss.labelsandbadges');
$objController->loadAditionalCss('bootstrap.components.buttongroupsanddropdowns');
$objController->loadAditionalCss('bootstrap.js_components.dropdowns');
$objController->loadAditionalCss('bootstrap.base.icons');
$objController->loadAditionalCss('bootstrap.js_components.tooltips');

$objController->loadAditionalJs('bootstrap.tooltip');
$objController->loadAditionalJs('bootstrap.dropdowns');

 ?>
<script>
$(document).ready(function(){
	$('.ctooltip').tooltip();
});
</script> 
<div class="popover_journal_list left" style="margin-top:15px;">
	<h3 class="popover_journal_list-title">
		<b><?php echo $this->Html->link($objJournal->getAttr('title'), $arrLinkToJournal); ?></b> 
		by <?php echo $this->Html->link($objJournal->User->getAttr('username'),array('controller'=>'users','action'=>'profile',$objJournal->User->getID())); ?>
		<span style="float:right;"><?php echo implode('',$objJournal->getSelfAverageRatingSunsToDisplay()); ?>&nbsp;</span></h3>
	<div class="popover_journal_list-content">
		<div class="row-fluid">
			<div class="span3">
				<?php
					echo $this->Html->image($objJournal->getCoverPhotoToDisplay($objLoggedUser), array( 'url' => $arrLinkToJournal)) ;
				?>
			</div>
		<?php if($boolIsUserLogged && $objJournal->checkIfIsTheOwner($objLoggedUser)){ ?>
			<div class="span6">
		<?php }else{ ?>
			<div class="span9">
		<?php }?>
				
				<?php
					echo '<b>'.$objJournal->getDateEventString().'</b><br>';
					echo $objJournal->getAreaString().'<br>';
					echo $objJournal->City->getNameToExhibit().'<br>';
					echo $objJournal->getAttr('location').'<br>';
				?>
			</div>
			<?php if($boolIsUserLogged &&  $objJournal->checkIfIsTheOwner($objLoggedUser)){ ?>
			<div class="span3">
			    <div class="btn-group">
			    
			    <a href="javascript:;" data-toggle="dropdown" class='btn btn-mini btn-primary dropdown-toggle'><i class="icon-list-alt icon-white"></i> Options <span class="caret"></span></a>
				
			    <ul class="dropdown-menu">
			    	<li><?php echo $this->Html->link('<i class="icon-th-list"></i> View details', array('controller' => 'journals', 'action' => 'view', $objJournal->getID()),array('escape'=> false)); ?></li>
		    		<li><?php echo $this->Html->link('<i class="icon-pencil"></i> Edit',array('controller' => 'journals','action' => 'editnew', $objJournal->getID()),array('escape'=> false));?></li>
		    		<li><?php echo $this->Html->link('<i class="icon-camera"></i> Photos', array('controller' => 'photos', 'action' => 'album', $objJournal->getID()),array('escape'=> false)); ?></li>
		    		<li><?php echo $this->Html->link('<i class="icon-film"></i> Videos', array('controller' => 'videos', 'action' => 'album', $objJournal->getID()),array('escape'=> false)); ?></li>
			    </ul>
			    </div>
			    <?php
			    	$arrCommentsCount = $objJournal->getCountCommentsGroupByViewed();
					if($arrCommentsCount['notviewed'] > 0){
				?>
			    <br><br><span class="label label-important"><?php echo $arrCommentsCount['notviewed'];?> new comment <?php if($arrCommentsCount['notviewed']>1){echo 's';}?></span>
			    <?php }elseif($arrCommentsCount['viewed'] > 0){?>
			    <br><br><span class="label"><?php echo $arrCommentsCount['viewed'];?> comments</span>	
			    <?php } ?>
			</div>
			<?php } ?>
		</div>
		<div class="row-fluid">
			<div class="span12" style="text-align:justify;color:#888888;min-height: 20px;">
				<?php
					if($objJournal->getShortDescription('forall_description',$maxChars)){
						echo '<span class="label label-success ctooltip" rel="tooltip" data-original-title="Global" data-placement="bottom">G</span> <i>"'.$objJournal->getShortDescription('forall_description',$maxChars).'"</i><br>';
					}
					
					if($boolIsUserLogged && $objJournal->checkCanSeeFriendSection($objLoggedUser) && $objJournal->getShortDescription('forgroup_description',$maxChars)){
						echo '<a class="label label-info ctooltip" rel="tooltip" data-original-title="For Friends like you" data-placement="bottom">F</a> <i>"'.$objJournal->getShortDescription('forgroup_description',$maxChars).'"</i><br>';
					}
					
					if($boolIsUserLogged && $objJournal->checkIfIsTheOwner($objLoggedUser) && $objJournal->getShortDescription('forme_description',$maxChars)){
						echo '<a class="label label-important ctooltip" rel="tooltip" data-original-title="For me only" data-placement="bottom">P</a> <i>"'.$objJournal->getShortDescription('forme_description',$maxChars).'"</i>';
					}
						
				?>
			</div>
			<div class="span12" style="text-align:right;min-height: 20px;">
				<?php echo $this->Html->link('Read more', $arrLinkToJournal); ?>
			</div>
		</div>
	</div>
	<script>$('.dropdown-toggle').dropdown();</script>
</div>