<?php 

Class SpecialtyCachedElementHelper extends AppHelper { 

	var $helpers = array('Form');
	function afterRender($viewFile){
		
	}
	

     
    function specialtyAutoCompleteInput($name,$hiddenName,$optionsInput=array()){
    	
    	$this->Specialty = ClassRegistry::init('Specialty');

    	$textOptions	= $this->Form->_initInputField($name);
    	$hiddenOptions	= $this->Form->_initInputField($hiddenName);
    	
    	if(!isset($optionsInput['id'])){
    		$optionsInput['id'] = $textOptions['id'];
    	}
    	
    	//$this->loadAditionalJs('jquery-ui-1.8.20.custom.min');
    	
    	$this->loadAditionalJs('jquery-ui-1.9.1.autocomplete');
    	
    	$output = '
    	<script>
    	$(function() {
    		var cache = {
    		},
    		lastXhr;
    		
			
			$("#'.$optionsInput['id'].'").autocomplete({
	    			minLength: 2,
	    			source: function( request, response ) {
	    				var term = request.term;
	    				if ( term in cache ) {
	    					response( cache[ term ] );
	    					return;
	    				}
	    			
	    				
	    				lastXhr = $.getJSON("'.$this->url('/cache/searchSpecialty').'"  , request, function( data, status, xhr ) {
	    					cache[ term ] = data;
	    					if ( xhr === lastXhr ) {
	    						response( data );
	    					}
	    				});
	    			},
	    			select: function(event, ui) { $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
	    		});
    		
    		$("#'.$optionsInput['id'].'").focus(function(){});
    		
    		$("#'.$optionsInput['id'].'").change(function(event) {
			  if (event.which == 13) {
			     event.preventDefault();
			   }else{
			   		$("#'.$hiddenOptions['id'].'").val("");
			   }
			  
			});
    	});
    	</script>';
    	
    	return $this->Form->input($name,$optionsInput).$this->Form->hidden($hiddenName).$output;
    }
} 

?>
