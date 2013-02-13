<?php
$cakeDescription = __d('cake_dev', 'Living Alpha - Prototype V.0.1');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
echo $this->Facebook->html();

?>
<head>
<?php  
#Removed because we're going to user the FB
#echo $this->Html->charset(); ?>

<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>

<?php
echo $this->Html->meta('icon');



echo $this->Html->css(array(
		'style',
		'scrollbar',
		'colorbox',
		'calendar',
		'jquery-ui-1.8.20.custom',
		'uploadifive',
		'bootstrap.scaffolding',
		'bootstrap.basecss.form',
		'bootstrap.basecss.buttons',
		'uploadify'
));

/**
*
*/

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('functions');


?>


</head>
<body >
	<style>
		.popup_title{
		    background-color: #3C64A1;
		    color: white;
		    height: 30px;
		    margin-bottom: 20px;
		    
		}
		.popup_title span{
			font-weight: bold;
			margin-left: 20px;
		}
		.popup_body{
		    margin-bottom: 20px;
		    margin-up: 20px;
		}
		.popup_body span{
			font-weight: bold;
			margin-left: 20px;
		}		
	</style>
	<div class="row">
	    <div class="span12 popup_title"> <span>Living Alpha</span></div>
    </div>
   	<div class="row">
	    <div class="span12 popup_body"> <span>Log in to use your Living Alpha account with "LANDINPAGE DOMAIN".</span></div>
    </div> 
	<?php  
	if ($this->Session->check('Message') != NULL) { 
		echo $this->Session->flash();
		?>
		<script>
			window.resizeTo(650, 400);
		</script>
		<?php
	}
	?>	
    <?php echo $this->Form->create('User', array('action' => 'externalLogin', 'class'=>'form-horizontal')); ?>
    <?php echo $this->Form->hidden('key', array('value'=> $key)); ?>
	    <div class="control-group">
	    <label class="control-label" for="inputEmail">Username or Email</label>
	    <div class="controls">
	    <?php echo $this->Form->input('username', array(
								        							'type'=>'text',
								        							'div'=> false,
								        							'label'=>false,
								        							'class'=>'loginInput',
								        							'placeholder'=>'Username or Email'
								        							));  
					?>
	    </div>
	    </div>
	    <div class="control-group">
	    <label class="control-label" for="inputPassword">Password</label>
	    <div class="controls">
	    <?php echo $this->Form->input('password', array(
								        							'div'=> false,
								        							'label'=>false,
								        							'class'=>'loginInput',
								        							'placeholder'=>'Password'
								        							)); 
					?>
	    </div>
	    </div>
	    <div class="control-group">
	    <div class="controls">
	    
	    <button type="buttton" class="btn" onclick="return window.close();" >Cancel</button>
	    <button type="submit" class="btn btn-primary">Sign in</button>
	    </div>
	    </div>
	    
	    <div class="row">
	    <div class="span12 popup_body"><span id="signup"><a href="/users/externalRegistration?&client_id=<?php echo $oAuthParams['client_id']; ?>&redirect_url=<?php echo $oAuthParams['redirect_url']; ?>"> Sign up for Living Alpha </a></span></div>
    	</div>
    	
    	<div class="row">
		<div class="span12 popup_body"><?php echo $this->Facebook->login(array('img' => 'connectwithfacebook.gif', 'redirect' => array('controller' => 'Users', 'action' => 'facebookSingUp'))); ?></div>
    	</div>
    	
    	
	    
	    
	    
	    
	    
	    
    <?php echo $this->Form->end(); ?>
    
    

</body>
<?php echo $this->Facebook->init(); ?>
	
 <script type="text/javascript"> 

<?php 
 if($isLogged){ 
?>	
	window.opener.location = '<?php echo $redirectURL; ?>';
	window.close();
<?php
}
 
?>
</script>
</html>	
