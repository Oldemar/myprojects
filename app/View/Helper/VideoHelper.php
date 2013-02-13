<?php 
/* 
        Flow Player Helper (free video player) 
        Requed helpers HTML, Javascript 
*/ 
Class VideoHelper extends AppHelper { 

var $helpers = array('Html', 'Javascript'); 
     
    function loader($loadcss=false) { 
        $out=$this->Javascript->link('flowplayer-3.2.11.min'); 
        if ($loadcss=true) $out.=$this->Html->css('flash'); 
        return $this->output($out); 
         
    }     
     
    function player ($file, $div, $autoplay=false, $width=400, $height=290 ) { 
         
        if ($autoplay=True) {$autoplay="true";} else $autoplay="false"; 
        $out=' 
        <script> 
    window.onload = function() {   
         flashembed("'.$div.'",              
            { 
                src:"<?php echo $this->webroot; ?>swf/flowplayer-3.2.12.swf", 
                width: '.$width.',  
                height: '.$height.' 
            }, 
             
            {config: {    
                autoPlay:'.$autoplay.', 
                controlBarBackgroundColor:"0x2e8860", 
                initialScale: "scale", 
                videoFile: "'.$file.'" 
            }}  
        ); 
    } 
    </script>     
        '; 
        return $this->output($out); 
    } 
} 

?>