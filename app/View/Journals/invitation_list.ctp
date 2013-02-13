<?php

	echo "<pre>".print_r($this->data,true)."</pre>"	;

?>
							<div class="expandable"><a href="#">Step 3 - Invitations</a></div>
							<div class="categoryitems popform" id="pendInvites">
								<h4>Would you like to invite more friends who are not in Living Alpha?
									<a href="javascript://" onclick="pop_show('divInvitation')"> Click Here</a></h4>
								<div id="divInvitation" style="display:none;">
									<?php
										echo $this->Form->input('invited', array(
																'type'=>'email',
																'div'=>false,
																'label'=>false,
																'id'=>'inputInvitation',
																'value'=>'Enter a valid email',
																'onblur'=>'replaceText(this)',
																'onfocus'=>'clearText(this)'
																));
										echo $this->Form->textarea('invitation', array(
																'rows'=>'6',
																'cols'=>'20',
																'class'=>'popmessage',
																'div'=> false,
																'label'=> false,
																'value'=>'Would you like to be my friend.....',
																'onblur'=>'replaceText(this)',
																'onfocus'=>'clearText(this)'
																));
										echo "   ".$this->Html->link('Add this Invitation', '#', 
														array('id'=>'addInvitation'));
														
										echo "<pre>".print_r($this->data,true)."</pre>";
									?>
								</div> 
									<h2>Not sent</h2>
									
								<?php
									foreach ($journals['Invitation'] as $invitation) :
								?>
								<?php
										if (!$invitation['sent']) {
											echo "<h4>Who :</h4><p style=\"padding:0 20px 5px 10px\">".$invitation['invited']."</p>";
											echo "<h4>Message :</h4><p style=\"padding:0 20px 5px 10px\">".$invitation['invitation'];
											echo "<h4>sent on :</h4><p style=\"padding:0 20px 5px 10px\">".CakeTime::format('F jS, Y ',$invitation['created']) ;
										}
									endforeach;
								?>
									<h2>Not accepted</h2>
									
								<?php
									foreach ($journals['Invitation'] as $invitation) :
								?>
								<?php
										if ($invitation['sent']) {
											echo "<h4>Who :</h4><p style=\"padding:0 20px 5px 10px\">".$invitation['invited']."</p>";
											echo "<h4>Message :</h4><p style=\"padding:0 20px 5px 10px\">".$invitation['invitation'];
											echo "<h4>sent on :</h4><p style=\"padding:0 20px 5px 10px\">".CakeTime::format('F jS, Y ',$invitation['created']) ;
										}
									endforeach;
								?>
							</div>
