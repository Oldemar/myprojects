										<?php if (isset($isins) && $isins!= null)
													if ($isins[0] != null && $isins[1] != null ) { ?>
										<div id="usrgrpdel">
										<?php 
											echo $this->Form->link($this->Html->image('insert.jpg', array('height'=>'15')), 
																array('controller'=>$isins[0], 'action'=>$isins[1]),
																array('escape'=> false)); 
										?>
										</div>
										<?php } ?>														
										<?php if ( isset($isdel) && $isdel!=null)
													if ($isdel[0] != null && $isdel[1] != null ) { ?>
										<div id="usrgrpdel">
										<?php 
											echo $this->Form->postLink($this->Html->image('delete.png', array('height'=>'13')), 
																array('controller'=>$isdel[0], 'action'=>$isdel[1],
																		$usr['GroupsUser']['id']),
																array('escape'=> false),
																__('Are you sure you want to delete # %s?', $usr['User']['firstname'].' '.$usr['User']['lastname'])); 
										?>
										</div>
										<?php } ?>														
										<?php if (isset($isedt) && $isedt!=null) 
													if ($isedt[0] != null && $isedt[1] != null && $isedt[2] != null ) { ?>
										<div id="usrgrpdel">
										<?php 
											echo $this->Form->link($this->Html->image('edit_icon.png', array('height'=>'15')), 
																array('controller'=>$isedt[0], 'action'=>$isedt[1],$$isedt[2]),
																array('escape'=> false)); 
										?>
										</div>
										<?php } ?>														