
function LTrim(str)
{
    var whitespace = new String(" \t\n\r");
    var s = new String(str);
    if (whitespace.indexOf(s.charAt(0)) != -1)
    {
        var j=0, i = s.length;
        while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
        {
            j++;
        }
        s = s.substring(j, i);
	}
    return s;
}
/*
==================================================================
RTrim(string):去除右边的空格
==================================================================
*/
function RTrim(str)
{
    var whitespace = new String(" \t\n\r");
    var s = new String(str);

    if (whitespace.indexOf(s.charAt(s.length-1)) != -1)
    {
        var i = s.length - 1;
        while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
        {
            i--;
        }
        s = s.substring(0, i+1);
    }
    return s;
}
/*
==================================================================
Trim(string):去除前后空格
==================================================================
*/
function Trim(str)
{
    return RTrim(LTrim(str));
}
/*
================================================================================
XMLEncode(string):对字符串进行XML编码
================================================================================
*/
function XMLEncode(str)
{
       str=Trim(str);
       str=str.replace("&","&amp;");
       str=str.replace("<","&lt;");
       str=str.replace(">","&gt;");
       str=str.replace("'","&apos;");
       str=str.replace("\"","&quot;");
       return str;
}
/*
================================================================================
验证类函数
================================================================================
*/
function IsEmpty(obj)
{
    obj=document.getElementsByName(obj).item(0);
    if(Trim(obj.value)=="")
    {
        alert("字段不能为空。");        
        if(obj.disabled==false && obj.readOnly==false)
        {
            obj.focus();
        }
    }
}
/*
IsInt(string,string,int or string):(测试字符串,+ or - or empty,empty or 0)
功能：判断是否为整数、正整数、负整数、正整数+0、负整数+0
*/
function IsInt(objStr,sign,zero)
{
    var reg;
    var bolzero;
    
    if(Trim(objStr)=="")
    {
        return false;
    }
    else
    {
        objStr=objStr.toString();
    }    
    
    if((sign==null)||(Trim(sign)==""))
    {
        sign="+-";
    }
    
    if((zero==null)||(Trim(zero)==""))
    {
        bolzero=false;
    }
    else
    {
        zero=zero.toString();
        if(zero=="0")
        {
            bolzero=true;
        }
        else
        {
            alert("检查是否包含0参数，只可为(空、0)");
       }
    }
    
    switch(sign)
    {
        case "+-":
            //整数
            reg=/(^-?|^\+?)\d+$/;            
            break;
        case "+": 
            if(!bolzero)           
            {
                //正整数
                reg=/^\+?[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //正整数+0
                //reg=/^\+?\d+$/;
                reg=/^\+?[0-9]*[0-9][0-9]*$/;
            }
            break;
        case "-":
            if(!bolzero)
            {
                //负整数
                reg=/^-[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //负整数+0
                //reg=/^-\d+$/;
                reg=/^-[0-9]*[0-9][0-9]*$/;
            }            
            break;
        default:
            alert("检查符号参数，只可为(空、+、-)");
            return false;
            break;
    }
    var r=objStr.match(reg);
    if(r==null)
    {
        return false;
    }
    else
    {        
        return true;     
    }
}

/*
IsFloat(string,string,int or string):(测试字符串,+ or - or empty,empty or 0)
功能：判断是否为浮点数、正浮点数、负浮点数、正浮点数+0、负浮点数+0
*/
function IsFloat(objStr,sign,zero)
{
    var reg;
    var bolzero;
    
    if(Trim(objStr)=="")
    {
        return false;
    }
    else
    {
        objStr=objStr.toString();
    }    
    
    if((sign==null)||(Trim(sign)==""))
    {
        sign="+-";
    }

    if((zero==null)||(Trim(zero)==""))
    {
        bolzero=false;
    }
    else
    {
        zero=zero.toString();
        if(zero=="0")
        {
            bolzero=true;
        }
        else
        {
            alert("检查是否包含0参数，只可为(空、0)");
        }
    }
    
    switch(sign)
    {
        case "+-":
            //浮点数
            reg=/^((-?|\+?)\d+)(\.\d+)?$/;
            break;
        case "+":
            if(!bolzero)           
            {
                //正浮点数
                reg=/^\+?(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
            }
            else
            {
                //正浮点数+0
                reg=/^\+?\d+(\.\d+)?$/;
            }
            break;
        case "-":
            if(!bolzero)
            {
                //负浮点数
                reg=/^-(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
            }
            else
            {
                //负浮点数+0
                reg=/^((-\d+(\.\d+)?)|(0+(\.0+)?))$/;
            }            
            break;
        default:
            alert("检查符号参数，只可为(空、+、-)");
            return false;
            break;
    }
    
    var r=objStr.match(reg);
    if(r==null)
    {
        return false;
    }
    else
    {        
        return true;     
    }
}
function CheckInteger(Event)
{
	if((Event.keyCode>7 && Event.keyCode<10) || (Event.keyCode>27 && Event.keyCode<30) || Event.keyCode>47 && Event.keyCode<58)
	{
		Event.returnValue = Event.keyCode ;
	}
	else
	{
		Event.cancelBubble = true ;
		Event.returnValue = false ;
	}
}
function CheckEmail(address)
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(address))
	{
		return (false)
	}
	return (true)
}


var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];    // 加权因子   
var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];            // 身份证验证位值.10代表X   
function IdCardValidate(idCard) { 
    idCard = Trim(idCard.replace(/ /g, ""));               //去掉字符串头尾空格                     
    if (idCard.length == 15) {   
        return isValidityBrithBy15IdCard(idCard);       //进行15位身份证的验证    
    } else if (idCard.length == 18) {   
        var a_idCard = idCard.split("");                // 得到身份证数组   
        if(isValidityBrithBy18IdCard(idCard)&&isTrueValidateCodeBy18IdCard(a_idCard)){   //进行18位身份证的基本验证和第18位的验证
            return true;   
        }else {   
            return false;   
        }   
    } else {   
        return false;   
    }   
}   
/**  
 * 判断身份证号码为18位时最后的验证位是否正确  
 * @param a_idCard 身份证号码数组  
 * @return  
 */  
function isTrueValidateCodeBy18IdCard(a_idCard) {   
    var sum = 0;                             // 声明加权求和变量   
    if (a_idCard[17].toLowerCase() == 'x') {   
        a_idCard[17] = 10;                    // 将最后位为x的验证码替换为10方便后续操作   
    }   
    for ( var i = 0; i < 17; i++) {   
        sum += Wi[i] * a_idCard[i];            // 加权求和   
    }   
    valCodePosition = sum % 11;                // 得到验证码所位置   
    if (a_idCard[17] == ValideCode[valCodePosition]) {   
        return true;   
    } else {   
        return false;   
    }   
}   
/**  
  * 验证18位数身份证号码中的生日是否是有效生日  
  * @param idCard 18位书身份证字符串  
  * @return  
  */  
function isValidityBrithBy18IdCard(idCard18){   
    var year =  idCard18.substring(6,10);   
    var month = idCard18.substring(10,12);   
    var day = idCard18.substring(12,14);   
    var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
    // 这里用getFullYear()获取年份，避免千年虫问题   
    if(temp_date.getFullYear()!=parseFloat(year)   
          ||temp_date.getMonth()!=parseFloat(month)-1   
          ||temp_date.getDate()!=parseFloat(day)){   
            return false;   
    }else{   
        return true;   
    }   
}   
  /**  
   * 验证15位数身份证号码中的生日是否是有效生日  
   * @param idCard15 15位书身份证字符串  
   * @return  
   */  
  function isValidityBrithBy15IdCard(idCard15){   
      var year =  idCard15.substring(6,8);   
      var month = idCard15.substring(8,10);   
      var day = idCard15.substring(10,12);   
      var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
      // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
      if(temp_date.getYear()!=parseFloat(year)   
              ||temp_date.getMonth()!=parseFloat(month)-1   
              ||temp_date.getDate()!=parseFloat(day)){   
                return false;   
        }else{   
            return true;   
        }   
  }   
