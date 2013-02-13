<p>Hi <?php echo $objUser->getAttr('firstname'); ?></p>

<p>We are sorry you forgot your password.  Please follow the link below to reset your password: </p>

<p><?php echo $this->Html->link('Reset my password', array('controller' => 'users' , 'action'=> 'new_password/'.$hash , 'full_base' => true));?>
</p>

<p>Still having trouble? Send us an email <a href="mailto:Webmaster@LivingAlpha.com">Webmaster@LivingAlpha.com</a>. </p> 

<p>Sincerely,<br>
LivingAlpha Customer Support Team</p>
