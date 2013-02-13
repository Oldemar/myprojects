													<div class="grytxt">Group: 
														<span class="group">
															<?php 
																foreach ($friend['GroupsUser'] as $group):
																	if (isset($group['Group']['user_id']) && $group['Group']['user_id'] == AuthComponent::user('id'))
																		echo $this->Html->link($group['Group']['name'],
																				array('controller'=>'groups','action'=>'edit',$group['Group']['id']))."  ";
																endforeach;
															?>
														</span>
													</div>
