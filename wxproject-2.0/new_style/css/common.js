
var httpurl = "/Public/ServiceHandler.ashx"; 
var sPop = null;
var postSubmited = false;
var smdiv = new Array();

var userAgent = navigator.userAgent.toLowerCase();
var is_webtv = userAgent.indexOf('webtv') != -1;
var is_kon = userAgent.indexOf('konqueror') != -1;
var is_mac = userAgent.indexOf('mac') != -1;
var is_saf = userAgent.indexOf('applewebkit') != -1 || navigator.vendor == 'Apple Computer, Inc.';
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko' && !is_saf) && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ns = userAgent.indexOf('compatible') == -1 && userAgent.indexOf('mozilla') != -1 && !is_opera && !is_webtv && !is_saf;
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera && !is_saf && !is_webtv) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);

function ctlent(event, clickactive) {
	if(postSubmited == false && (event.ctrlKey && event.keyCode == 13) || (event.altKey && event.keyCode == 83) && document.getElementById('postsubmit')) {
		if(in_array(document.getElementById('postsubmit').name, ['topicsubmit', 'replysubmit', 'editsubmit', 'pmsubmit']) && !validate(document.getElementById('postform'))) {
			doane(event);
			return;
		}
		postSubmited = true;
		if(!isUndefined(clickactive) && clickactive) {
			document.getElementById('postsubmit').click();
			document.getElementById('postsubmit').disabled = true;
		} else {
			document.getElementById('postsubmit').disabled = true;
			document.getElementById('postform').submit();
		}
	}
}
//给window.onload 附加函数
function addLoadEvent(func) {
            var oldonload = window.onload;
            if (typeof window.onload != 'function') {
                window.onload = func;
            } 
            else {
                window.onload = function() {
                  oldonload();
                  func();
                }
            }
        }
//动态给form.onsubmit 附加函数
function addOnFormSubmitEvent(formobj,func) {
            var oldsubmit = formobj.onsubmit;
            if (typeof formobj.onsubmit != 'function') {
               formobj.onsubmit = func;
            } 
            else {
                formobj.onsubmit = function() {
                  oldsubmit();
                  func();
                }
            }
        }
//给window.onunload 附加函数
function addUnloadEvent(func) {
            var oldunload = window.onunload;
            if (typeof window.onunload != 'function') {
                window.onunload = func;
            } 
            else {
                window.onunload = function() {
                  oldunload();
                  func();
                }
            }
        }
//实现超链接效果的打开新窗口

function newWindow(url,target)
  { 
    var formObj = document.createElement("form"); 
    var pindex = url.indexOf('?');
    formObj.action=pindex>-1?url.substring(0,pindex):url;
     
    //组织参数
    var urlparams = url.substring(pindex+1);
    if(urlparams.length>0)
    {
        var arrparams = urlparams.split('&');
        for(var i=0; i<arrparams.length; i++)
         {
          if(arrparams[i].indexOf('=')>-1)
           {
            var key =arrparams[i].substring(0, arrparams[i].indexOf('='));
            var value = arrparams[i].substring(arrparams[i].indexOf('=')+1);
            var dataobj = document.createElement("input"); 
            dataobj.type = 'hidden';
            dataobj.name = key;
            dataobj.id = key;
            dataobj.value = value;
            formObj.appendChild(dataobj); 
           }
         }
     }
    formObj.target = target?target:'_self'; 
    document.documentElement.appendChild(formObj); 
    formObj.submit(); 
  }
  function $(id)
 {
   return document.getElementById(id);
 }
function $S(id)
 {
   return document.getElementById(id).style;
 }
//获取事件对象
function  GetEventObj() 
{          
      if(document.all) return window.event; 
      func=GetEventObj.caller; 
      while(func!=null) 
      {  
        var arg0=func.arguments[0]; 
        if(arg0) 
          { 
           if(arg0.constructor==Event||arg0.constructor==MouseEvent)  
            {
             return   arg0; 
            }
          } 
        func=func.caller; 
      } 
      return null; 
} 
/*--------------解决F5刷新重复提交页面事件的问题（慎用）---------------------*/
function FreshKeyDown(){
 //alert(event.keyCode);
  if ((event.keyCode==116)|| //屏蔽 F5 刷新键


(event.ctrlKey && event.keyCode==82)){ //Ctrl + R
window.location.href = window.location.href;
event.keyCode=0;
event.returnValue=false;
}

}

/*--屏蔽回车键------------------------------------*/
function EnterKeyDown(){
// alert(event.keyCode);
// 
      if (event.keyCode==13){ 
    event.keyCode=0;
    event.returnValue=false;
    }
}

//document.onkeydown=FreshKeyDown;

function storeCaret(textEl){
	if(textEl.createTextRange){
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}
function checkall(form, prefix, checkallp) {
	var checkalli = checkallp ? checkallp : 'chkall';
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if(e.name != checkalli && (!prefix || (prefix && e.name.match(prefix)))) {
			e.checked = form.elements[checkalli].checked;
		}
	}
}
var StringHelper = function()
{};
//把字符串解码转换成数组
StringHelper.StringtoArray = function(strStringLine)
{
	if ( strStringLine == undefined )
	{
		throw new Error(L_NullArgumentsException);
	}
	var index = strStringLine.lastIndexOf('@');
	if ( index == -1 )
	{
		if ( strStringLine.length == 0 )
		{
			return [];
		}
		else
		{
			var result = new Array(1);
			result[0] = strStringLine;
			return result;
		}
	}
	var strLengthLine = strStringLine.substring(index+1);
	var aryLength = strLengthLine.split(':');
	var list = new Array(aryLength.length);
	var start = 0;
	for ( var i=0 ; i < list.length ; ++i )
	{
		var length = parseInt(aryLength[i]);
		list[i] = strStringLine.substr(start, length);
		start += length;
	}
	return list;
};
//把数组组装为字符串 
StringHelper.ArraytoString = function()
{
	if ( arguments.length == 0 )
	{
		throw new Error('Must have parameters for call me.');
	}
	var args = arguments;
	if ( args.length == 1)
	{
		args = arguments[0];
		if ( args.length == 0 )
		{
			return '';
		}
	}
	var strLengthLine = '';
	var strStringLine = '';
	for ( var i=0 ; i < args.length ; i++ )
	{
		var str = '' + args[i];
		strLengthLine += ':' + str.length;
		strStringLine += str;
	}
	return strStringLine + '@' + strLengthLine.substring(1);
};

StringHelper.IsEmpty = function(str)
{
	if ( !str || !str.length )
	{
		return true;
	}
	return str.length == 0;
};

StringHelper.HtmlEncode = function(original)
{
	if ( !document.htmlEncoder )
	{
		document.htmlEncoder = document.createElement('SPAN');
	}
	document.htmlEncoder.innerText = original;
	return document.htmlEncoder.innerHTML;
};


StringHelper.QuotEscape = function(original)
{
	return original.replace(/%/g, '%25').replace(/"/g, '%22').replace(/'/g, '%27');
};

StringHelper.QuotUnescpe = function(escaped)
{
	return escaped.replace(/%27/g, "'").replace(/%22/g, '"').replace(/%25/g, '%');
};

StringHelper.Trim = function(str)
{
	if ( str )
	{
		return str.replace(/(^\s*)|(\s*$)/g, '');
	}
	else
	{
		return str;
	}
};

StringHelper.StartTrim = function(str)
{
	if ( str )
	{
		return str.replace(/(^\s*)/g, '');
	}
	else
	{
		return str;
	}
};

StringHelper.EndTrim = function(str)
{
	if ( str )
	{
		return str.replace(/(\s*$)/g, '');
	}
	else
	{
		return str;
	}
};

// StringHelper.Format('{0}, {2}, {1}', 'abc', 'def', 'ghi');
// return "abc, ghi, def".
StringHelper.Format = function(format)
{
	if ( arguments.length == 0 )
	{
		return '';
	}
	if ( arguments.length == 1 )
	{
		return String(format);
	}

	var i, strOutput = '';
	for ( i=0 ; i < format.length-1 ; )
	{
		if ( format.charAt(i) == '{' && format.charAt(i+1) != '{' )
		{
			var index = 0, indexStart = i+1, j = indexStart;
			for ( ; j <= format.length-2 ; ++j )
			{
				var ch = format.charAt(j);
				if ( ch < '0' || ch > '9' ) break;
			}
			if ( j > indexStart )
			{
				if ( format.charAt(j) == '}' && format.charAt(j+1) != '}' )
				{
					for ( var k=j-1 ; k >= indexStart ; k-- )
					{
						index += (format.charCodeAt(k)-48)*Math.pow(10, j-1-k);
					}
					var swapArg = arguments[index+1];
					if ( swapArg == null )
					{
						swapArg == '';
					}
					strOutput += swapArg;
					i += j-indexStart+2;
					continue;
				}
			}
			strOutput += format.charAt(i);
			i++;
		}
		else
		{
			if ( ( format.charAt(i) == '{' && format.charAt(i+1) == '{' )
				|| ( format.charAt(i) == '}' && format.charAt(i+1) == '}' ) )
			{
				i++;
			}
			strOutput += format.charAt(i);
			i++;
		}
	}
	strOutput += format.substr(i);
	return strOutput;
};
StringHelper.toHtmlDecode = function(str)
{
  while(str.indexOf("&amp;")>-1)
   {
    str=str.replace("&amp;","&"); 
   }
  while(str.indexOf("&lt;")>-1)
   {
    str=str.replace("&lt;","<"); 
   } 
  while(str.indexOf("&gt;")>-1)
   {
    str=str.replace("&gt;",">"); 
   } 
  while(str.indexOf("&apos;")>-1)
   {
    str=str.replace("&apos;","’");  
   }
  while(str.indexOf("&quot;")>-1)
   {
    str=str.replace("&quot;","\"");  
   }
   return str;  
} 

StringHelper.toHtmlEncode = function(str)
{
 str=str.replace("&","&amp;");  
 str=str.replace("<","&lt;");  
 str=str.replace(">","&gt;");  
 str=str.replace("’","&apos;");  
 str=str.replace("\"","&quot;");  
return str;  
} 


function arraypop(a) {
	if(typeof a != 'object' || !a.length) {
		return null;
	} else {
		var response = a[a.length - 1];
		a.length--;
		return response;
	}
}

function arraypush(a, value) {
	a[a.length] = value;
	return a.length;
}


function findtags(parentobj, tag) {
	if(!isUndefined(parentobj.getElementsByTagName)) {
		return parentobj.getElementsByTagName(tag);
	} else if(parentobj.all && parentobj.all.tags) {
		return parentobj.all.tags(tag);
	} else {
		return null;
	}
}

function copyCode(obj) {
	if(is_ie && obj.style.display != 'none') {
		var rng = document.body.createTextRange();
		rng.moveToElementText(obj);
		rng.scrollIntoView();
		rng.select();
		rng.execCommand("Copy");
		rng.collapse(false);
	}
}

function runCode(obj) {
	var winname = window.open('', "_blank", '');
	winname.document.open('text/html', 'replace');
	winname.document.write(obj.value);
	winname.document.close();
}

function saveCode(obj) {
	var winname = window.open('', '_blank', 'top=10000');
	winname.document.open('text/html', 'replace');
	winname.document.writeln(obj.value);
	winname.document.execCommand('saveas','','code.htm');
	winname.close();
}

function attachimg(obj, action, text) {
	if(action == 'load') {
		if(obj.width > screen.width * 0.7) {
			obj.resized = true;
			obj.width = screen.width * 0.7;
			obj.alt = text;
		}
		obj.onload = null;
	} else if(action == 'mouseover') {
		if(obj.resized) {
			obj.style.cursor = 'pointer';
		}
	} else if(action == 'click') {
		if(!obj.resized) {
			return false;
		} else {
			window.open(text);
		}
	}
}

function attachimginfo(obj, infoobj, show, event) {
	var left_offset = obj.offsetLeft;
	var top_offset = obj.offsetTop;
	var width_offset = obj.offsetWidth;
	var height_offset = obj.offsetHeight;
	while ((obj = obj.offsetParent) != null) {
		left_offset += obj.offsetLeft;
		top_offset += obj.offsetTop;
	}
	if(show) {
		document.getElementById(infoobj).style.position = 'absolute';
		document.getElementById(infoobj).style.left = left_offset + 3;
		document.getElementById(infoobj).style.top = height_offset < 40 ? top_offset + height_offset : top_offset + 3;
		document.getElementById(infoobj).style.display = '';
	} else {
		if(is_ie) {
			document.getElementById(infoobj).style.display = 'none';
			return;
		} else {
			var mousex = document.body.scrollLeft + event.clientX;
			var mousey = document.body.scrollTop + event.clientY;
			if(mousex < left_offset || mousex > left_offset + width_offset || mousey < top_offset || mousey > top_offset + height_offset) {
				document.getElementById(infoobj).style.display = 'none';
			}
		}
	}
}

function setcopy(text, alertmsg){
	if(is_ie) {
		clipboardData.setData('Text', text);
		alert(alertmsg);
	} else {
		prompt('Please press "Ctrl+C" to copy this text', text);
	}
}

function toggle_collapse(objname, unfolded) {
	if(isUndefined(unfolded)) {
		unfolded = 1;
	}
	var obj = document.getElementById(objname);
	var oldstatus = obj.style.display;
	var collapsed = getcookie('discuz_collapse');
	var cookie_start = collapsed ? collapsed.indexOf(objname) : -1;
	var cookie_end = cookie_start + objname.length + 1;

	obj.style.display = oldstatus == 'none' ? '' : 'none';
	collapsed = cookie_start != -1 && ((unfolded && oldstatus == 'none') || (!unfolded && oldstatus == '')) ?
			collapsed.substring(0, cookie_start) + collapsed.substring(cookie_end, collapsed.length) : (
			cookie_start == -1 && ((unfolded && oldstatus == '') || (!unfolded && oldstatus == 'none')) ?
			collapsed + objname + ' ' : collapsed);

	setcookie('discuz_collapse', collapsed, (collapsed ? 86400 * 30 : -(86400 * 30 * 1000)));

	if(img == document.getElementById(objname + '_img')) {
		var img_regexp = new RegExp((oldstatus == 'none' ? '_yes' : '_no') + '\\.gif$');
		var img_re = oldstatus == 'none' ? '_no.gif' : '_yes.gif';
		img.src = img.src.replace(img_regexp, img_re);
	}
	if(symbol == document.getElementById(objname + '_symbol')) {
		symbol.innerHTML = symbol.innerHTML == '+' ? '-' : '+';
	}
}

function imgzoom(o) {
	if(event.ctrlKey) {
		var zoom = parseInt(o.style.zoom, 10) || 100;
		zoom -= event.wheelDelta / 12;
		if(zoom > 0) {
			o.style.zoom = zoom + '%';
		}
		return false;
	} else {
		return true;
	}
}

function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
}

function AddText(txt) {
	obj = document.getElementById('postform').message;
	selection = document.selection;
	checkFocus();
	if(!isUndefined(obj.selectionStart)) {
		var opn = obj.selectionStart + 0;
		obj.value = obj.value.substr(0, obj.selectionStart) + txt + obj.value.substr(obj.selectionEnd);
	} else if(selection && selection.createRange) {
		var sel = selection.createRange();
		sel.text = txt;
		sel.moveStart('character', -strlen(txt));
	} else {
		obj.value += txt;
	}
}

function insertAtCaret(textEl, text){
	if(textEl.createTextRange && textEl.caretPos){
		var caretPos = textEl.caretPos;
		caretPos.text += caretPos.text.charAt(caretPos.text.length - 2)	== ' ' ? text +	' ' : text;
	} else if(textEl) {
		textEl.value +=	text;
	} else {
		textEl.value = text;
	}
}

function checkFocus() {
	var obj = typeof wysiwyg == 'undefined' || !wysiwyg ? document.getElementById('postform').message : editwin;
	if(!obj.hasfocus) {
		obj.focus();
	}
}

function setCaretAtEnd() {
	var obj = typeof wysiwyg == 'undefined' || !wysiwyg ? document.getElementById('postform').message : editwin;
	if(typeof wysiwyg != 'undefined' && wysiwyg) {
		if(is_moz || is_opera) {

		} else {
			var sel = editdoc.selection.createRange();
			sel.moveStart('character', strlen(getEditorContents()));
			sel.select();
		}
	} else {
		if(obj.createTextRange)  {
		    sel = obj.createTextRange();
			sel.moveStart('character', strlen(obj.value));
			sel.collapse();
			sel.select();
		}
	}
}

function strlen(str) {
	return (is_ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function mb_strlen(str) {
	var len = 0;
	for(var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
	}
	return len;
}

function insertSmiley(smilieid) {
	checkFocus();
	var src = document.getElementById('smilie_' + smilieid).src;
	var code = document.getElementById('smilie_' + smilieid).pop;
	if(typeof wysiwyg != 'undefined' && wysiwyg && allowsmilies && (!document.getElementById('smileyoff') || document.getElementById('smileyoff').checked == false)) {
		if(is_moz) {
			applyFormat('InsertImage', false, src);
			var smilies = findtags(editdoc.body, 'img');
			for(var i = 0; i < smilies.length; i++) {
				if(smilies[i].src == src && smilies[i].getAttribute('smilieid') < 1) {
					smilies[i].setAttribute('smilieid', smilieid);
					smilies[i].setAttribute('border', "0");
				}
			}
		} else {
			insertText('<img src="' + src + '" border="0" smilieid="' + smilieid + '" alt="" /> ', false);
		}
	} else {
		code += ' ';
		AddText(code);
	}
}

function smileyMenu(ctrl) {
	ctrl.style.cursor = 'pointer';
	if(ctrl.alt) {
		ctrl.pop = ctrl.alt;
		ctrl.alt = '';
	}
	if(ctrl.title) {
		ctrl.lw = ctrl.title;
		ctrl.title = '';
	}
	if(!smdiv[ctrl.id]) {
		smdiv[ctrl.id] = document.createElement('div');
		smdiv[ctrl.id].id = ctrl.id + '_menu';
		smdiv[ctrl.id].style.display = 'none';
		smdiv[ctrl.id].className = 'popupmenu_popup';
		ctrl.parentNode.appendChild(smdiv[ctrl.id]);
	}
	smdiv[ctrl.id].innerHTML = '<table style="width: 60px;height: 60px;text-align: center;vertical-align: middle;" class="altbg2"><tr><td><img src="' + ctrl.src + '" border="0" width="' + ctrl.lw + '" /></td></tr></table>';
	showMenu(ctrl.id, 0, 0, 1, 0);
}

function announcement() {
	document.getElementById('announcement').innerHTML = '<marquee style="margin: 0px 8px" direction="left" scrollamount="2" scrolldelay="1" onMouseOver="this.stop();" onMouseOut="this.start();">' +
		document.getElementById('announcement').innerHTML + '</marquee>';
	document.getElementById('announcement').style.display = 'block';
}
function in_array(needle, haystack) {
	if(typeof needle == 'string') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function saveData(data, del) {
	if(!data && isUndefined(del)) {
		return;
	}
	if(typeof wysiwyg != 'undefined' && typeof editorid != 'undefined' && typeof bbinsert != 'undefined' && bbinsert && document.getElementById(editorid + '_mode') && document.getElementById(editorid + '_mode').value == 1) {
		data = html2bbcode(data);
	}
	if(is_ie) {
		try {
			var oXMLDoc = textobj.XMLDocument;
			var root = oXMLDoc.firstChild;
			if(root.childNodes.length > 0) {
				root.removeChild(root.firstChild);
			}
			var node = oXMLDoc.createNode(1, 'POST', '');
			var oTimeNow = new Date();
			oTimeNow.setHours(oTimeNow.getHours() + 24);
			textobj.expires = oTimeNow.toUTCString();
			node.setAttribute('message', data);
			oXMLDoc.documentElement.appendChild(node);
			textobj.save('Discuz!');
		} catch(e) {}
	} else if(window.sessionStorage) {
		try {
			sessionStorage.setItem('Discuz!', data);
		} catch(e) {}
	}
}

function loadData() {
	var message = '';
	if(is_ie) {
		try {
			textobj.load('Discuz!');
			var oXMLDoc = textobj.XMLDocument;
			var nodes = oXMLDoc.documentElement.childNodes;
			message = nodes.item(nodes.length - 1).getAttribute('message');
		} catch(e) {}
	} else if(window.sessionStorage) {
		try {
			message = sessionStorage.getItem('Discuz!');
		} catch(e) {}
	}

	if(in_array((message = trim(message)), ['', 'null', 'false', null, false])) {
		alert(lang['post_autosave_none']);
		return;
	}
	if((typeof wysiwyg == 'undefined' || !wysiwyg ? textobj.value : editdoc.body.innerHTML) == '' || confirm(lang['post_autosave_confirm'])) {
		if(typeof wysiwyg == 'undefined' || !wysiwyg) {
			textobj.value = message;
		} else {
			editdoc.body.innerHTML = bbcode2html(message);
		}
	}
}

function deleteData() {
	if(is_ie) {
		saveData('', 'delete');
	} else if(window.sessionStorage) {
		try {
			sessionStorage.removeItem('Discuz!');
		} catch(e) {}
	}
}

function updateseccode(width, height) {
	document.getElementById('seccodeimage').innerHTML = '<img id="seccode" onclick="updateseccode(' + width + ', '+ height + ')" width="' + width + '" height="' + height + '" src="seccode.php?update=' + Math.random() + '" class="absmiddle" alt="" />';
}

function signature(obj) {
	if(obj.style.maxHeightIE != '') {
		var height = (obj.scrollHeight > parseInt(obj.style.maxHeightIE)) ? obj.style.maxHeightIE : obj.scrollHeight;
		if(obj.innerHTML.indexOf('<IMG ') == -1) {
			obj.style.maxHeightIE = '';
		}
		return height;
	}
}

function trim(str) {
	return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

function fetchCheckbox(cbn) {
	return document.getElementById(cbn) && document.getElementById(cbn).checked == true ? 1 : 0;
}

function parseurl(str, mode) {
	str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!]*)+\.(jpg|gif|png|bmp))/ig, mode == 'html' ? '$1<img src="$2" border="0">' : '$1[img]$2[/img]');
	str = str.replace(/([^>=\]"'\/@]|^)((((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k):\/\/)|www\.)([\w\-]+\.)*[:\.@\-\w\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!#]*)*)/ig, mode == 'html' ? '$1<a href="$2" target="_blank">$2</a>' : '$1[url]$2[/url]');
	str = str.replace(/([^\w>=\]:"'\.\/]|^)(([\-\.\w]+@[\.\-\w]+(\.\w+)+))/ig, mode == 'html' ? '$1<a href="mailto:$2">$2</a>' : '$1[email]$2[/email]');
	return str;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function addbookmark(url, site){
	if(is_ie) {
		window.external.addFavorite(url, site);
	} else {
		alert('Please press "Ctrl+D" to add bookmark');
	}
}

function doane(event) {
	e = event ? event : window.event ;
	if(is_ie) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else {
		e.stopPropagation();
		e.preventDefault();
	}
}
function CloseMenu(mnu)
{
    var menu = document.getElementById(mnu);
    if (menu != null)
        menu.style.display = "none";
}


var NumberHelper = {};

//只允许输入数字


NumberHelper.IsKeyCodeNumber = function()
     {
      if ((event.keyCode < 48) || (event.keyCode > 57))
       {
        event.keyCode = null;
        return false;
       }
       else
       {
        return true;
       }
       
     }
     
//字符串是否是数字
NumberHelper.IsNumber = function(strNumber)
{
 if(strNumber == "")
  {
   return false;
  }
 else
  {
   if(isNaN(strNumber))
     {
      return false;
     }
    else
     {
      return true;
     }
  }
};

var PublicObject = {
   publictimer:null
};
PublicObject.EmptyFunc=function(ret)
   {
     if(ret!='true' && ret!='')
      {
       alert(ret);
      }
   };
PublicObject.CloseWindow = function()
  {
     window.opener='abc'; 
     window.open('','_parent',''); 
     window.close();
  };
PublicObject.DelayHideElement = function(elmtid,delaytime)
 {
    this.publictimer = setTimeout("PublicObject.HideElement('"+elmtid+"');",delaytime);
 }
PublicObject.HideElement = function(elmtid)
 {
   //document.getElementById(elmtid).style.display = 'none';
 }
PublicObject.ClearPublicTimer = function()
 {
   clearTimeout(this.publictimer);
 }
PublicObject.ClearPostBack = function()
 {
    var evt = GetEventObj();
    if(is_ie)
     {
      evt.returnValue=false;// for IE
     }
    else
     {
　　  evt.preventDefault();//for firefox
　　 }
 }

PublicObject.Request=function(str)//获得URl参数值

        { 
            var url = location.href; 
            var r = null; 
            if(url==null||url=="")return r; 
            if(str==null||str=="")return r; 
            if(url.indexOf('?') <0)return r; 
            var sp1 = url.split('?'); 
            if(sp1.length <1)return r; 
            if(sp1[1].indexOf(str) <0)return r; 
            var sp2 = sp1[1].split('&'); 
            if(sp2.length > 1)
            { 
                for(var i=0;i <sp2.length;i++)
                { 
                    if(sp2[i].indexOf('=') <0)continue; 
                    var sp3=sp2[i].split('='); 
                    if(sp3.length <1)continue; 
                    if(sp3[0]==str)
                    { 
                        r = sp3[1]; 
                        break; 
                    } 
                } 
            }
            else
            { 
                if(sp2[0].indexOf('=') <0)return r; 
                var sp3=sp2[0].split('='); 
                if(sp3.length <1)return r; 
                if(sp3[0]==str)r = sp3[1]; 
            } 
            return r; 
        }
PublicObject.ReloadWindow=function()
 {
   if(window.location.href.indexOf('#')>-1)
    {
     window.location = window.location.href.substring(0,window.location.href.indexOf('#')); 
    }
   else
    {
     window.location = window.location.href;
    }
 };
 function SelectAll(CheckBoxControl, prefix) 
{

    if (prefix == null || prefix == '') prefix = 'ckb';
    var len = prefix.length;
    
	if (CheckBoxControl.checked == true) 
	{
		var i;
		for (i=0; i < document.forms[0].elements.length; i++) 
		{
			if (document.forms[0].elements[i].type == 'checkbox') 
			{
			    if(document.forms[0].elements[i].name.substring(0,len) == prefix)
			    {
				    document.forms[0].elements[i].checked = true;
				}
			}
		}
	} 
	else 
	{
		for (i=0; i < document.forms[0].elements.length; i++) 
		{
			if (document.forms[0].elements[i].type == 'checkbox') 
			{
				if(document.forms[0].elements[i].name.substring(0,len) == prefix)
			    {
				    document.forms[0].elements[i].checked = false;
				}
			}
		}
	}
}
function CheckSelect(CheckBoxControl, prefix)
{
    if (prefix == null || prefix == '') prefix = 'ckb';
    var len = prefix.length;
    
    if (CheckBoxControl.checked == false) 
	{
	    var i;
		for (i=0; i < document.forms[0].elements.length; i++) 
		{
            if(document.forms[0].elements[i].name == (prefix + '0') && document.forms[0].elements[i].type == 'checkbox')
            {
                document.forms[0].elements[i].checked = false;
                return false;
            }
        }
	} 
	else 
	{
		for (i=0; i < document.forms[0].elements.length; i++) 
		{
			if (document.forms[0].elements[i].type == 'checkbox' && document.forms[0].elements[i].name.substring(0,len) == prefix) 
			{
			    if(document.forms[0].elements[i].name != (prefix + '0') && document.forms[0].elements[i].checked == false)
		        {  
		            document.getElementById(prefix + '0').checked=false;
			        return false;
		        }
			}
		}
		document.getElementById(prefix + '0').checked = true;
		return false;
	}
}
function SetCookie(key, value)
{
	var argv = SetCookie.arguments;
	var argc = SetCookie.arguments.length;
	var expires = (2 < argc) ? argv[2] : null;
    if(expires&&expires.toGMTString)
     {
       expires=expires.toGMTString();
     }
	var path = (3 < argc) ? argv[3] : null;
	var domain = (4 < argc) ? argv[4] : null;
	var secure = (5 < argc) ? argv[5] : false;
	document.cookie = key + '=' + escape (value)
		+ ((expires == null) ? '' : ('; expires=' + expires))
		+ ((path == null) ? '' : ('; path=' + path))
		+ ((domain == null) ? '' : ('; domain=' + domain))
		+ ((secure == true) ? '; secure' : '');
}
function GetCookie(key)
{
	var arg = key + '=';
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while( i < clen )
	{
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg)
		{
			var offset = j;
			var endstr = document.cookie.indexOf (';', offset);
			if (endstr == -1)
			{
				endstr = document.cookie.length;
			}
			return unescape(document.cookie.substring(offset, endstr));
		}
		i = document.cookie.indexOf(' ', i) + 1;
		if ( i==0 ) break;
	}
	return null;
}
function openwin(content) {
    OpenWindow = window.open("", "newwin", "height=200, width=250,toolbar=no,scrollbars=no,menubar=no");
    //写成一行 
    OpenWindow.document.write("<TITLE></TITLE>")
    OpenWindow.document.write("<BODY BGCOLOR=#ffffff>")
    OpenWindow.document.write("<div>")
    OpenWindow.document.write(content)
    OpenWindow.document.write("</div>")
    OpenWindow.document.write("</BODY>")
    OpenWindow.document.write("</HTML>")
    OpenWindow.document.close()
} 

// 获取Radiobuttonlist选中的值
function GetRblSeletedValue(obj) {
    var ddlLevel = document.getElementById(obj);
    var rbs = ddlLevel.getElementsByTagName("INPUT");
    for (var i = 0; i < rbs.length; i++) {
        if (rbs[i].checked) {
            return rbs[i].value;

        }
    }

}
//手机验证
function GetCheckMobile(tel)
{
     var m=false;
     var reg0=/^1\d{10}$/;   //130--139。至少7位
//     var reg1=/^15\d{9}$/;  //联通153。至少7位
//     var reg2=/^18\d{9}$/;  //移动159。至少7位
     if (reg0.test(tel))m=true;
//     if (reg1.test(tel))m=true;
//     if (reg2.test(tel))m=true;
     
     return m;
}
//身份证验证
function GetCheckIdentityCard(idcard)
{
         var Errors=new Array(
        "验证通过!",
        "身份证号码位数不对!",
        "身份证号码出生日期超出范围或含有非法字符!",
        "身份证号码校验错误!",
        "身份证地区非法!"
        );
        var area={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"} 
        var idcard,Y,JYM;
        var S,M;
        var idcard_array = new Array();
        idcard_array = idcard.split("");
        //地区检验
        if(area[parseInt(idcard.substr(0,2))]==null) return Errors[4];
        //身份号码位数及格式检验
        switch(idcard.length){
        case 15:
        if ( (parseInt(idcard.substr(6,2))+1900) % 4 == 0 || ((parseInt(idcard.substr(6,2))+1900) % 100 == 0 && (parseInt(idcard.substr(6,2))+1900) % 4 == 0 )){
        ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}$/;//测试出生日期的合法性
        } else {
        ereg=/^[1-9][0-9]{5}[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}$/;//测试出生日期的合法性
        }
        if(ereg.test(idcard)){
        return Errors[0];
        }else{
        return Errors[2];
        }
        break;
        case 18:
        //18位身份号码检测
        //出生日期的合法性检查
        //闰年月日:((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))
        //平年月日:((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))
        if ( parseInt(idcard.substr(6,4)) % 4 == 0 || (parseInt(idcard.substr(6,4)) % 100 == 0 && parseInt(idcard.substr(6,4))%4 == 0 )){
        ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|[1-2][0-9]))[0-9]{3}[0-9Xx]$/;//闰年出生日期的合法性正则表达式
        } else {
        ereg=/^[1-9][0-9]{5}19[0-9]{2}((01|03|05|07|08|10|12)(0[1-9]|[1-2][0-9]|3[0-1])|(04|06|09|11)(0[1-9]|[1-2][0-9]|30)|02(0[1-9]|1[0-9]|2[0-8]))[0-9]{3}[0-9Xx]$/;//平年出生日期的合法性正则表达式
        }
        if(ereg.test(idcard)){//测试出生日期的合法性
        //计算校验位
        S = (parseInt(idcard_array[0]) + parseInt(idcard_array[10])) * 7
        + (parseInt(idcard_array[1]) + parseInt(idcard_array[11])) * 9
        + (parseInt(idcard_array[2]) + parseInt(idcard_array[12])) * 10
        + (parseInt(idcard_array[3]) + parseInt(idcard_array[13])) * 5
        + (parseInt(idcard_array[4]) + parseInt(idcard_array[14])) * 8
        + (parseInt(idcard_array[5]) + parseInt(idcard_array[15])) * 4
        + (parseInt(idcard_array[6]) + parseInt(idcard_array[16])) * 2
        + parseInt(idcard_array[7]) * 1
        + parseInt(idcard_array[8]) * 6
        + parseInt(idcard_array[9]) * 3 ;
        Y = S % 11;
        M = "F";
        JYM = "10X98765432";
        M = JYM.substr(Y,1);//判断校验位
        if(M == idcard_array[17]){
        return Errors[0]; //检测ID的校验位
        }else{
        return Errors[3];
        }
        }else{
        return Errors[2];
        }
        break;
        default:
        return Errors[1];
        break;
        }

}
//验证护照
function GetCheckPassportNumber(number) {
    var str = number;
    //在JavaScript中，正则表达式只能使用"/"开头和结束，不能使用双引号
    var Expression = /(P\d{7})|(G\d{8})/;
    var objExp = new RegExp(Expression);
    if (objExp.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

