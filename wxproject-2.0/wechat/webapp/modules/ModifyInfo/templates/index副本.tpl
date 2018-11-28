<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>资料修改</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon.png"/>
<link href="modpub/css/css.css" type="text/css" rel="stylesheet">
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/xmapp.css"/>
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
<script type="text/javascript" src="modpub/js/check.js"> </script>
<script type="text/javascript" src="modpub/js/userinfo_check.js"> </script>
 <script type="text/javascript" src="modpub/js/ajax.js"> </script>
 
 <link href="/phone/modpub/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="/phone/modpub/js/jquery.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="/phone/modpub/js/dialog.js" type="text/javascript"></script> 

{literal}
<script type="text/javascript">
function SaveVal(f) {
 
 	if(Trim(f.email.value) == ''){
	    mbox("联系人未填!");
	    return false;
	  }
	  
	  if(Trim(f.mobile.value) == ''){
	    mbox("联系电话未填!");
	    return false;
	  }
	  
	  return true;
          
  
}


function Init()
  {
  
    var   dropElement1=document.getElementById("Select1"); 
    var   dropElement2=document.getElementById("Select2"); 
    var   dropElement3=document.getElementById("Select3");   
    RemoveDropDownList(dropElement1);
    RemoveDropDownList(dropElement2);
    RemoveDropDownList(dropElement3);

      var country;
        var province;
        var city;
     var url = "index.php?module=ModifyInfo&action=ajax&GroupID=0";
     ajax(url,function(text){
        var strs= new Array(); 
        strs=text.split("|"); 
        for(var i=0; i<strs.length-1;   i++)
        {
	     var opp= new Array(); 
             opp=String(strs[i]).split(","); 

	
              var   eOption=document.createElement("option");   
              eOption.value=opp[1];
              eOption.text=opp[0];
              dropElement1.add(eOption);
	       
        }
   
    });
    
  }   
   
  function   selectCity()   
  {       
          var   dropElement1=document.getElementById("Select1"); 
          var   dropElement2=document.getElementById("Select2"); 
	  var   dropElement3=document.getElementById("Select3"); 
          var   name=dropElement1.value;
          
	  RemoveDropDownList(dropElement2);
          RemoveDropDownList(dropElement3);

	  if(name!="")
	  {
	 
           var url = "index.php?module=ModifyInfo&action=ajax&GroupID="+name;

			ajax(url,function(text){
			var strs= new Array(); 
			strs=text.split("|"); 
			for(var i=0; i<strs.length-1;   i++)
			{
			     var opp= new Array(); 
			     opp=String(strs[i]).split(","); 

			
			      var   eOption=document.createElement("option");   
			      eOption.value=opp[1];
			      eOption.text=opp[0];
			      dropElement2.add(eOption);
			       
			}
		   
		    });
            }
  } 
  
  function   selectCountry()   
  {   
     
          var   dropElement1=document.getElementById("Select1"); 
          var   dropElement2=document.getElementById("Select2"); 
	  var   dropElement3=document.getElementById("Select3"); 
          var   name=dropElement2.value;
          
	
          RemoveDropDownList(dropElement3);

	  if(name!="")
	  {
	 
           var url = "index.php?module=ModifyInfo&action=ajax&GroupID="+name;

			ajax(url,function(text){
			var strs= new Array(); 
			strs=text.split("|"); 
			for(var i=0; i<strs.length-1;   i++)
			{
			     var opp= new Array(); 
			     opp=String(strs[i]).split(","); 

			
			      var   eOption=document.createElement("option");   
			      eOption.value=opp[1];
			      eOption.text=opp[0];
			      dropElement3.add(eOption);
			       
			}
		   
		    });
            }
  }

  function   RemoveDropDownList(obj)   
  {   
      if(obj)
      {
          var   len=obj.options.length;   
          if(len>0)
          {
            //alert(len);   
            for(var   i=len;i>=1;i--)   
            {   
                  obj.remove(i);   
            }
          }
       }
            
  }  
  
</script>
{/literal}
</head>

<body  >
	<div class="header_03">
      <div style="" class="tit">
    <h3>资料修改</h3>
  </div>
      
</div>
<section style="width:100%;margin:45px auto 0;overflow:hidden;">


<form name="f" action="index.php?module=ModifyInfo" method='post' onsubmit="return SaveVal(this);">

  
  <div>
    <div class="content">
      <div class="paw_change">
        <ul>
          <li>
            <p>用户编号：</p>
            <p>
              {$userinfo->user_id}
            </p>
          </li>
          
          <li>
            <p>联系人姓名：</p>
            <p>
              <input name="email" value="{$userinfo->e_mail}" type="text" maxlength="20" id="email" class="paw_inp" placeholder="必填项">
            </p>
          </li>
          
          
		  
		  <li>
            <p>联系电话：</p>
            <p>
              <input name="mobile" value="{$userinfo->mobile}" type="text" maxlength="20" class="paw_inp" placeholder="必填项">
            </p>
          </li>
		  
		  <li>
            <p>身份证号：</p>
            <p>
              <input name="idno" value="{$userinfo->idno}" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>银行开户名：</p>
            <p>
              <input name="cardname" value="{$userinfo->cardname}" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>银行帐号：</p>
            <p>
              <input name="cardnumber" value="{$userinfo->card_number}" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>开户银行：</p>
            <p>
              <input name="cardtype" value="{$userinfo->card_type}" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>开户行所在省市：</p>
            <p>
              <input name="provcity" value="{$userinfo->provcity}" type="text"  class="paw_inp">
            </p>
          </li>
		  
		  <li>
            <p>所在区域：</p>
            <p>
	            <select id="Select1" name="sheng" onchange="selectCity();">
					 <option value="" >省/直辖市</option>
					 {foreach from=$shengs item=item name=f1}
					 	<option value="{$item->GroupID}" {if $item->GroupID==$userinfo->sheng}selected{/if} >{$item->G_CName}</option>
					 {/foreach}
				</select>
			    <select id="Select2" name="shi" onchange="selectCountry()">
					<option value="" >请选择</option>
					{foreach from=$shis item=item name=f1}
					 	<option value="{$item->GroupID}" {if $item->GroupID==$userinfo->shi}selected{/if} >{$item->G_CName}</option>
					 {/foreach}
				</select>
			    <select id="Select3" name="xian" >
					<option value="" >请选择</option>
					{foreach from=$xians item=item name=f1}
					 	<option value="{$item->GroupID}" {if $item->GroupID==$userinfo->xian}selected{/if} >{$item->G_CName}</option>
					 {/foreach}
				</select>
            </p>
          </li>
          
		  <li>
            <p>街道地址：</p>
            <p>
              <input name="address" value="{$userinfo->address}" type="text"  class="paw_inp">
            </p>
          </li>
  
 
  
		  
		  
        </ul>
      </div>
	  
	  <div class="paw_icon">
		 <input type="submit" value=""  class="sub">
		  
      </div>
	  
    </div>
  </div>
 

</form>

</section>
﻿
{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  


</body>
</html>