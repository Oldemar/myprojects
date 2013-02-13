	<?php
					if ($journals['Journal']['user_id'] == AuthComponent::user('id')) {
				?>
				<div class="rgtCntrright">
					<div class="headtxtBg">Invite Friends to Join LA
					</div><br />
					<div id="divInvitation">
						<?php
							echo $this->Form->create('Invitation',array(
												'controller'=>'invitations',
												'action'=>'saveInvitation'
											));
							echo $this->Form->input('journal_id',array(
													'type'=>'hidden',
													'value'=>$journals['Journal']['id']));
							echo $this->Form->input('user_id',array(
													'type'=>'hidden',
													'value'=>Authcomponent::user('id')));
							echo $this->Form->input('tablename_id',array(
													'type'=>'hidden',
													'value'=>'11'));
							echo $this->Form->input('id_value',array(
													'type'=>'hidden',
													'value'=>$journals['Journal']['id']));
							
							echo $this->Form->input('invited', array(
													'type'=>'text',
													'div'=>false,
													'label'=>false,
													'id'=>'inputInvitation',
													'value'=>'Enter a valid email',
													'onblur'=>'replaceText(this)',
													'onfocus'=>'clearText(this)'
													));
							echo $this->Form->textarea('invitation', array(
													'rows'=>'6',
													'cols'=>'32',
													'id' => 'inputMessage',
													'div'=> false,
													'label'=> false,
													'value'=>'Would you like to be my friend.....',
													'onblur'=>'replaceText(this)',
													'onfocus'=>'clearText(this)'
													));
							echo $this->Form->end('Send Invitation');
						?>
					</div> 
				</div>			
				<div class="clr"></div>
				<?php } ?>
