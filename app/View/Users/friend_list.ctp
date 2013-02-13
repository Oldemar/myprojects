								<?php
									echo "<pre>".print_r($friends,true)."</pre>";
									echo "<pre>".print_r($friendlist,true)."</pre>";
									$classj[0] = 'alternativeBarNew';
									$classj[1] = 'advantureBarNew';
									$cl_i = 1;
									foreach ($friendlist AS $friend) : 
										$cl_i = ($cl_i == 0 ? $cl_i = 1 : $cl_i = 0); ?>
								<div class="<?php echo $classj[$cl_i] ; ?>">
									
									<div class="tpPart">
										<div class="btPart">
											<div class="dreamimage">
											<?php
												echo $this->Html->link($this->Html->image($friend['User']['Picture']['name'], array('width'=>'55')), 
																		array('controller'=>'users', 'action' => 'profile', $friend['User']['id']),
																		array('escape'=> false)); 
											?>
											</div>											
											<div class="dreamtext">
												<div class="hd">
													<a href='profile/<?php print($friend['User']['id']); ?>'>
														<?php print($friend['User']['firstname']." ".$friend['User']['lastname']); ?>
													</a>
												</div>												
												<div class="ageaddress">From : 
												<?php 
													$okcity = $okregion = $okcountry = 0;
													if (isset($friend['User']['Contact']['ResCity']['name']) && $friend['User']['Contact']['ResCity']['name'] != null) {
														echo $friend['User']['Contact']['ResCity']['name'].', ';
														$okcity = 1;
													}
													if (isset($friend['User']['Contact']['ResRegion']['code']) && $friend['User']['Contact']['ResRegion']['code'] != null) {
														echo $okcity ? '' :', ';
														echo $friend['User']['Contact']['ResRegion']['code'] ;
														$okregion = 1 ;
													}
													if (isset($friend['User']['Contact']['ResCountry']['name']) && $friend['User']['Contact']['ResCountry']['name'] != null){
														echo $okregion ? ', ' :'' ;
														echo $friend['User']['Contact']['ResCountry']['name'];
														$okcountry = 1 ;
													}
													if (!$okcity && !$okregion && !$okcountry)
														echo "Not specified.";
												?>
												</div>												
											</div>														
											<div class="eventRgt">
												<div class="grytxt">Group: <span class="group"></span></div>
											</div>
											<div class="clr"></div>															
										</div>
									</div>										
									
								</div>
								<?php
									endforeach;
								?>
																
