/* 
!!! YOUR ATTENTION PLEASE !!!
Linking directly to this file will not work (hotlinking not allowed) and may result in a blank page appearing.
All necessary code is included in download files.
*/

//  dw_event.js version date Oct 2009
var dw_Event={add:function(obj,etype,fp,cap){cap=cap||false;if(obj.addEventListener)obj.addEventListener(etype,fp,cap);else if(obj.attachEvent)obj.attachEvent("on"+etype,fp);},remove:function(obj,etype,fp,cap){cap=cap||false;if(obj.removeEventListener)obj.removeEventListener(etype,fp,cap);else if(obj.detachEvent)obj.detachEvent("on"+etype,fp);},DOMit:function(e){e=e?e:window.event;if(!e.target)e.target=e.srcElement;if(!e.preventDefault)e.preventDefault=function(){e.returnValue=false;return false;};if(!e.stopPropagation)e.stopPropagation=function(){e.cancelBubble=true;};return e;},getTarget:function(e){e=dw_Event.DOMit(e);var tgt=e.target;if(tgt.nodeType!=1)tgt=tgt.parentNode;return tgt;}};

// dw_cookies.js version date: Nov 2009
var dw_Cookie={set:function(name,value,days,path,domain,secure){var date,expires;if(typeof days=="number"){date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));expires=date.toGMTString();}document.cookie=name+"="+encodeURI(value)+((expires)?"; expires="+expires:"")+((path)?"; path="+path:"")+((domain)?"; domain="+domain:"")+((secure)?"; secure":"");},get:function(name){var c,cookies=document.cookie.split(/;\s/g);for(var i=0;cookies[i];i++){c=cookies[i];if(c.indexOf(name+'=')===0){return decodeURI(c.slice(name.length+1,c.length));}}return null;},del:function(name,path,domain){if(dw_Cookie.get(name)){document.cookie=name+"="+((path)?"; path="+path:"")+((domain)?"; domain="+domain:"")+"; expires=Thu, 01-Jan-70 00:00:01 GMT";}}};

// dw_misc.js
var dw_Util;if(!dw_Util)dw_Util={};dw_Util.trimString=function(str){var re=/^\s+|\s+$/g;return str.replace(re,"");};dw_Util.normalizeString=function(str){var re=/\s\s+/g;return dw_Util.trimString(str).replace(re," ");};dw_Util.addClass=function(el,cl){el.className=dw_Util.trimString(el.className+' '+cl);};dw_Util.removeClass=function(el,cl){el.className=dw_Util.normalizeString(el.className.replace(cl," "));};dw_Util.hasClass=function(el,cl){var re=new RegExp("\\b"+cl+"\\b","i");if(re.test(el.className)){return true;}return false;};dw_Util.preloadImg=function(){for(var i=0;arguments[i];i++){var img=new Image();img.src=arguments[i];}};dw_Util.getElementsByClassName=function(sClass,sTag,oCont){var result=[],list,i;var re=new RegExp("\\b"+sClass+"\\b","i");oCont=oCont?oCont:document;if(document.getElementsByTagName){if(!sTag||sTag=="*"){list=oCont.all?oCont.all:oCont.getElementsByTagName("*");}else{list=oCont.getElementsByTagName(sTag);}for(i=0;list[i];i++)if(re.test(list[i].className))result.push(list[i]);}return result;};function doLicensingAlert(){if(!arguments.callee.stopNag){arguments.callee.stopNag=true;alert('A license is required for all but personal use of this code.\nPlease adhere to our Terms of Use if you use dyn-web code.');}};function setupLicensingAlert(){if(document.getElementsByTagName){var lnks=document.getElementsByTagName("A");for(var i=0;lnks[i];i++){if(dw_Util.hasClass(lnks[i],"nag"))dw_Event.add(lnks[i],'click',doLicensingAlert);}}};dw_Event.add(window,'load',setupLicensingAlert);function setTargetBlank(){if(document.getElementsByTagName){var lnks=document.getElementsByTagName("A");if(lnks&&lnks[0]&&lnks[0].getAttribute){for(var i=0;lnks[i];i++){if(lnks[i].getAttribute("href")&&lnks[i].className=="blank")lnks[i].target="_blank";}}}};function stripeDocsTable(){var tbl_list=dw_Util.getElementsByClassName('docs','table');for(var i=0;tbl_list[i];i++){var rows=tbl_list[i].getElementsByTagName('tr');for(var j=0;rows[j];j++){if(j>0&&j%2==0){dw_Util.addClass(rows[j],'odd');}}}};function getTextArea(name,rows,cols){var str='<textarea name="'+name+'" id="'+name+'" cols="'+cols+'" rows="'+rows+'"></textarea>';document.write(str);};function getTextInput(name,size){var str='<input type="text" size="'+size+'" name="'+name+'" id="'+name+'" />';document.write(str);};function getSubmitButton(){var str='<input name="submit" id="submit" type="submit" value="Submit" />';document.write(str);};function noSpamEmail(txt){var address='<a class="mail" href="'+'ma'+'il'+'to:'+'contact_01'+'&#64;'+'dyn-web.com'+',shp_dynweb'+'&#64;'+'yahoo.com">'+txt+'<\/a>';document.write(address);};function addLoadEvent(func){var oldQueue=window.onload?window.onload:function(){};window.onload=function(){oldQueue();func();}};