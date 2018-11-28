/*--------------订购产品------------------*/
function GetDridView_DivWidth(id) {
    var realwidth = "100%";
    if (id = 1)
        realwidth = "1200px";
    else if (id = 2)
        realwidth = "1120px";
    var width = window.screen.width < 1366 ? realwidth : "100%";
    if (document.getElementById("Div_GridView"))
    document.getElementById("Div_GridView").style.width = width;
}

function GetCheckGoods(idInfo) {
    if(idInfo!="")
    {
        var arry=new Array();
        arry=idInfo.split(",");
        for(var i=0;i<arry.length;i++)
        {
            if(document.getElementById('chkboxpro_'+arry[i]))
                document.getElementById('chkboxpro_' + arry[i]).checked = true;
            if (document.getElementById('Div_desc_' + arry[i]))
                document.getElementById("Div_desc_" + arry[i]).style.color = "#F16911";
        }
    }
}
//选中或取消权限
function SetCheckMent( pid,id) {
    if (document.getElementById('chkboxpro_' + id) != null) {
        if (document.getElementById('chkboxpro_' + id).checked) {
        
            if (document.getElementById('ctl00_ContentPlaceHolder1_HidIDsInfo').value == "") {
                document.getElementById('ctl00_ContentPlaceHolder1_HidIDsInfo').value +=id;
            }
            else {
                document.getElementById('ctl00_ContentPlaceHolder1_HidIDsInfo').value += ',' + id;
            }
            if (document.getElementById('ctl00_ContentPlaceHolder1_HidPIDsInfo').value == "") {
                document.getElementById('ctl00_ContentPlaceHolder1_HidPIDsInfo').value +=pid;
            }
            else {
                document.getElementById('ctl00_ContentPlaceHolder1_HidPIDsInfo').value += ',' + pid;
            }
        }
        else {
            SetClearMent(id, pid);
        }
    }
}
function SetClearMent(id, pid) {
    if (document.getElementById('chkboxpro_' + id) != null) {
     
    
        var IDs = document.getElementById('ctl00_ContentPlaceHolder1_HidIDsInfo').value+',';
        var PIDs = document.getElementById('ctl00_ContentPlaceHolder1_HidPIDsInfo').value+',';
        var IDInfo=IDs.replace(id + ',', '');
        var PIDInfo=PIDs.replace(pid + ',', '');
        document.getElementById('ctl00_ContentPlaceHolder1_HidIDsInfo').value = IDInfo.substring(0, IDInfo.length - 1);
        document.getElementById('ctl00_ContentPlaceHolder1_HidPIDsInfo').value = PIDInfo.substring(0, PIDInfo.length - 1);
    }
}
function GetChooseGoods(id, name, qian, jifen ,sNo,danwei,tiaoma,jianyijia,num) {

                   
				   //判断产品信息是否已经存在
                   obj=document.getElementById('txtbbID'+id); 
                  if(obj!=null){ 
				  
				    alert("该产品已经被加载到列表！");

				  }
				  else
	              { 

						 //选中行字体颜色改变
						if (document.getElementById("Div_desc_" + id)) 
						{
								document.getElementById("Div_desc_" + id).style.color = "#F16911";
								document.getElementById("chkboxpro_" + id).disabled=true;
						}
						AddSignRow(id, name, qian, jifen,15511,sNo,danwei,tiaoma,jianyijia,num);
					   

						tongji();
				  }
     
	
}

function delRow()
{
   index=event.srcElement.parentElement.parentElement.rowIndex;
   var tbv=document.getElementById("tb");
   tbv.deleteRow(index);
}
//******************************统计报单数和金额*********************************************
function tongji()
{

	          var num=0;
			  var jine=0;
			  var jifen=0;
			  var shuliang=0;
               var signFrame = findObj("SignFrame",document);
    	         
               // 重新排列序号，如果没有序号，这一步省略
                for(i=0;i<signFrame.rows.length;i++){
               
                 num++;
                      jine=jine+ (parseInt(signFrame.rows[i].cells[2].innerText)*parseInt(signFrame.rows[i].cells[7].innerText));
				 
						
				
	                        
                }
				
				document.getElementById("ctl00_ContentPlaceHolder1_lbtypeprd").innerHTML=num;
				document.getElementById("ctl00_ContentPlaceHolder1_lbtotalmoney").innerHTML=jine;
				document.getElementById("ctl00_ContentPlaceHolder1_lbtotalmoney1").innerHTML=jine;
				
				
				
}



//----------------------------------------------------------动态添加删除行-------------------------------------------
function findObj(theObj, theDoc){ 
    var p, i, foundObj;
    if(!theDoc) theDoc = document;  
    if( (p = theObj.indexOf("?")) > 0 && parent.frames.length)  {
        theDoc = parent.frames[theObj.substring(p+1)].document;    
        theObj = theObj.substring(0,p);  
    }  
    if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];  
    for(i=0; !foundObj && i < theDoc.forms.length; i++)  foundObj = theDoc.forms[i][theObj];  
    for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++) foundObj = findObj(theObj,theDoc.layers[i].document);  
    if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj); return foundObj;
}
//添加一个参与人填写行
function AddSignRow(id, name, qian, jifen,yuanshi,sNo,danwei,tiaoma,jianyijia,num){ //读取最后一行的行号，存放在txtTRLastIndex文本框中
     var txtTRLastIndex = findObj("txtTRLastIndex",document);
     var rowID = parseInt(txtTRLastIndex.value);
     
     var signFrame = findObj("SignFrame",document);
     //添加行
     var newTR = signFrame.insertRow(signFrame.rows.length);
     newTR.id = "SignItem" + rowID;

     //添加列:序号
     var newNameTD=newTR.insertCell(0);
     newNameTD.innerHTML = newTR.rowIndex.toString();
      newNameTD.width=40;



     //添加列: 姓名
     var newNameTD1=newTR.insertCell(1);
     newNameTD1.innerHTML = name+"<input name='txtID" + newTR.rowIndex.toString() + "' id='txtID" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+id+"' />"
	+"<input name='txtbbID" + +id + "' id='txtbbID" +id+ "' type='text'  style='display:none' />"
	 +"<input name='rsNo" + newTR.rowIndex.toString() + "' id='rsNo" + newTR.rowIndex.toString() + "' style='display:none' type='text'   value='"+sNo+"' />"
	 	+"<input name='rname" + newTR.rowIndex.toString() + "' id='rname" + newTR.rowIndex.toString() + "' style='display:none' type='text'   value='"+name+"' />"
		+"<input name='rdanwei" + newTR.rowIndex.toString() + "' id='rdanwei" + newTR.rowIndex.toString() + "' style='display:none' type='text'   value='"+danwei+"' />"
		+"<input name='tiaoma" + newTR.rowIndex.toString() + "' id='tiaoma" + newTR.rowIndex.toString() + "' style='display:none' type='text'   value='"+tiaoma+"' />";
	
	 
	 newNameTD1.width=250;
     	

     //添加列:价格
     var newJiage2=newTR.insertCell(2);
	
     newJiage2.innerHTML = qian;
     newJiage2.style.font="0px;";
     
    //添加列:价格
     var newJiage3=newTR.insertCell(3);
     newJiage3.innerHTML =  "￥<input name='jiage" + newTR.rowIndex.toString() + "' id='jiage" + newTR.rowIndex.toString() + "' type='text' onkeyup=\"updateNum1(this,'SignItem" + rowID + "')\"  style='width:50px;' value='"+jianyijia+"' />";
	 newJiage3.width=85;

	    //添加列:价格
     var newJiage=newTR.insertCell(4);
     newJiage.innerHTML = "￥"+jianyijia;
	 newJiage.width=85;


	 	    //添加列:价格
     var kucun=newTR.insertCell(5);
     kucun.innerHTML =num+danwei  ;
	 kucun.width=65;
 

     //添加列:数量
     var newNum=newTR.insertCell(6);
     newNum.innerHTML = "<input name='txtNum" + newTR.rowIndex.toString() + "' id='txtNum" + newTR.rowIndex.toString() + "' type='text' onkeyup=\"updateNum(this,'SignItem" + rowID + "',"+num+")\"  style='width:30px;' value='1' />";
     newNum.width=85;

     
     //添加列:数量
     var newshuliang2=newTR.insertCell(7);
     newshuliang2.innerHTML = "1"+danwei;
     newshuliang2.width=60;
 
     //添加列:删除按钮
     var newDeleteTD=newTR.insertCell(8);
     //添加列内容
     newDeleteTD.innerHTML = "<div align='center' style='width:40px'><a href='javascript:;' onclick=\"DeleteSignRow('SignItem" + rowID + "','"+id+"')\">删除</a></div>"
	 +"<div style='display:none;'><input name='txtjifen" + newTR.rowIndex.toString() + "' id='txtjifen" + newTR.rowIndex.toString() + "' type='text'   value='"+jifen+"' /><input name='txtjiage" + newTR.rowIndex.toString() + "' id='txtjiage" + newTR.rowIndex.toString() + "' type='text'  value='"+qian+"' /></div>";
      newDeleteTD.width=50;

 






	    
     //将行号推进下一行
     txtTRLastIndex.value = (rowID + 1).toString() ;
}

//更改数量重新绑定统计值
function updateNum(obj,rowid,num)
{    
	if (/[^\d]/.test(obj.value)){
		obj.value="1";
       alert("请输入数字");
     }
     if(parseInt(obj.value)<1)
	{
	  obj.value="1";
       alert("商品数量不能小于1");
	 }
	   if(parseInt(obj.value)>parseInt(num))
	{
	  obj.value="1";
       alert("销售的产品数量不能大于您的库存数量");
	 }
	var signFrame = findObj("SignFrame",document);
 
       signFrame.rows[rowid].cells[7].innerHTML = obj.value+"份";
	 
	 tongji();
  
}

//更改数量重新绑定统计值
function updateNum1(obj,rowid)
{    
	if (/[^\d]/.test(obj.value)){
		obj.value="1";
       alert("请输入数字");
     }
     if(parseInt(obj.value)<1)
	{
	  obj.value="1";
       alert("商品价格不能小于1");
	 }
	var signFrame = findObj("SignFrame",document);
 
       signFrame.rows[rowid].cells[2].innerHTML = obj.value;
	 
	 tongji();
  
}

//删除指定行
function DeleteSignRow(rowid,id){

 	

     var signFrame = findObj("SignFrame",document);
	
     var signItem = findObj(rowid,document);

     //获取将要删除的行的Index
     var rowIndex = signItem.rowIndex;
     
     //删除指定Index的行
     signFrame.deleteRow(rowIndex);
     
     // 重新排列序号，如果没有序号，这一步省略
     for(i=0;i<signFrame.rows.length;i++){
      signFrame.rows[i].cells[0].innerHTML = i.toString();
	  
     }
	 tongji();
}//清空列表
function ClearAllSign(){
     if(confirm('确定要清空所有参与人吗？')){
          var signFrame = findObj("SignFrame",document);
          var rowscount = signFrame.rows.length;
         
          //循环删除行,从最后一行往前删除
          for(i=rowscount - 1;i > 0; i--){
           signFrame.deleteRow(i);
          }
         
          //重置最后行号为1
          var txtTRLastIndex = findObj("txtTRLastIndex",document);
          txtTRLastIndex.value = "1";
         
          //预添加一行
          AddSignRow();
     }
}

 //选中或取消选中产品------------------------------------------------        
 function SetIndentGoods(id,price,pv)
 { 
      
     if(document.getElementById('chkboxpro_'+id)!=null)
     {
         if (document.getElementById('chkboxpro_' + id).checked) 
         {
             //选中行字体颜色改变
             if (document.getElementById("Div_desc_"+ id))
                {
                    document.getElementById("Div_desc_"+ id).style.color = "#F16911";
                }

                var gvProList;
                if(document.getElementById('ctl00_ContentPlaceHolder1_gvProductList'))
                {
                    gvProList=document.getElementById('ctl00_ContentPlaceHolder1_gvProductList');
                }
                else
                {
                    gvProList=document.getElementById('gvProductList');
                }
               var selectvalue=''; //选中的产品Id字符串
               var selectnum='';//选中的产品数量字符串
               var flag=false;
               if(gvProList!=null)
               {
                      for(j = 1;j< gvProList.rows.length; j++)
                      {
                           var inputArray= gvProList.rows[j].getElementsByTagName("INPUT");
                           if(inputArray[0].type=="hidden")//产品ID
                           {
                             
                              selectvalue+=inputArray[0].value+',';
                           }
                           if(inputArray[3].type=="text")//订购数量
                           {
                               if(id==inputArray[0].value)
                               {    
                                    flag=true;
                                   
                               }
                               selectnum+=inputArray[3].value+',';  
                           }
                      }
                      if(selectvalue!='')
                      {
                        selectvalue=selectvalue.substring(0,selectvalue.length-1);
                      }
                      if(selectnum!='')
                      {
                        selectnum=selectnum.substring(0,selectnum.length-1);
                      } 
              } 

                if(flag)
                {
                    if(document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo'))
                    {
                        document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo').value=selectvalue+'_'+selectnum;
                    }
                    else
                    {
                      document.getElementById('HidIdInfo').value=selectvalue+'_'+selectnum;
                    }
                }
                else
                {
                   if(selectvalue!='')
                  {
                    selectvalue+=',';
                  }

                  if(selectnum!='')
                  {
                    selectnum+=',';
                  }
                  if(document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo'))
                  {
                     document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo').value=selectvalue+id+'_'+selectnum+'1';
                  }
                  else
                  {
                    document.getElementById('HidIdInfo').value=selectvalue+id+'_'+selectnum+'1';
                  }
                }   
                if(document.getElementById('ctl00_ContentPlaceHolder1_btnAddPro'))   
                {            
                    document.getElementById('ctl00_ContentPlaceHolder1_btnAddPro').click();
                }
                else
                {
                    document.getElementById('btnAddPro').click();
                }
            
        }
        else
        {
            SetDeltePro(id);
            
        }
    } 
    
   
 }
 
 function SetDeltePro(id)
 {
// if (confirm('确定要取消此产品订购吗？')) 
//     {
         var gvProList;
         if (document.getElementById('ctl00_ContentPlaceHolder1_gvProductList')) {
             gvProList = document.getElementById('ctl00_ContentPlaceHolder1_gvProductList');
         }
         else {
             gvProList = document.getElementById('gvProductList');
         }
         var selectvalue = '';
         var selectnum = '';
         if (gvProList != null) {
             for (j = 1; j < gvProList.rows.length; j++) {
                 var inputArray = gvProList.rows[j].getElementsByTagName("INPUT");
                 if (inputArray[0].type == "hidden")//产品ID
                 {

                     selectvalue += inputArray[0].value + ',';
                 }
                 if (inputArray[3].type == "text") {
                     selectnum += inputArray[3].value + ',';
                 }
             }
             if (selectvalue != '') {
                 selectvalue = selectvalue.substring(0, selectvalue.length - 1);
             }
             if (selectnum != '') {
                 selectnum = selectnum.substring(0, selectnum.length - 1);
             }


         }
         if (document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo'))
             document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo').value = selectvalue;
         else
             document.getElementById('HidIdInfo').value = selectvalue;
         if (document.getElementById('ctl00_ContentPlaceHolder1_HidNumInfo'))
             document.getElementById('ctl00_ContentPlaceHolder1_HidNumInfo').value = selectnum;
         else
             document.getElementById('HidNumInfo').value = selectnum;
         if (document.getElementById('ctl00_ContentPlaceHolder1_HidId'))
             document.getElementById('ctl00_ContentPlaceHolder1_HidId').value = id;
         else
             document.getElementById('HidId').value = id;

         if (document.getElementById('ctl00_ContentPlaceHolder1_btnDelePro'))
             document.getElementById('ctl00_ContentPlaceHolder1_btnDelePro').click();
         else
             document.getElementById('btnDelePro').click();
         if (document.getElementById('chkboxpro_' + id) != null) {
             document.getElementById('chkboxpro_' + id).checked = false;
         }
         //选中行字体颜色改变
         if (document.getElementById("Div_desc_" + id)) {
             document.getElementById("Div_desc_" + id).style.color = "";
         }

//     }
//     else {
//         if (document.getElementById('chkboxpro_' + id) != null) {
//             document.getElementById('chkboxpro_' + id).checked = true;
//         }
//     }
 }
 function SetDelteProduct(id,price,special) {
     if ((special | 2) != special)//不是首次赠品时 (2是多选赠品类别ID)
    {
        SetDeltePro(id);
    }
    else
    {
       var msg='您确定要换价值：['+price+']元产品吗？'
       if(confirm(msg))
       {
          DelteProduct(id,price);
       }
        
    }     
 }
 function DelteProduct(id,price)
 {
       var gvProList;
       if(document.getElementById('ctl00_ContentPlaceHolder1_gvProductList'))
       {
         gvProList=document.getElementById('ctl00_ContentPlaceHolder1_gvProductList');
       }
       else
       {
         gvProList=document.getElementById('gvProductList');
       }
       var selectvalue='';
       var selectnum='';
       if(gvProList!=null)
       {
          for(j = 1;j< gvProList.rows.length; j++)
          {
               var inputArray= gvProList.rows[j].getElementsByTagName("INPUT");
               if(inputArray[0].type=="hidden")//产品ID
              {
                     
                   selectvalue+=inputArray[0].value+',';
               }
               if(inputArray[3].type=="text")
               {
                   selectnum+=inputArray[3].value+',';  
               }
          }
          if(selectvalue!='')
          {
                selectvalue=selectvalue.substring(0,selectvalue.length-1);
          }
          if(selectnum!='')
          {
            selectnum=selectnum.substring(0,selectnum.length-1);
          }
          
          
        }
        if(document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo'))
             document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo').value=selectvalue;
        else
            document.getElementById('HidIdInfo').value=selectvalue;
        if(document.getElementById('ctl00_ContentPlaceHolder1_HidNumInfo'))    
             document.getElementById('ctl00_ContentPlaceHolder1_HidNumInfo').value=selectnum;
        else
            document.getElementById('HidNumInfo').value=selectnum;  
        if(document.getElementById('ctl00_ContentPlaceHolder1_HidId'))    
            document.getElementById('ctl00_ContentPlaceHolder1_HidId').value=id;
        else
           document.getElementById('HidId').value=id;  
        
        if(document.getElementById('ctl00_ContentPlaceHolder1_btnDelePro'))
             document.getElementById('ctl00_ContentPlaceHolder1_btnDelePro').click();
        else
             document.getElementById('btnDelePro').click();    
         if(document.getElementById('chkboxpro_'+id)!=null)
         {
            document.getElementById('chkboxpro_'+id).checked=false;
         }
 }
//设置当前订购产品总价和总积分-----------------------------------------------------------------------------

   function GridViewSelectOnChange(elmt,rowindex,lbtotalprice,lbtotalpv,gvgridviewId,edition)
   {

       var curnum=document.getElementById(elmt.parentNode.children[0].id).value;
       if(curnum=="")
       {
            alert("请输入数量！");
            document.getElementById(elmt.parentNode.children[0].id).focus();
            PublicObject.ClearPostBack();
            return ;
       }
       if(curnum==0)
       {
            alert("订购数量必须大于0！");
            document.getElementById(elmt.parentNode.children[0].id).focus();
            PublicObject.ClearPostBack();
            return ;
       }
       
       var gvProList=document.getElementById(gvgridviewId);
       var totalprice=0.00;
       var totalpv=0.00;
       var price=0.00;
       var pv=0.00;
       var num=0;
       if(gvProList!=null)
       {
          for(j = 1;j< gvProList.rows.length; j++)
          {
               var inputArray= gvProList.rows[j].getElementsByTagName("INPUT");
               if(inputArray[1].type=="hidden")
               {
                    price=parseFloat(inputArray[1].value);
               }
               if(edition==1)//国际使用pv
               {
                   if(inputArray[2].type=="hidden")
                   {
                        pv=parseFloat(inputArray[2].value);
                   }
               }
               else
               {
                   if(inputArray[4].type=="hidden")
                   {
                        pv=parseFloat(inputArray[4].value);//国内使用D值
                   }
               }
               if(inputArray[3].type=="text")
               {
                   num=parseInt(inputArray[3].value);
               }
               
               totalprice+=parseFloat(price*num);
               totalpv+=parseFloat(pv*num);
          }
       }
       
       document.getElementById(lbtotalprice).innerHTML=totalprice.toFixed(2);
       document.getElementById(lbtotalpv).innerHTML=totalpv.toFixed(2); 
        
   }
   //--------------------------------------------------------------------------------------------------
   function GridViewGiftSelectOnChange(elmt,rowindex,lbtotalprice,lbtotalpv,gvgridviewId,edition)
   {

       var curnum=document.getElementById(elmt.parentNode.children[0].id).value;
       if(curnum=="")
       {
            alert("请输入数量！");
            document.getElementById(elmt.parentNode.children[0].id).focus();
            PublicObject.ClearPostBack();
            return ;
       }
       if(curnum==0)
       {
            alert("订购数量必须大于0！");
            document.getElementById(elmt.parentNode.children[0].id).focus();
            PublicObject.ClearPostBack();
            return ;
       }
       
       var gvProList=document.getElementById(gvgridviewId);
       var totalprice=0.00;
       var totalpv=0.00;
       var price=0.00;
       var pv=0.00;
       var num=0;
       if(gvProList!=null)
       {
          for(j = 1;j< gvProList.rows.length; j++)
          {
               var inputArray= gvProList.rows[j].getElementsByTagName("INPUT");
               if(inputArray[1].type=="hidden")
               {
                    price=parseFloat(inputArray[1].value);
               }
               if(edition==1)//国际使用pv
               {
                   if(inputArray[2].type=="hidden")
                   {
                        pv=parseFloat(inputArray[2].value);
                   }
               }
               else
               {
                   if(inputArray[4].type=="hidden")
                   {
                        pv=parseFloat(inputArray[4].value);//国内使用D值
                   }
               }
               if(inputArray[3].type=="text")
               {
                   num=parseInt(inputArray[3].value);
               }
               if(inputArray[5].value!=2)//不是赠品时
               {
                   totalprice+=parseFloat(price*num);
                   totalpv+=parseFloat(pv*num);
               }
          }
        }
       
       document.getElementById(lbtotalprice).innerHTML=totalprice.toFixed(2);
       document.getElementById(lbtotalpv).innerHTML=totalpv.toFixed(2);

   }
   //------------------------------------------------------------------------
   function GridViewHandBackSelectOnChange(elmt, rowindex, lbtypecount, lbtotalprice, lbtotalpv, gvgridviewId, oldNum) {
    
       if (oldNum != "") {
           var curnum = document.getElementById(elmt.parentNode.children[0].id).value;
           if (curnum == "") {
               alert("请输入数量！");
               document.getElementById(elmt.parentNode.children[0].id).focus();
               PublicObject.ClearPostBack();
               return;
           }
           if (curnum == 0) {
               alert("数量必须大于0！");
               document.getElementById(elmt.parentNode.children[0].id).focus();
               PublicObject.ClearPostBack();
               return;
           }
           if (parseInt(curnum) > parseInt(oldNum)) {
               alert("数量不能大于原购数量！");
               document.getElementById(elmt.parentNode.children[0].id).focus();
               PublicObject.ClearPostBack();
               return;
           }
       }
       var gvProList = document.getElementById(gvgridviewId);
       var totalprice = 0.00;
       var totalpv = 0.00;
       var price = 0.00;
       var pv = 0.00;
       var num = 0;
       var typecount=0
       if (gvProList != null) {
           for (j = 1; j < gvProList.rows.length; j++) {
               var inputArray = gvProList.rows[j].getElementsByTagName("INPUT");
               if (inputArray[0].type == "checkbox" && inputArray[0].checked == true) {
                   typecount++;
                   if (inputArray[2].type == "hidden") {
                       price = parseFloat(inputArray[2].value);
                   }
                   if (inputArray[3].type == "hidden") {
                       pv = parseFloat(inputArray[3].value);
                   }

                   if (inputArray[4].type == "text") {
                       num = parseInt(inputArray[4].value);
                   }
                 totalprice += parseFloat(price * num);
                 totalpv += parseFloat(pv * num);
               }
              
           }
       }
       document.getElementById(lbtypecount).innerHTML = typecount;
       document.getElementById(lbtotalprice).innerHTML = totalprice.toFixed(2);
       document.getElementById(lbtotalpv).innerHTML = totalpv.toFixed(2);

   }
//--------------------------------------------------------------------------   
 var DomHelper = function(){};
 DomHelper.ClickElement = function(elmtid)
 {
   document.getElementById(elmtid).click();
 }

