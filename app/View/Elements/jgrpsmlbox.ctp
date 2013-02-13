							<div class="jfriendboxbar">
							<div class="headtxtBg">Groups</div>							

							<?php
								foreach ($grptobeshow as $grp) :
							?>
										<div id="addJuserImgContainer">
											<div class="addJuserImgbg">
											<?php 
												if ( isset( $grp['Group']['image'] ) && ( $grp['Group']['image'] != null ) ) {
													echo $this->Html->image($grp['Group']['image'], 
																	array('width'=>'69', 'url' => array('controller' => 'groups', 'action' => 'edit', $grp['Group']['id']))) ; 
												} else {
													echo $this->Html->image('nopicture.gif', 
																	array('width'=>'69', 'url' => array('controller' => 'groups', 'action' => 'edit', $grp['Group']['id']))) ;
												}
											?>
											</div>
											<?php 
												echo $this->Html->link($grp['Group']['name'], 
																	array('controller' => 'groups', 'action' => 'edit', $grp['Group']['id']),
																	array('id'=>'group'.$grp['Group']['id'])) ; 
											?>
										<?php 
											/*
											 *  Params to be passed
											 *  isdel => an array that could contains: the controller, the action and the ID 
											 *  isins => an array that could contains:  the controller and the action
											 *  isedt => an array that could contains: the controller, the action and ID
											 *  ischk => an array that could contains: the controller, the action, the ID and
											 *  				an array that could contains params
											 *  isspecX => an array that could contains: icon to be shown, the controller the action and
											 *  				 an array with the params, where the 'X' could be a sequential #
											 */ 
											$this->set('grp',$grp);
											if (isset($elementactions) && $elementactions != null)
												echo $this->element($elementactions, array(
																	'isins'=>$isins,
																	'isdel'=>$isdel,
																	'isedt'=>$isedt,
																	'ischk'=>$ischk,
																	'isspec'=>$isspec
																	));
										?>
										</div>											
																								
							<?php 
									endforeach;
							?>
							</div>
