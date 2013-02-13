							<div class="grpimage">
							<?php
								echo $this->Html->image($groupsimg[$this->data['group_id']],array('width'=>'40', 'height'=>'35'));
							?>
							</div>
							<div id="grpoptedt" >
							<?php 
								echo $this->Html->link($this->Html->image('edit_icon.png', array('height'=>'20')), 
													array('controller'=>'groups','action'=>'edit',$this->data['group_id']),
													array('escape'=> false)); ?>
							</div>
							<div id="grpoptdel">
							<?php 								
								echo $this->Form->postLink($this->Html->image('delete.png', array('height'=>'17')), 
													array('controller'=>'groups', 'action'=>'delete',$this->data['group_id']),
													array('escape'=> false),
													__('Are you sure you want to delete # %s?',$group['Group']['name'])); 
							?>
							</div>
							<div>
								<?php
									/*
									 *  Params to be passed
									 *  usertobeshow => An array that contains the users to be shown
									 *  elementactions => the element that contains the actions to be shown
									 */ 
										$this->set('isins','');
										$this->set('isdel',array('groups','delusergroup'));
										$this->set('isedt','');
										$this->set('ischk','');
										$this->set('isspec','');
										$this->set('usr', $usersbygroup);
										echo $this->element('usersmlbox', array(
														'usertobeshow'=>$usersbygroup,
														'elementactions'=>'usersgroup'
														));
								?>										
							</div>