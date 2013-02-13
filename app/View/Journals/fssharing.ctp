																<div id="fSsharing">
																	<?php
																		foreach ($friendlist as $frnd) :
																			if (!$frnd['User']['allowed']) {
																			
																	?>
																	<div style="padding:5px 0 0 24px">
																	<?php	
																			echo $this->Form->checkbox('fsharing.'.$frnd['User']['id'], array(
																						'id'=>'chkbxf'.$frnd['User']['id']
																						));
																			echo ' '.$frnd['User']['firstname'].' '.$frnd['User']['lastname'];
																			$idchkbxf = $frnd['User']['id'];
																			
																	?>
																	</div>
																	<?php 
																	$this->Js->get("#chkbxf$idchkbxf")->event('click', 
																		$this->Js->request(array(
																			'controller'=>'journals',
																			'action'=>'fssharing'
																			), array(
																			'update'=>"#fSsharing",
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
																	<?php	
																			}
																		endforeach;
																	?>
																</div>
