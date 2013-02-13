<!-- Start right container -->
<div id="videoLghtBox">
	<div class="rgtCntrleft" style="width: 980px; height:510px; background: #000; padding: 0px">
		<div style="float:right; width:410px; padding-top:10px; height:500px; border-left: 1px solid #333">
			<div id="divComments" style="float: right; max-height: 490px; overflow-y: auto; width:400px"></div>
		
		</div>
		<div style="width:550px">	
			<!--Start event Box-->
			<div id="galleria" style="height:420px;">
			</div><!-- 467 -->
			<div id="divDescription" style="padding-left: 15px; display: block;font-size: 14px; font-weight: bold;"> </div>
					
		    <script>
		
		    // Load the classic theme
		    Galleria.loadTheme('<?php echo str_replace('//','/',$this->webroot.'js/galleria/galleria.classic.js'); ?>');
	
		    var dataPre = <?php echo $videoJson; ?>;
		    
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
			        this.loadNext = function(objVideo){
			        	$.ajax({
			    			  url: "<?php echo str_replace('//','/',$this->webroot."videos/loadVideo/");?>"+objVideo.journalId+"/"+objVideo.id,
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
				 			
				 			objVideo = this.getData();
				 			objG = this;
				 			
				 			$.ajax({
				    			  url: "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'listVideoCommentAjax')) ?>/"+this.getData().id,
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
		    					
		</div>
	</div>
	<div class="clr"></div>
</div>
<!-- End right container -->
  
