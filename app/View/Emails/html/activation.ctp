<p>Dear <?php echo $objUser->getAttr('firstname'); ?>:</p>

<p>We would like to welcome you to the LivingAlpha family. We at Alpha are thrilled that you have decided to join our rapidly growing family and to start creating your very own Alpha World.</p>

<p>It is said that a "Life Worth Living" is a "Life Worth Journaling and Preserving".</p>

<p></p>

Click here and <?php echo $this->Html->link('Activate your account now', array('controller' => 'users' , 'action'=> 'activate/'.$hash , 'full_base' => true));?>.

<p>Sincerely,<br>
LivingAlpha Team</p>