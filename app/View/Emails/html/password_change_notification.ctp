<p>Hi <?php echo $obj->getAttr('firstname'); ?></p>

<p>The password for your LivingAlpha Username "<?php echo $obj->getAttr('username'); ?>" has been successfully changed.</p>

<p>If you believe you have received this email in error, or that an unauthorized person has accessed your
account, please <?php echo $this->Html->link('click here', array('controller' => 'users' , 'action'=> 'new_password/'.$hash , 'full_base' => true));?> to reset your password immediately.</p>

<p>If you have any questions? Please contact <a href="mailto:Webmaster@LivingAlpha.com">Webmaster@LivingAlpha.com</a></p>

<p>Thanks,<br>
LivingAlpha Customer Support Team</p>
