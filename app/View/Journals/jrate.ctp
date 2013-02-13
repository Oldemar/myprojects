												<?php
													$rate  = 0 ;
													$trate = 0 ;
													foreach ($journals['Journalrate'] as $journalrate) :
														if ( $journalrate['user_id'] == $journals['Journal']['user_id'] ) {
															$rate += $journalrate['rate'];
															$trate++;
														}	
													endforeach;
													if ($rate) {
														$rate = round($rate/$trate);
														for ($x=1;$x<6;$x++) {
															if ($x <= $rate) {
																print("<img src=\"{$this->webroot}img/rating_icon_big.gif\" alt=\"\" />");
															} else {
																print("<img src=\"{$this->webroot}img/rating_icon_big_gry.gif\" alt=\"\" />");
															}
														}	
													} else { 
												?>
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_big_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_big_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_big_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_big_gry.gif" alt="" />
													<img src="<?php echo $this->webroot ; ?>img/rating_icon_big_gry.gif" alt="" />
												<?php  } ?>
<?php 
$keyrate = CakeSession::read('keyrate');
for ($x=0;$x<3;$x++) {
	for ($y=1;$y<6;$y++) {
		$this->Js->get("#rating$x$y");
		$this->Js->event('click', 
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
		$this->Js->event('change', 
			$this->Js->request(array(
				'controller'=>'journals',
				'action'=>'jrate'
				), array(
				'update'=>"#rating",
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