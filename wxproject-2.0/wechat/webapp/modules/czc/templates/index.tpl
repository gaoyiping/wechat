<!DOCTYPE HTML>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style/css/amazeui.min.css">
<link rel="stylesheet" href="style/css/css.css" >

<script type="text/javascript" src="modpub/js/check.js"> </script>
<title></title>

<link href="style/dialog/css/blackbox.css" rel="stylesheet" type="text/css">
<script src="style/dialog/js/jquery.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/jquery.blackbox.min.js" type="text/javascript"></script> 
<script src="style/dialog/js/dialog.js" type="text/javascript"></script> 

<script type="text/javascript" src="modpub/js/ajax.js"> </script>
{literal}


<script type="text/javascript">


function checkpid(u){
  var url = "index.php?module=RegMember&action=checkUser&uid=wrj" + u;
  if(Trim(u) == ''){
    
  } else {
    ajax(url,function(text){
       var strs= new Array(); 
       strs=text.split("[!]"); 
       if (strs[0]=='1') {
          document.getElementById('um').innerHTML=strs[1];
          document.getElementById('im').src=strs[2];
       }else{ 
          document.getElementById('um').innerHTML='该用户不存在';
       }
         
      
    });
  }
   
}
           
           function SaveVal(f) {
               
               if ($.trim($("#TxtNumb").val()).length == 0) {
                mbox("请输入受让人编号!");
                return false;
              }


              var money = parseFloat(f.amount.value);

              if(money<50){

                mbox("转让金额均高于50方可转让!");
                return false;
              }

        if ($.trim($("#TxtMoney").val()).length == 0) {
          mbox("请输入转币金额!");
          return false;
        }
        
  
              if(confirm("系统提示：\n你确定要给账号 wrj" + 
        f.userid.value + " 转币 ￥" + f.amount.value + " 吗？")){
        var es = document.form1.elements;
        for(var i=0;i<es.length;i++){
          if(es[i].type == 'submit'){
          es[i].disabled = true;
          }
        }
        return true;
        }
        return false;
        
           }
    </script>
{/literal}  


</head>

<body class="white">

<header class="top"> 
<div class="text-center">拨币申请</div>
<div class="action">
        <a href="javascript:window.history.back();" class="pull-left">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
 </header>

<section class="center">
 
<div class="sq_box">

<form name="f" action="index.php?module=czc" method='post' onsubmit="return SaveVal(this);">
<input type="hidden" name="type" value="user">
<input name="z_money" type="hidden"  value="{$user->j_money}" >
<br/>
<h3>可转充值币金额：</h3>
<p><strong class="red">￥{$user->c_money|sprintf}</strong></p>
<p>转让说明：是将充值币转让给对方的充值币，转让金额50元以上。</p>

<h3>受让人编号：</h3>

<p class="money"><span class="span2">wrj</span><input style="margin-left:100px" name="userid" type="text"  id="TxtNumb"  class="how" placeholder="必填项"  onblur="checkpid(this.value);"></p>

<h3>受让人基本信息：</h3>
<p><span id="um"></span></p>
<p><img src="" id="im" style="height:80px"></p>

<h3>申请转币金额：</h3>

<p class="money">
<input name="amount" type="text"  id="TxtMoney" class="how" placeholder="必填项" onkeypress="if ((event.keyCode < 48 || event.keyCode > 57) &amp;&amp; (event.keyCode != 46)) event.returnValue = false;">
  <span>元</span></p>

<input type="submit" value="提交申请"  class="sub">
</form>
</div>

 <p class="lheight"></p>
</section>

{php}include BASE_PATH."/modules/end/templates/index.tpl";{/php}  

</body>
</html>
