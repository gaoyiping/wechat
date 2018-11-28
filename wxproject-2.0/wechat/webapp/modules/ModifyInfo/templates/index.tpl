<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >
<script type="text/javascript" src="modpub/js/ajax.js"> </script>
<script type="text/javascript" src="modpub/js/check.js"> </script>
<title></title>
<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 

{literal}
<script type="text/javascript">
function SaveVal(f) {
 
  if(Trim(f.user_name.value) == ''){
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

<body class="white">
<header class="top"> 
<div class="text-center">收货地址管理</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>
<section class="center">
 <p class="lheight"></p>
 
<div class="new_add">

    <form name="f"  class="am-form" action="index.php?module=ModifyInfo" method='post' onsubmit="return SaveVal(this);">

  <fieldset>
    <div class="am-form-group">
      <label for="doc-vld-name-2">联系人姓名：</label>
      <input type="text" id="doc-vld-name-2" name="user_name" value="{$userinfo->user_name}"  placeholder="" required />
    </div>

    <div class="am-form-group">
      <label for="doc-vld-email-2">联系人电话：</label>
      <input type="text" name="mobile" value="{$userinfo->mobile}"  id="doc-vld-email-2" placeholder="" required/>
    </div>


    
    <div class="am-form-group">
      <label for="Select1">所在地区：</label>
      

      <select id="Select1" name="sheng" onchange="selectCity();">
           <option value="0" >省/直辖市</option>
           {foreach from=$shengs item=item name=f1}
            <option value="{$item->GroupID}" {if $item->GroupID==$userinfo->sheng}selected{/if} >{$item->G_CName}</option>
           {/foreach}
        </select>

      <p>&nbsp;</p>
      <select id="Select2" name="shi" onchange="selectCountry()">
          <option value="0" >请选择</option>
          {foreach from=$shis item=item name=f1}
            <option value="{$item->GroupID}" {if $item->GroupID==$userinfo->shi}selected{/if} >{$item->G_CName}</option>
           {/foreach}
        </select>


      <p>&nbsp;</p>

      <select id="Select3" name="xian" >
          <option value="" >请选择</option>
          {foreach from=$xians item=item name=f1}
            <option value="{$item->GroupID}" {if $item->GroupID==$userinfo->xian}selected{/if} >{$item->G_CName}</option>
           {/foreach}
        </select>

      <span class="am-form-caret"></span>
    </div>

    

    <div class="am-form-group">
      <label for="doc-vld-ta-2">详细地址：</label>
      <textarea id="doc-vld-ta-2" name="address">{$userinfo->address}</textarea>
    </div>

    <input type="submit" value="保存地址" class="am-btn am-btn-success am-btn-block" />

  </fieldset>
</form>

</div>


 <p class="lheight"></p>
</section>

{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  

</body>
</html>
