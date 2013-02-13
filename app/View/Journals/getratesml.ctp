														<?php
															$rate  = 0 ;
															$trate = 0 ;
															foreach ($journals['Journalrate'] as $journalrate) :
																if ( $journalrate['sharing_level'] == 2 && $journalrate['journal_id'] == $journals['Journal']['id'] ) {
																	$rate += $journalrate['rate'];
																	$trate++;
																}	
															endforeach;
															if ($rate) {
																$rate = round($rate/$trate);
																for ($x=1;$x<6;$x++) {
																	if ($x <= $rate) {
																		print("<img src=\"{$this->webroot}img/rating_icon.gif\" alt=\"\" />");
																	} else {
																		print("<img src=\"{$this->webroot}img/rating_icon_gry.gif\" alt=\"\" />");
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
