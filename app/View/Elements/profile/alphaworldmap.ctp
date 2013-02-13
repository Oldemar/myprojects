<map id="alphaworldmap"  name="alphaworldmap">
	<!-- <area shape="rect" coords="2,11,53,33" href="#dreamlist">
	<area shape="rect" coords="88,14,152,30" href="#destinations"> 
	<area shape="poly" coords="58,13,58,24,75,24,80,16,80,11,119,11,115,4,64,3,57,9" href="#community">-->
	<area shape="rect" coords="153,2,189,16" href="<?php echo $this->Html->url(array('controller'=>'journals','action'=>'index'))?>">
	<area shape="rect" coords="152,24,187,48" href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'friends'))?>">
	<area shape="rect" coords="89,40,128,61" href="<?php echo $this->Html->url(array('controller'=>'interests','action'=>'index'))?>">
	<area shape="rect" coords="70,60,103,79" href="<?php echo $this->Html->url(array('controller'=>'videos','action'=>'index'))?>">
	<!--	<area shape="rect" coords="134,52,189,74" href="#">	
	<area shape="rect" coords="94,79,138,95" href="#">
	<area shape="rect" coords="151,80,192,101" href="#"> -->
	<area shape="rect" coords="56,92,93,115" href="<?php echo $this->Html->url(array('controller'=>'photos','action'=>'index'))?>">
	<area shape="rect" coords="109,101,151,119" href="<?php echo $this->Html->url(array('controller'=>'groups','action'=>'index'))?>">
</map>

<div id="my_alpha_world" class="universeTxt">
<span>Your Alpha World</span><br>
			<?php echo $this->Html->image('lft_universe_img.gif', array('usemap' => '#alphaworldmap')); ?> 
</div>


