<p>Hi,</p>
<p><?php echo $objUser->getAttr('firstname'); ?> would like to share a journal entry of <strong>"
	
	<?php echo $this->Html->link($objJournal->getAttr('title'), array('controller' => 'shares' , 'action'=> 'check/'.$shareId , 'full_base' => true)); ?>"</strong>"
	
about <strong><?php echo $objJournal->Area->getAttr('name'); ?></strong> at <strong><?php echo $objJournal->getAttr('location'); ?></strong> with you.</p>	

	
	