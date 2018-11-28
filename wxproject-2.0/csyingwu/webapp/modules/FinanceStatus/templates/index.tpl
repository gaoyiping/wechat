<html>
<head>
<title>会员奖金列表</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" href="modpub/css/base.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/new_style/css/sanming.css" />
    <link rel="stylesheet" type="text/css" href="/new_style/css/Popup.css" />
      <link rel="stylesheet" type="text/css" href="/FineMessBox/css/subModal.css" />
<script type="text/javascript" src="/FineMessBox/js/common.js"></script>
<script type="text/javascript" src="/FineMessBox/js/subModal.js"></script>
    {literal}
<script type="text/javascript">
    function AlertMessageBox()
    {

	        
	         
    }
        function Showopen(sNo)
        {
	
            showPopWin('查看发放流程',"index.php?module=dailijin&action=view&sNo="+sNo, 640, 300, AlertMessageBox,true,true)
        }
        
        function modifyMoney(id){
        	var xingyun_money=document.getElementById("xingyun_money"+id).value;
			var	lingdao_money=document.getElementById("lingdao_money"+id).value;
			var	kaituo_money=document.getElementById("kaituo_money"+id).value;
			window.location.href="index.php?module=jiang&action=modify&xingyun_money="+xingyun_money+"&lingdao_money="+lingdao_money+"&kaituo_money="+kaituo_money+"&id="+id;
        }
</script>
{/literal}
</head>
<body scroll="yes">
<div style="background-color: #ffffff; margin-right: 2px" id="Div_right">
        <table style="width: 99%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="line_leftright_borderclor">

                        <script>
                                     
                        </script>

                        <div style="margin-top: -1px; height: 30px;  overflow: hidden" id="ctl00_Div_right_top"
                            class="YFTmainright_r1_c2_gj">
                            <div style="position: relative; line-height: 30px; width: 100%">
                                &nbsp;<span class="Font_red Font_addbold">[会员管理]</span> >> 工资表

                            </div>
                        </div>
                        <div style="min-height: 446px; width: 100%; height: auto !important; overflow: visible"
                            id="Div_Content"><br />
<form name="form2" method="post" action="index.php?module=jiang&action=okall" >
  {literal}
<script type="text/javascript">
function ccolor(c){
  if(c.checked){
    c.parentNode.parentNode.bgColor = 'green';
  } else {
    c.parentNode.parentNode.bgColor = 'white';
  }
}
function e(t){
  var es = document.form2.elements;
  for(var i=0;i<es.length;i++){
    if(es[i].type == 'checkbox' ){
      if(t == 'a'){
        es[i].checked = true; ccolor(es[i]);
      }
      if(t == 'o'){
        es[i].checked = !es[i].checked; ccolor(es[i]);
      }
    }
  }
}
</script>
{/literal}

<table align="center" bgcolor="#dedede" border="0" cellpadding="0" cellspacing="0" width="96%"><tr><td>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
  	<tr class="td3"> 
     
       <td width="11%"><div align="center"><font color="#FFFFFF">结算日期</font></div></td>
	   <td width="9%"><div align="center"><font color="#FFFFFF">分红</font></div></td>
	   <td width="9%"><div align="center"><font color="#FFFFFF">扣税</font></div></td>
	   <td width="10%"><div align="center"><font color="#FFFFFF">应发</font></div></td>
       <td width="8%"><div align="center"><font color="#FFFFFF">状态</font></div></td>
    </tr>
    
    {if $total==0}
     <tr class="td4"><td colspan="5">暂无工资</td></tr>
   {/if}  
    {foreach from=$rpros item=item name=f1}
    
    <tr class="td4"  onmouseover="this.style.background='#CDE6EB'" onmouseout="this.style.background='#fff';"> 
    
    
     <td><div align="center">
	{$item->add_date|date_format:'%Y-%m-%d'}</div></td>
	<td><div align="right">{$item->money|sprintf}</div></td>
	<td><div align="right" style='color:red;'>-{$item->tax_money|sprintf}</div></td>
    <td><div align="right" style='color:#120DD2;'>{$item->s_money|sprintf}&nbsp;</div></td>
	
      <td>
        <div align="center">
		{if $item->isf==0}未发放{else}<font color="red">已发放</font>{/if}  
        </div></td>
    
    </tr>
   
    {/foreach}
  </table>
</td></tr><tr height="35" bgColor="white" ><td valign="middle">
    
   </font>
  
  </td></tr></table></form>
<br/>
<table align="center"><tr><td>
<div class="pages">
  {$pagehtml}
  </div>
</td></tr></table><br />



 </div>
                    </td>
                </tr>
                <tr>
                    <td class="YFTmainright_r3_c2_gj" height="1">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script language="javascript" src="/new_style/css/webjs.js"> </script>
</body>
</html>
