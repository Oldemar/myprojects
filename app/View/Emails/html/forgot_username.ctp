<p>Hi <?php echo $objUser->getAttr('firstname'); ?>:</p>


<p>Here is the list of usernames that we have on file for your email address:</p> 


<p><?php echo implode('<br>',$arrUsername);?></p>
 
<p>Please login <?php echo $this->Html->link('here', array('controller' => 'users' , 'action'=> 'login/' , 'full_base' => true));?> and enter your username and password.</p>

<p>Thanks,<br>
LivingAlpha Customer Support Team</p> 
