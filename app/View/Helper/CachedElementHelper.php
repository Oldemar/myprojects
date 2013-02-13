<?php 

Class CachedElementHelper extends AppHelper {

	var $helpers = array('Form','Html');



	 
	function cityAutoCompleteInput($name,$hiddenName,$optionsInput=array()){
		$this->City = ClassRegistry::init('City');

		 
		$arrCity	= $this->City->getCitiesForSmartCache();
		$smartCity	= $this->City->prepareResultsForAutocomplete($arrCity);

		$textOptions	= $this->Form->_initInputField($name);
		$hiddenOptions	= $this->Form->_initInputField($hiddenName);


		$this->loadAditionalJs('jquery-ui-1.9.1.autocomplete');

		 
		if(!isset($optionsInput['id'])){
			$optionsInput['id'] = $textOptions['id'];
		}
		
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
				
				 
				lastXhr = $.getJSON("'.$this->url('/cache/searchCity').'"  , request, function( data, status, xhr ) {
					cache[ term ] = data;
					if ( xhr === lastXhr ) {
					response( data );
				}
				});
				},
				select: function(event, ui) { $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
				});
				
				$("#'.$optionsInput['id'].'").focus(function(){});
				
				$("#'.$optionsInput['id'].'").keypress(function(event) {
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

	function edulevelAutoCompleteInput($name,$hiddenName,$optionsInput=array()){

		$this->Edulevel = ClassRegistry::init('Edulevel');



		$textOptions	= $this->Form->_initInputField($name);
		$hiddenOptions	= $this->Form->_initInputField($hiddenName);

		if(!isset($optionsInput['id'])){
			$optionsInput['id'] = $textOptions['id'];
		}
		
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
		
			
		lastXhr = $.getJSON("'.$this->url('/cache/searchEdulevel').'"  , request, function( data, status, xhr ) {
		cache[ term ] = data;
		if ( xhr === lastXhr ) {
		response( data );
		}
		});
		},
		select: function(event, ui) { $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
		});
		
		$("#'.$optionsInput['id'].'").focus(function(){});
		
		$("#'.$optionsInput['id'].'").keypress(function(event) {
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
	
	
	function instituteAutoCompleteInput($name,$hiddenName,$optionsInput=array()){
	
		$this->Edulevel = ClassRegistry::init('Edulevel');
	
	
	
		$textOptions	= $this->Form->_initInputField($name);
		$hiddenOptions	= $this->Form->_initInputField($hiddenName);
	
		if(!isset($optionsInput['id'])){
			$optionsInput['id'] = $textOptions['id'];
		}
		
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
		
			
		lastXhr = $.getJSON("'.$this->url('/cache/searchInstitute').'"  , request, function( data, status, xhr ) {
		cache[ term ] = data;
		if ( xhr === lastXhr ) {
		response( data );
		}
		});
		},
		select: function(event, ui) { $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
		});
		
		$("#'.$optionsInput['id'].'").focus(function(){});
		
		$("#'.$optionsInput['id'].'").keypress(function(event) {
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
	
	/**
    * Returns the img element with the userProfile Picture
    * @param: UserId
    */
	function userProfileImage($userId, $sizeName='40',$extraParams = array()){
		//$cacheName = 'ProfilePicture'.$userId.$sizeName;
		//if($fromCache = Cache::read($cacheName,'1 week')){
			//return $fromCache;
		//}
		
		ClassRegistry::removeObject('User');
		$this->User = ClassRegistry::init('User');
		
		$result = $this->Html->image($this->User->getProfileImagePath($sizeName,$userId),$extraParams);
		//Cache::write($cacheName,$result,'1 week');
		
		
		return $result;
	}
	
	/**
	* AutoComplete Helper for ActivityType
	**/
	function activityAutoCompleteInput($name,$hiddenName,$optionsInput=array()){
		$this->Area = ClassRegistry::init('Area');

		 
		//$arrCity	= $this->City->getCitiesForSmartCache();
		//$smartCity	= $this->City->prepareResultsForAutocomplete($arrCity);

		$textOptions	= $this->Form->_initInputField($name);
		$hiddenOptions	= $this->Form->_initInputField($hiddenName);

		
		$this->loadAditionalJs('jquery-ui-1.9.1.autocomplete');

		 
		if(!isset($optionsInput['id'])){
			$optionsInput['id'] = $textOptions['id'];
		}
		
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
				
				 
				lastXhr = $.getJSON("'.$this->url('/cache/searchActivity').'"  , request, function( data, status, xhr ) {
					cache[ term ] = data;
					if ( xhr === lastXhr ) {
					response( data );
				}
				});
				},
				select: function(event, ui) {  $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
				});
				
				$("#'.$optionsInput['id'].'").focus(function(){});
				
				$("#'.$optionsInput['id'].'").keypress(function(event) {
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
	
	
	/**
	 * AutoComplete Helper for ActivityType
	 **/
	function groupAutoCompleteInput($name,$hiddenName,$optionsInput=array()){
	
		$textOptions	= $this->Form->_initInputField($name);
		$hiddenOptions	= $this->Form->_initInputField($hiddenName);
	
	
		$this->loadAditionalJs('jquery-ui-1.9.1.autocomplete');
	
			
		if(!isset($optionsInput['id'])){
			$optionsInput['id'] = $textOptions['id'];
		}
	
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
				
					
				lastXhr = $.getJSON("'.$this->url('/cache/searchGroup').'"  , request, function( data, status, xhr ) {
				cache[ term ] = data;
					if ( xhr === lastXhr ) {
						response( data );
					}
				});
				},
				select: function(event, ui) {  $("#'.$hiddenOptions['id'].'").val(ui.item.id);}
				});
				
				$("#'.$optionsInput['id'].'").focus(function(){});
				
				$("#'.$optionsInput['id'].'").keypress(function(event) {
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