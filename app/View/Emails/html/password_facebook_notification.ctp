<p>Hi <?php echo $obj->getAttr('firstname'); ?></p>

<p>Your LivingAlpha email (<?php echo $obj->getAttr('email'); ?>) is associated with your Facebook account. "</p>

<p>Please, <?php echo $this->Html->link('click here', array('controller' => 'users' , 'action'=> 'new_password/'.$hash , 'full_base' => true));?> to create a new Living Alpha password.</p>

<p>If you have any questions? Please contact <a href="mailto:Webmaster@LivingAlpha.com">Webmaster@LivingAlpha.com</a></p>

<p>Thanks,<br>
LivingAlpha Customer Support Team</p>
