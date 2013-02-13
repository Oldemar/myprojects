							<ul>
								<?php 
									foreach ($photos as $photo) : 
										if ($photo['Photo']['sharing_level'] == $shrlvl) {
								?>
								<li>
									<div>
										<div id="btndelphto">
											<?php 
												echo $this->Form->postLink($this->Html->image('delete.png', array('width'=>'10')), 
															array('controller' => 'photos' ,'action' => 'delete', $photo['Photo']['id'], $journals['Journal']['id']),
															array('escape'=> false), 
															__('Are you sure you want to delete this photo?'));  ?>
										</div>
										<?php
											$imgsize = getimagesize(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS.'img/'.$photo['Photo']['name']);
											if ($imgsize[0] > 140 && $imgsize[1] > 120) {
												if ($imgsize[0] >= $imgsize[1]) {
														$wdth = '140';
														$hght = intval((140*$imgsize[1])/$imgsize[0]);
												} else {
														$wdth = intval((120*$imgsize[0])/$imgsize[1]);
														$hght = '120';
													}
											} else {
												$hght = intval((140*$imgsize[1])/$imgsize[0]);
												$wdth = intval((120*$imgsize[0])/$imgsize[1]);
											}
										?>
										<?php echo $this->Html->link($this->Html->image($photo['Photo']['name'], array('width'=>$wdth,'height'=>$hght)),
																array('controller'=>'photos', 'action'=>'photo',$photo['Photo']['id']),
																array('class'=>'popup1','escape'=>false)) ; ?>
									</div>
									<div class="inputtext">
	
										<a href="javascript://" onclick="pop_show('caption<?php echo $photo['Photo']['id'] ?>')">
										<?php 
											if ($photo['Photo']['description'] != null) {
													$photodesc = $photo['Photo']['description'];
												} else {
													$photodesc = 'Add a description';
												}
											echo $photodesc; 
										?>
										</a>
										<div class="captionpopup" id="caption<?php echo $photo['Photo']['id'] ?>">
											<div class="close">
												<a href="javascript://" onclick="pop_hide('caption<?php echo $photo['Photo']['id'] ?>')">
													Close
												</a>
											</div>												
											<?php
												$photodesc = "" ;
												echo $this->Form->create('Photo', array('action'=>'saveDesc')) ; 
												echo $this->Form->input('id', array('type'=>'hidden','value'=>$photo['Photo']['id']));
												echo $this->Form->input('journal_id', array('type'=>'hidden','value'=>$journals['Journal']['id']));
												echo $this->Form->input('description', array(
																			'label'=>false,
																			'div'=>false,
																			'value'=>$photo['Photo']['description'],
																			'class'=>'captionInpt')) ;
												echo $this->Form->end();
											?>
											<div class="clr"></div>
										</div>
									</div>
									<?php if ($shrlvl == 2) { ?>
									<div class="chkmark">
											<?php 
												echo $this->Html->link('Make Album Cover',
																array('controller'=>'photos', 'action'=>'saveCover',$photo['Photo']['id'],$journals['Journal']['id']),
																array('escape'=>false)) ; ?>
									</div>
									<?php 
												}
											}
									?>
								</li>
								<?php 
									endforeach; 
								?>
							</ul>
							<div class="clr"></div>							
