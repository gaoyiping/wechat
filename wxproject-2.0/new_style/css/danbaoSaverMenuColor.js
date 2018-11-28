
/*-------------------店铺菜单字体颜色-------------------------*/
function SetSaveMenuFontColor(id,typeid,num)
{
  
    for (var i=1;i<=num ;i++ )
    {	
	    document.getElementById('LeftMenuImg_'+typeid+'_'+i).className='ico_left_direct_stand';
		document.getElementById('LeftMenu_'+typeid+'_'+i).style.color="0F0F0F";	
    }

    document.getElementById('LeftMenuImg_'+typeid+'_'+id).className='ico_left_direct_hover';
	document.getElementById('LeftMenu_'+typeid+'_'+id).style.color="#FF0000";


    var selectvalue = -1;
    var selectid=typeid;




}
