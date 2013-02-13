
<!--Start middle Container-->
<div id="middleCntr">	
	<!-- Start content container -->
	<div id="contentCntr">
		<div>			
			<!-- Start of Profile Left bar -->	
			<div id="leftCntr">
				<?php echo $this->element('profile/profile_image'); ?>
				<?php echo $this->element('profile/alphaworldmap'); ?>
				<?php echo $this->element('profile/side_navigation'); ?>


			</div>
			<!-- End of Profile Left bar -->	
			<!-- Start right container -->
			<div id="rightCntr">
				<div class="rgtCntrleft">	
					<!--Start event Box-->
					<div id="galleria" style="height:380px;">
					</div><!-- 467 -->
					<div id="divDescription" style="display: block;font-size:16px;text-align:center"> </div>
					
					<div id="divComments"></div>
					
				    <script>
				
				    // Load the classic theme
				    Galleria.loadTheme('<?php echo str_replace('//','/',$this->webroot.'/js/galleria/galleria.classic.js'); ?>');

				    var dataPre = <?php echo $photoJson; ?>;
				    
				    var tmpIds = [];
				    var tmpIdsLoaded = [];
				    
				    for(var i in dataPre){
				    	tmpIds.push(dataPre[i].id);
				    }
				    
				    
				    // Initialize Galleria
				    Galleria.run('#galleria',{
				        dataSource: dataPre,
				        extend: function(){
					        var gallery = this;
					        this.loadNext = function(objPhoto){
					        	$.ajax({
					    			  url: "<?php echo str_replace('//','/',$this->webroot."/photos/loadPhoto/");?>"+objPhoto.journalId+"/"+objPhoto.id,
					    			  dataType: 'json',
					    			  type: "GET",
					    			  success: function(data,textStatus,xhr){
					    			  		for(var i in data){
							        			if(jQuery.inArray(data[i].id, tmpIds) != -1){
									        	}else{
							        				gallery.push(data[i]);
							        				tmpIds.push(data[i].id);
							        			}	
							        		}	
						   			  }
								});
					        	/** $.getJSON("<?php echo str_replace('//','/',$this->webroot."/photos/loadPhoto/");?>"+objPhoto.journalId+"/"+objPhoto.id,
			        	        function(data){
					        		for(var i in data){
					        			if(jQuery.inArray(data[i].id, tmpIds) != -1){
							        	}else{
					        				gallery.push(data[i]);
					        				tmpIds.push(data[i].id);
					        			}	
					        		}
			        	        });*/
						        
					        }
					        
					        this.divDescription= function(){return $('#divDescription');}
					        this.divComments= function(){return $('#divComments');}
					        
					        this.bind('loadfinish', function(e) {
					            this.$('loader').fadeOut(100);
					            if(this.getData().description == ''){
					            	this.divDescription().hide();
					            }else{
					            	this.divDescription().html(this.getData().description);
					            	this.divDescription().show();
					            }
					   		 	this.divComments().html(this.getData().comments_html);
					   		 	
						   		
						 			if(jQuery.inArray(this.getData().id, tmpIdsLoaded) != -1){
							        }else{
							        	this.loadNext(this.getData());
							            tmpIdsLoaded.push(this.getData().id);
						 			}	
						 			
						 			objPhoto = this.getData();
						 			objG = this;
						 			
						 			$.ajax({
						    			  url: "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'listCommentAjax')) ?>/"+this.getData().id,
						    			  dataType: 'json',
						    			  type: "GET",
						    			  photoId:this.getData().id,
						    			  objGalleria:objG,
						    			  success: function(ajaxReturn,textStatus,xhr){
						    			  		if(this.objGalleria.getData().id == ajaxReturn.id){
								 					$('.commentDetail').replaceWith(ajaxReturn.comments_html);
								 					this.objGalleria.getData().comments_html = ajaxReturn.comments_html;
								 				}	
							   			  }
									});
						 			
					            
					        });    
				        }
				    });
				    </script>
				    
					<br><br>
					<?php echo $this->Html->link($backLinkArray['title'], $backLinkArray['arrLink'] ,array('class'=>'next_button')) ?>
													
					
				</div>
				<!-- Start rgtCntrright -->
					<?php echo $this->element('profile/profile_right_column'); ?>
				<!-- End rgtCntrright -->																	
			</div>
			<div class="clr"></div>
			<!-- End right container -->
			</div>

		</div>
	<!-- End content container -->
</div>
  
