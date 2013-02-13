													<div id="fAllowed">
														<div class="friendboxbar">
															<div class="headtxtBg">Friends</div>							

															<?php
															foreach ($friendlist as $usr) :
																$disp = ($usr['User']['allowed']==0?'display:none;':'display:block;');
																$usrAllowed = ($usr['User']['allowed']==1?'usrAllwd':'');
															
																$grps = $grpBxs ="";

																if (isset($usr['User']['GroupsUser']) && !is_null($usr['User']['GroupsUser'])) {
																	foreach ($usr['User']['GroupsUser'] as $grp) {
																		$grps .= "grp_".$grp['group_id']." ";
																		$grpBxs .= "grpBxs_".$grp['group_id']." ";
																	}
																	
																}
																if ($grps != "") $grps = "allGrps " . $grps ;
															?>

																	<div class="usrImgCntnr allFrnds <?php echo $grps. ' ' . $usrAllowed ; ?>" id="allowedUsr<?php echo $usr['User']['id']; ?>" style="<?php echo $disp; ?>">
																		<div class="usrImgbgbox">
																		<?php 
																			if ( isset( $usr['User']['Picture']['w90'] ) && ( $usr['User']['Picture']['w90'] != null ) ) {
																				echo $this->Html->image($usr['User']['Picture']['url'].$usr['User']['Picture']['w90'],array('width'=>'90', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ; 
																			} else {
																				echo $this->Html->image('nopicture.gif',array('width'=>'90', 'url' => array('controller' => 'users', 'action' => 'profile', $usr['User']['id']))) ;
																			}
																		?>
																		</div>
																		<?php 
																			echo $this->Html->link($usr['User']['firstname']. " " .substr($usr['User']['lastname'],0,1).'.', 
																								array('controller' => 'users', 'action' => 'profile', $usr['User']['id'])) ; 
																		?>
																		<div class="allbxFrnds <?php echo ($grps != ""?'allBxGrps '.$grpBxs:''); ?>">
																		<?php
																			echo $this->Form->checkbox('fsharing.'.$usr['User']['id'], array('id'=>'uchkbxf'.$usr['User']['id'],'checked'=>($usr['User']['allowed']==1?'checked':'')
																						));
																		?>
																		</div>
																	</div>
																	<script type="text/javascript">
																	$(document).ready(function(){

																		// Add onclick handler to checkbox w/id checkme
																	   $("#<?php echo 'uchkbxf'.$usr['User']['id']; ?>").click(function(){
																		// If checked
																		if (!$("#<?php echo 'uchkbxf'.$usr['User']['id']; ?>").is(":checked"))
																		{
																			//show the hidden div
																			$("#<?php echo 'allowedUsr'.$usr['User']['id']; ?>").css("display","none");
																			$("#<?php echo 'selUsr'.$usr['User']['id']; ?>").css("display","block");
																			$("#fsharing").show("fast");
																			$("#liAllGrp").show("fast");
																			
																		}
																	  });
								
																	});
																 
																</script>											
																															
														<?php 
																endforeach;
														?>
														</div>
													</div>

