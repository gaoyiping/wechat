/*--------------订购产品------------------*/

function GetChooseGoods(id, name, qian, jifen ,isWu,danwei,sNo) {
  
   
    if (document.getElementById('chkboxpro_' + id) != null) 
	{

            if (document.getElementById('chkboxpro_' + id).checked) 
			{
	
                     //选中行字体颜色改变
					if (document.getElementById("Div_desc_" + id)) 
					{
							document.getElementById("Div_desc_" + id).style.color = "#F16911";
							document.getElementById("chkboxpro_" + id).disabled=true;
				    }
			        AddSignRow(id, name, qian, jifen,15511,danwei,sNo);
                   
             }
           
           
			 tongji();
			 ispuka();
     }
	
}


//判断PV是否够普卡资格
function ispuka()
{

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
                      jine=jine+ (parseInt(signFrame.rows[i].cells[2].innerText)*parseInt(signFrame.rows[i].cells[5].innerText));
				      jifen=jifen+(parseInt(signFrame.rows[i].cells[3].innerText)*parseInt(signFrame.rows[i].cells[5].innerText));
						
                }
				document.getElementById("ctl00_ContentPlaceHolder1_lbtypeprd").innerHTML=num;
				document.getElementById("ctl00_ContentPlaceHolder1_lbtotalmoney").innerHTML=jine;
				document.getElementById("ctl00_ContentPlaceHolder1_lbtotalpv").innerHTML=jifen;
				
				
}


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
function AddSignRow(id, name, qian, jifen,yuanshi,danwei,sNo){ //读取最后一行的行号，存放在txtTRLastIndex文本框中
     
	var txtTRLastIndex = findObj("txtTRLastIndex",document);
     var rowID = parseInt(txtTRLastIndex.value);
   
     var signFrame = findObj("SignFrame",document);
     //添加行
     var newTR = signFrame.insertRow(signFrame.rows.length);
     newTR.id = "SignItem" + rowID;
    
     newTR.style.background="#EDF1F8";
     //添加列:序号
     var newNameTD=newTR.insertCell(0);
     newNameTD.innerHTML = newTR.rowIndex+1;
      newNameTD.width=40;
        newNameTD.align="center";
   
     //添加列: 产品名字
     var newNameTD1=newTR.insertCell(1);
     newNameTD1.innerHTML = name+"<input name='txtID" + newTR.rowIndex.toString() + "' id='txtID" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+id+"' /><input name='txtbname" + newTR.rowIndex.toString() + "' id='txtbname" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+name+"' />";
	 newNameTD1.width=240;
   

     //添加列:价格
     var newJiage=newTR.insertCell(2);
     newJiage.innerHTML = qian+"";
	 newJiage.width=120;

     //添加列:积分
     var newJifen=newTR.insertCell(3);
     newJifen.innerHTML =jifen+" ";
     newJifen.width=110;	 

     //添加列:数量
     var newNum=newTR.insertCell(4);
     newNum.innerHTML = "<input name='txtNum" + newTR.rowIndex.toString() + "' id='txtNum" + newTR.rowIndex.toString() + "' type='text' onkeyup=\"updateNum(this,'SignItem" + rowID + "')\"  style='width:30px;' value='1' /> <input name='txtpv" + newTR.rowIndex.toString() + "' id='txtpv" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+jifen+"' />";
     newNum.width=53;

     
     //添加列:数量
     var newshuliang2=newTR.insertCell(5);
     newshuliang2.innerHTML = "1";
     newshuliang2.width=20;
	 newshuliang2.style.color="#EDF1F8";

	//添加列:数量
     var danwei1=newTR.insertCell(6);
     danwei1.innerHTML = danwei+"<input name='txtdanwei" + newTR.rowIndex.toString() + "' id='txtdanwei" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+danwei+"' /> <input name='txtsNo" + newTR.rowIndex.toString() + "' id='txtsNo" + newTR.rowIndex.toString() + "' type='text'  style='display:none' value='"+sNo+"' />";
     danwei1.width=57;
	
     //添加列:删除按钮
     var newDeleteTD=newTR.insertCell(7);
     //添加列内容
     newDeleteTD.innerHTML = "<div align='center' style='width:40px'><a href='javascript:;' onclick=\"DeleteSignRow('SignItem" + rowID + "','"+id+"')\">删除</a></div>"
	 +"<div style='display:none;'><input name='txtjifen" + newTR.rowIndex.toString() + "' id='txtjifen" + newTR.rowIndex.toString() + "' type='text'   value='"+jifen+"' /><input name='txtjiage" + newTR.rowIndex.toString() + "' id='txtjiage" + newTR.rowIndex.toString() + "' type='text'  value='"+qian+"' /></div>";
      newDeleteTD.width=57;



	    
     //将行号推进下一行
     txtTRLastIndex.value = (rowID + 1).toString() ;
}

//更改数量重新绑定统计值
function updateNum(obj,rowid)
{    
	if (/[^\d]/.test(obj.value)){
		obj.value="1";
       alert("请输入数字");
     }
     if(parseInt(obj.value)<1)
	{
	  obj.value="1";
       alert("产品订购数量不能小于1");
	 }
	var signFrame = findObj("SignFrame",document);
 
       signFrame.rows[rowid].cells[5].innerHTML = obj.value+"";
	 
	 tongji();
	 ispuka();
  
}
//删除指定行
function DeleteSignRow(rowid,id){
document.getElementById("chkboxpro_"+id).checked=false;
 document.getElementById("Div_desc_" + id).style.color = "";	
 document.getElementById("chkboxpro_" + id).disabled=false;
     var signFrame = findObj("SignFrame",document);
	
     var signItem = findObj(rowid,document);

     //获取将要删除的行的Index
     var rowIndex = signItem.rowIndex;
     
     //删除指定Index的行
     signFrame.deleteRow(rowIndex);
     
     // 重新排列序号，如果没有序号，这一步省略
     for(i=0;i<signFrame.rows.length;i++){
      signFrame.rows[i].cells[0].innerHTML = i+1;
	  
     }
	 tongji();
	 ispuka();
}

 
