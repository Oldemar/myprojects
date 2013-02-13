function clearText(thefield) {
  if (thefield.defaultValue==thefield.value) { thefield.value = "" }
} 
function replaceText(thefield) {
  if (thefield.value=="") { thefield.value = thefield.defaultValue }
}

function pop_show(d)
{
  document.getElementById(d).style.display='block';
  
}
function pop_hide(d)
{
  document.getElementById(d).style.display='none';  
}

function pop_show_hide(d)
{
	if(document.getElementById(d).style.display == 'block'){
		document.getElementById(d).style.display='none';
	}else{
		document.getElementById(d).style.display='block';
	}
			
  
}




function fp_show(tab,cls) 
{
 i=1;
 
 while (document.getElementById("tab_"+i))
  {
  document.getElementById("tab_"+i).style.display='none';
  document.getElementById("a"+i).className='';
  i++;
  
  }
  document.getElementById(tab).style.display='block';
  document.getElementById(cls).className='sel';
}

function fp_hide(cab,tls) 
{
 i=1;
 
 while (document.getElementById("cab_"+i))
  {
  document.getElementById("cab_"+i).style.display='none';
  document.getElementById("b"+i).className='';
  i++;
  
  }
  document.getElementById(cab).style.display='block';
  document.getElementById(tls).className='sel';
}

function clrText(thefield) {
  if (thefield.defaultValue==thefield.value) { thefield.value = "" }
} 
function replText(thefield) {
  if (thefield.value=="") { thefield.value = thefield.defaultValue }
}

function inptborder_show(k)
{
  document.getElementById(k).style.border='1px solid #fff';
  
}
function inptborder_hide(k)
{
  document.getElementById(k).style.border='1px solid #cbd2d9';  
}

function tabhide_show(tab,img)
{
 if(document.getElementById(tab).style.display=='block')
 {
  document.getElementById(tab).style.display='none';
  document.getElementById(img).src='images/pluse_icon.jpg';
 }
 else
 {
  document.getElementById(tab).style.display='block';
  document.getElementById(img).src='images/mines_icon.jpg';
 }
}

function select_show(s)
{
 

  if(document.getElementById(s+"vr").value=='0')
  {
  document.getElementById(s).style.display='block';
  document.getElementById(s+"vr").value = '1';
  }
  else
  {
  document.getElementById(s).style.display='none';
  document.getElementById(s+"vr").value = '0';
  }
  
}
function select_hide(s)
{
  document.getElementById(s).style.display='none';  
  
}

function enableBeforeUnload(msg) {
	window.onbeforeunload = function (e) {
    	return msg;
	};
}

function disableBeforeUnload() {
    window.onbeforeunload = null;
}


// ----- Begin: /Users/edit.ctp -----
function popup(obj, act) {
	target = $($(obj).parent().children()[0]);
	switch (act) {
		case 0:
			if (obj.value == '') replaceText(obj);
			//setTimeout("popup(null, '0b')", 250);
			break;
		case '0b':
			$('#popupBox').remove();
			break;
		case 1:
			if (!$('#popupBox').length) {
				clearText(obj);
				box = document.createElement('div');
				$(box).css( { 
					'z-index':10, 
					'background-color':'red', 
					'margin-top':($(obj).offset().top - $(obj).parent().offset().top + $(obj).outerHeight())+'px', // Difference in offsets represents total space to skip, then add element height 
					'position':'absolute', 
					'max-height':'300px', 
					'overflow-y':'scroll' 
				} );
				$(obj).parent().prepend(box);
				box.id = 'popupBox';
				// Allow popup box to be clickable without hiding it. Necessary for scroll 
				$(obj).click(function(event) { event.stopPropagation(); });
				$('html').click(function() { popup(null, '0b'); });
			} else {
				popupKey(obj);
			}
			break;
		case 2:
			doajax('GET', '../data', target, null);
			break;
	}
}

function popupKey(obj) {
	doajax('GET', '../data?'+obj.id+'='+obj.value, 'popupBox', null);
}
// ----- End: /Users/edit.ctp -----
