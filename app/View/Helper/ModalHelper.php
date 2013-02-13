<?php 

Class ModalHelper extends AppHelper {
		
	var $helpers = array('Form','Html');
	
	public function displayAction($linkId, $arrUrl , $modalTitle='Living Alpha Message',$button1='', $button2=''){
		$modelId = "modal".$linkId;
		
		$htmlFooter = '';
		if(strlen($button1) || strlen($button2)){
			$htmlFooter .= '<div class="modal-footer">';
		}
		
		if(strlen($button1)){
			$htmlFooter .= $button1;
		}
		
		if(strlen($button2)){
			$htmlFooter .= $button2;
		}
		
		if(strlen($button1) || strlen($button2)){
			$htmlFooter .= '</div>';
		}
		
		$return = '
		<script>
		$("#'.$linkId.'").click(function(){
		
			if($("#'.$modelId.'").length > 0 ){
			
						$(\'#'.$modelId.'\').modal({show:true});
			}else{
			
					$.get("'.$this->Html->url($arrUrl).'", function(data) {
							$(\'body\').append(\'<div id="'.$modelId.'" class="modal" style="display:none;"><div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button><b>'.$modalTitle.'</b></div><div class="modal-body">\'+data+\'</div>'.$htmlFooter.'</div>\');
							$(\'.modal-backdrop, .modal-backdrop.fade.in\').css(\'opacity\', 0.6);
							$(\'#'.$modelId.'\').modal({show:true});
					});
			}
			
			
		});
		</script>
		';
		
		return $return;
	}
	
	public function photoUpload($linkId, Journal $objJournal, $sharingLevel, $onCompleteDivId=""){
		$modelId = "modal".$linkId;
		$modalTitle = "Add Photos";
		
		$this->loadAditionalCss('bootstrap.components.alert');
		
		$arrUrl = array('controller'=>'photos','action'=>'uploadBoxModalBody',$modelId,$objJournal->getID(),$sharingLevel,$onCompleteDivId);
	
		$htmlFooter =  '<div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button></div>';
		
		$body = '$(\'body\').append(\'<div id="'.$modelId.'" class="modal" style="display:none;"><div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button><b>'.$modalTitle.'</b></div><div class="modal-body">Loading</div>'.$htmlFooter.'</div>\');';
		$ajax = '$.get("'.$this->Html->url($arrUrl).'", function(data) {$(\'#'.$modelId.' .modal-body\').html(data);});';
		
		$return = '
		<script>
		$(document).ready(function(){		
				'.$body.'
				'.$ajax.'
				$("#'.$modelId.'").bind("refreshBody",function(){'.$ajax.'});		
		});
		$("#'.$linkId.'").click(function(){
	
			if($("#'.$modelId.'").length > 0 ){
				$(\'#'.$modelId.'\').modal({show:true});
				$(\'#'.$modelId.' .modal-footer\').replaceWith(\''.$htmlFooter.'\'); 
			}
		
		});
		
										
		</script>
		';
		
	
		return $return;
	}
	
	public function videoUpload($linkId, Journal $objJournal, $sharingLevel, $onCompleteDivId=""){
		$modelId = "modal".$linkId;
		$modalTitle = "Add Videos";
	
		$this->loadAditionalCss('bootstrap.components.alert');
	
		$arrUrl = array('controller'=>'videos','action'=>'uploadBoxModalBody',$modelId,$objJournal->getID(),$sharingLevel,$onCompleteDivId);
	
		$htmlFooter =  '<div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button></div>';
	
		$body = '$(\'body\').append(\'<div id="'.$modelId.'" class="modal" style="display:none;"><div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button><b>'.$modalTitle.'</b></div><div class="modal-body">Loading</div>'.$htmlFooter.'</div>\');';
		$ajax = '$.get("'.$this->Html->url($arrUrl).'", function(data) {$(\'#'.$modelId.' .modal-body\').html(data);});';
	
		$return = '
		<script>
		$(document).ready(function(){
				'.$body.'
				'.$ajax.'
				$("#'.$modelId.'").bind("refreshBody",function(){'.$ajax.'});
		});
		$("#'.$linkId.'").click(function(){
	
			if($("#'.$modelId.'").length > 0 ){
				$(\'#'.$modelId.'\').modal({show:true});
				$(\'#'.$modelId.' .modal-footer\').replaceWith(\''.$htmlFooter.'\');
			}
	
		});
		</script>
		';
	
		return $return;
	}
		
}

?>