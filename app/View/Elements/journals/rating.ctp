												<?php
												
													$y = $rate = $keyrate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ($journalrate['sharing_level'] ==  $shrlvl &&
															$journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
														}	
													endforeach;
													
													echo "<script> var rateBeforeUnload = $rate ;</script>";
													
													for ($x=1;$x<=5;$x++) {
														if($x>$rate){
															echo $this->Html->link($this->Html->image('rating_icon_big_gry.gif'), "#",
																	array('escape'=> false,'id'=>"rating$shrlvl$x"));
														}else{
															echo $this->Html->link($this->Html->image('rating_icon_big.gif'), "#",
																							array('escape'=> false,'id'=>"rating$shrlvl$x"));
														}
													}	
												?>
<?php 
for ($y=1;$y<6;$y++) {
	$this->Js->get("#rating$shrlvl$y")->event('click', 
		$this->Js->request(array(
			'controller'=>'journals',
			'action'=>'saverate',$shrlvl,$y,$journals['Journal']['id'], $keyrate
			), array(
			'update'=>"#rating$shrlvl",
			'async' => true,
			'method' => 'post',
			'dataExpression'=>true,
			'data'=> $this->Js->serializeForm(array(
				'isForm' => true,
				'inline' => true
				))
			))
		);
	
?>
<script> 
	$('#rating<?php echo $shrlvl.$y; ?>').click(function(){
		var rateBeforeUnload = <?php echo $y; ?>;
		window.onbeforeunload = null;
		$('#saveAndFinish').css('display','block');
	});
</script>
<?php

	}	
?>
