												<?php
													$rateTit = "Your new rate<br>";
													$sl = CakeSession::read('shrlev');
													$rate = $keyrate = 0 ;
													$alphasun = array('rating_icon.gif','rating_icon_gry.gif');
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['sharing_level'] == CakeSession::read('shrlev') && $journalrate['user_id'] == AuthComponent::user('id')) {
															$rate = $journalrate['rate'];
															$keyrate = $journalrate['id'];
															$rateTit = "Your new rate<br>";
															break;
														}	
													endforeach;
													echo $rateTit;
													if ($rate) {
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image($alphasun[($x-$rate<=0 ? 0 : 1)]), "#",
																							array('escape'=> false,'id'=>"rating".CakeSession::read('shrlev').$x));
														}	
													} else { 
														for ($x=1;$x<6;$x++) {
															echo $this->Html->link($this->Html->image('rating_icon_gry.gif'), "#",
																							array('escape'=> false,'id'=>"rating".CakeSession::read('shrlev').$x));
														}	
													}
													if ($journals['Journal']['user_id'] == AuthComponent::user('id') ? CakeSession::write('mykeyrate') : CakeSession::write('themkeyrate'));
													$keyrate1 = ($journals['Journal']['user_id'] == AuthComponent::user('id') ? CakeSession::read('mykeyrate') : CakeSession::read('themkeyrate'));
													echo ' '.CakeSession::read('shrlev').' '.$keyrate1;
													// Write cached scripts
													echo $this->Js->writeBuffer(array(
																	'cache'=>true,
																	'inline'=>true,
																	'clear'=>false
															)); 
												?>
<?php 
$keyrate1 = ($journals['Journal']['user_id'] == AuthComponent::user('id') ? CakeSession::read('mykeyrate') : CakeSession::read('themkeyrate'));
for ($x=0;$x<3;$x++) {
	for ($y=1;$y<6;$y++) {
		$this->Js->get("#rating$x$y")->event('click', 
			$this->Js->request(array(
				'controller'=>'journals',
				'action'=>'saveratesml', $x, $y, $journals['Journal']['id'], $keyrate1
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

for ($x=0;$x<3;$x++) {
	$div = ($journals['Journal']['user_id'] == AuthComponent::user('id') ? 'jRating':"ORrating$x");
	for ($y=1;$y<6;$y++) {
		$this->Js->get("#rating$x$y");
		$this->Js->event('click', 
				$this->Js->request(array(
				'controller'=>'journals',
				'action'=>'getratebig', $x, $y, $journals['Journal']['id'], $keyrate1
				), array(
				'update'=> "#$div",
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