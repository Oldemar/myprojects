                          <div id="tab_2" style="position:relative;">
                            <div class="vprev">
                              <a href="#" id="prev2">
                                <img src="<?php echo $this->webroot ; ?>img/prevslide_icon.png" alt="" />
                              </a>
                            </div>
                            <div class="myjurnalsVideo" id="scroll3">
                              <ul>
                                <?php
                                  $totvid = 0;
                                  if (count($objJournal->Video)) {
                                    foreach ($objJournal->Video as $video):
                                      if ($video->getAttr('sharing_level') == '2') {
                                        $totvid++;
                                ?>
                                <li class="scroller_block">
                                  <?php
                                        echo $this->Html->image($video->getFullPathAndVideoName());
                                  ?>
                                </li>
                                <?php  
                                      } 
                                    endforeach;
                                  } else { 
                                ?>
                                <li class="scroller_block">
                                  <?php 
                                    echo $this->Html->image('novideoavailable.gif',array('width'=>'240','height'=>'152')) ; 
                                  ?>
                                </li>
                                  <?php 
                                  } 
                                  ?>
                              </ul>
                              <div class="clr"></div>
                            </div>
                            <div class="vnext">
                              <a href="#" id="next2">
                                <img src="<?php echo $this->webroot ; ?>img/nextslide_icon.png" alt="" />
                              </a>
                            </div>
                            <?php 
                              if ($totvid > 1 ) { 
                            ?>
                            <script language="JavaScript" type="text/JavaScript" src="<?php echo $this->webroot ; ?>js/jquery.jcarousel-all.js">
                            </script>
                            <script>
                                  $(function() {
                                    $("#scroll3").jcarousel({
                                    btnNext: "#next2",
                                    btnPrev: "#prev2",
                                    visible:1,
                                    auto:4000,
                                    scroll:1
                                    });
                                  });
                            </script>
                            <?php 
                              }else {
                            ?>
                            <span>
                            <?php 
								echo $this->Html->image($photocover,array('width'=>'140'));
								}
							?>
							</span>	
                          </div>
