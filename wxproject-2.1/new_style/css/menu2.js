﻿// JScript 文件

   var screenHeight = (window.screen.height - 485) + "px";
    if ((window.screen.height - 485) < 193) {
        screenHeight=193+"px";
    }
    for(var i=1;i<4;i++)
    {
        document.getElementById('Div_MenuItem_'+i).style.height=screenHeight;
    }
     function ShowStoreMenu(id) {
       for(var i=1;i<4;i++)
       {
            if(id==i)
            {
                document.getElementById('Div_MenuItem_' + id).style.display = "block";              
            }
            else
            {
                document.getElementById('Div_MenuItem_' + i).style.display = "none";   
            }
       }
    }
    function Getlogout() {
        document.getElementById("ctl00_Left1_btnlogout").click();
    }