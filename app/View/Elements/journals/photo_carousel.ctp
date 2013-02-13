                          <div id="tab_1" style="position:relative;">
                            <div class="vprev">
                              <a href="#" id="prev1" class="jcarousel-prev">
                                <img src="<?php echo $this->webroot ; ?>img/prevslide_icon.png" alt="" />
                              </a>
                            </div>
                            <div class="myJournalsPicture" id="scroll2">
                              <ul>
                                <?php
                                  $totpht = 0;
                                  if (count($objJournal->Photo)) {
                                    foreach ($objJournal->Photo as $photo):
                                      if ($photo->getAttr('sharing_level') == '2') {
                                        $totpht++;
                                ?>
                                <li class="scroller_block">
                                  <?php
                                    echo $this->Html->image($photo->getAttr('url').$photo->getAttr('w240'));
                                  ?>
                                </li>
                                <?php
                                      }
                                    endforeach;
                                  } else { 
                                ?>
                                <li class="scroller_block">
                                  <?php 
                                    echo $this->Html->image('nophotoavailable.jpg', array('width'=>'240','height'=>'152'))  
                                  ?>
                                </li>
                                <?php 
                                  } 
                                ?>
                              </ul>
                            </div>
                            <div class="vnext jcarousel-next">
                              <a  class="jcarousel-next">
                                <img src="<?php echo $this->webroot ; ?>img/nextslide_icon.png" alt="" />
                              </a>
                            </div>
                            <?php 
                              if ($totpht > 1 ) { 
                            ?>
                            <script type="text/javascript">
                              $(function() {
                                $('#scroll2').jcarousel({
                                  scroll:1, 
                                  wrap: 'circular',
                                  vertical: true,
                                  animating: true
                                  }).jcarouselAutoscroll({
                                    autostart: 'true'
                                  })
                                  .hover(function() {
                                    $(this).jcarouselAutoscroll('stop');
                                  }, function() {
                                    $(this).jcarouselAutoscroll('start');
                                  });
                                  $('.jcarousel-prev').jcarouselControl({
                                    target: '-=1'
                                  });
                                  $('.jcarousel-next').jcarouselControl({
                                    target: '+=1'
                                  });
                              });
                            </script>
                            <?php 
                              } else {
                            ?>
                            <span>
                            <?php 
								echo $this->Html->image($photocover,array('width'=>'140'));
								}
							?>
							</span>	                         
							</div>
