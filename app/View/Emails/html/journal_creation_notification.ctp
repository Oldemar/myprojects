<p>Hi,</p>
<p><?php echo $objUser->getAttr('firstname'); ?> has just created a journal entry of <strong>"<a href="<?php echo Configure::read('LivingAlpha.url').'journals/view/'.$objJournal->getAttr('id'); ?>"><?php echo $objJournal->getAttr('title'); ?></a>"</strong>
	
about <strong><?php echo $objJournal->Area->getAttr('name'); ?></strong> at <strong><?php echo $objJournal->getAttr('location'); ?></strong>.</p>	

	
	