												<?php
													$rate = $keyrate = 0 ;
													$alphasun = array('rating_icon_big.gif','rating_icon_big_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['sharing_level'] == 2 && $journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
															break;
														}	
													endforeach;
													
													if ($rate) {
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image($alphasun[($x-$rate<=0 ? 0 : 1)]), "#",
																							array('escape'=> false,'id'=>"rating2$x"));
														}	
													} else { 
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image('rating_icon_big_gry.gif'), "#",
																							array('escape'=> false,'id'=>"rating2$x"));
														}	
													}
													if ($journals['Journal']['user_id'] == AuthComponent::user('id') ? CakeSession::write('mykeyrate') : CakeSession::write('themkeyrate'));
													$keyrate1 = ($journals['Journal']['user_id'] == AuthComponent::user('id') ? CakeSession::read('mykeyrate') : CakeSession::read('themkeyrate'));
													echo $keyrate1;
																										// Write cached scripts
													echo $this->Js->writeBuffer(array(
																	'cache'=>true,
																	'inline'=>true,
																	'clear'=>false
															)); 
												?>
<?php 
$keyrate = CakeSession::read('keyrate');
for ($x=0;$x<3;$x++) {
	for ($y=1;$y<6;$y++) {
		$this->Js->get("#rating$x$y")->event('click', 
			$this->Js->request(array(
				'controller'=>'journals',
				'action'=>'saverate',$x,$y,$journals['Journal']['id'], $keyrate
				), array(
				'update'=>"#rating$x",
				'async' => true,
				'method' => 'post',
				'dataExpression'=>true,
				'data'=> $this->Js->serializeForm(array(
					'isForm' => true,
					'inline' => true
					))
				))
			);
		}
	}
?>	
												
