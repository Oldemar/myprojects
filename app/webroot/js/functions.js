function finduploadlist() {
	var uploadlistcount = document.getElementsByClassName('filename');
	document.getElementsById('photoscount').innerHTML = uploadlistcount;	
	console.log(uploadlistcount);
//	photoscount
}


function Left(str, n) {
	if (n < 0) { n = parseInt(String(str).length) + n; }
	if (n == 0) {
		return;
	} else if (n > String(str).length) {
		return str;
	} else {
		return String(str).substring(0,n);
	}
}

function Right(str, n) {
	if (n < 0) { n = parseInt(int(String(str).length)) + n; }
	if (n == 0)
		return;
	else if (n > String(str).length)
		return str;
	else {
		var iLen = String(str).length;
		return String(str).substring(iLen, iLen - n);
	}
}

function doajax(type, page, target, params) {
	var xmlhttp;

	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	var target = document.getElementById(target);
	if (target == null) return;

	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			setAndExecute(target.id, xmlhttp.responseText);
			if (target.id=="results") {
				$('#'+target.id).css('left', $('#searchbar').offset().left+"px");
				$('#'+target.id).css('top', ($('#searchbar').offset().top+22)+"px");
				$('#'+target.id).css('position', 'absolute');
			}
		}
	};
	target.innerHTML = "<p style='text-align:center'>Loading...</p>";
	switch (type) {
		case "GET":
			xmlhttp.open("GET", page, true);
			xmlhttp.send();
			break;
		case "POST":
			xmlhttp.open("POST", page, true);
			//Send the proper header information along with the request
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.send(params);
			break;
	}
}

function setAndExecute(divId, innerHTML) {
	oldDiv = $('#'+divId);
	newDiv = $(oldDiv).clone();
	$(newDiv).html(innerHTML);
	$(oldDiv).replaceWith(newDiv);

	var x = $('script', newDiv);
	for(var i=0;i<x.length;i++) {
		alert('eval: '+x[i].text);
		eval(x[i].text);
	}
}

function ajaxPost(formName, formTarget, divTarget) {
	form = document.getElementById(formName);
	if (form != null) {
		first=true;
		values="";
		jQuery('#'+formName).find('input, textarea').each(function() {
			if (jQuery(this).attr("name")) {
				if (!first) { values += "&"; }
				values += jQuery(this).attr("name") + "=" + 
								(jQuery(this).attr('type')=="checkbox" ? 
									jQuery(this).attr('checked') : 
									jQuery(this).val());
				first=false;
			}
		});

		doajax("POST",formTarget,divTarget,values);
	}
}

// TODO: use the value of initial to handle rapid autopopulation of field values. then they can be filled in with ajax in realtime instead of according to a timer
function filterOptions(type, section, res) {
	val=jQuery('#'+res).val();
	switch (res.toLowerCase()) {

		case 'contactbirthcountryid':	res2 = 'ContactBirthRegionId';	break;
		case 'contactbirthregionid':	res2 = 'ContactBirthCityId';	break;

		case 'contactrescountryid':		res2 = 'ContactResRegionId';	break;
		case 'contactresregionid':		res2 = 'ContactResCityId';		break;

		case 'contactbuscountryid':		res2 = 'ContactBusRegionId';	break;
		case 'contactbusregionid':		res2 = 'ContactBusCityId';		break;
	}
	jQuery('#'+res2).parent().attr('id', res2+'_parent');

	String.prototype.capitalize = function() {
	    return this.charAt(0).toUpperCase() + this.slice(1);
	}

	initial=jQuery('#'+res).attr('init');
	region=jQuery('#'+res).attr('region');
	city=jQuery('#'+res).attr('city');
	doajax('GET', '../data?type='+type.capitalize()+'&section='+section.capitalize()+'&'+section+'_id='+val+(region?'&region='+region:'')+(city?'&city='+city:'')+'&initial='+(typeof(initial)!='undefined'?initial:0), res2+'_parent', null);
}

function css(a){
    var sheets = document.styleSheets, o = {};
    for(var i in sheets) {
        var rules = sheets[i].rules || sheets[i].cssRules;
        for(var r in rules) {
            if(a.is(rules[r].selectorText)) {
                o = $.extend(o, css2json(rules[r].style), css2json(a.attr('style')));
            }
        }
    }
    return o;
}

function css2json(css){
	var s = {};
	if(!css) return s;
	if(css instanceof CSSStyleDeclaration) {
		for(var i in css) {
			if((css[i]).toLowerCase) {
				s[(css[i]).toLowerCase()] = (css[css[i]]);
			}
		}
	} else if(typeof css == "string") {
		css = css.split("; ");          
		for (var i in css) {
			var l = css[i].split(": ");
			s[l[0].toLowerCase()] = (l[1]);
		};
	}
	return s;
}
